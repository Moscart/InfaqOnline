<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function showAllMenuUser()
    {
        return $this->db->query("SELECT user_menu.menu, GROUP_CONCAT(DISTINCT user_role.role SEPARATOR ', ') AS role FROM user_access_menu JOIN user_menu ON user_access_menu.menu_id = user_menu.id JOIN user_sub_menu ON user_menu.id = user_sub_menu.menu_id JOIN user_role ON user_access_menu.role_id = user_role.id GROUP BY user_menu.menu ORDER BY user_menu.id ASC")->result_array();
    }

    public function autoId($tabel, $field, $akronim)
    {
        $tgl = date('ymd', time());
        $this->db->select($field);
        $this->db->from($tabel);
        $this->db->like($field, $akronim, 'after');
        $this->db->order_by($field, 'DESC');
        $ambilData = $this->db->get()->row_array();
        if ($ambilData[$field] == '') {
            $idAuto = $akronim . $tgl . "001";
        } else if ($ambilData[$field] <> "") {
            $this->db->select($field);
            $this->db->from($tabel);
            $this->db->like($field, $akronim, 'after');
            $this->db->order_by($field, 'DESC');
            $this->db->limit(1, 0);
            $dataAkhir = $this->db->get()->row_array();
            if (substr($dataAkhir[$field], 0, 9) <> $akronim . $tgl) {
                $idAuto = $akronim . $tgl . "001";
            } else {
                $counter = substr($ambilData[$field], 9, 3) + 1;
                if ($counter < 10) {
                    $idAuto = $akronim . $tgl . "00" . $counter;
                } else if ($counter < 100) {
                    $idAuto = $akronim . $tgl . "0" . $counter;
                } else if ($counter < 1000) {
                    $idAuto = $akronim . $tgl . $counter;
                }
            }
        }
        return $idAuto;
    }

    public function autoString($panjang)
    {
        // tentukan karakter random
        $karakter = 'QASZDCXWERVRTCYFGHCBVNMKNYIOIPGLMAGEZACUOQNDFTUZMXRJKOAMWPEXBUQIqazplmwsoknedcijnrfvuhbtgy';
        // buat variabel kosong untuke kembalian nilai retur
        $string = '';
        // lakukan proses looping 
        for ($i = 0; $i < $panjang; $i++) {
            // lakukan random data dengan nilai awal 0 dan nilai akhir sebanyak value 'karakter'
            $pos = rand(0, strlen($karakter) - 1);
            // melakukan penggabungan antara nilai karakter di kiri dengan nilai di kanan
            $string .= $karakter[$pos];
        }
        // kembalikan nilai dari function ke echo
        return $string;
    }

    public function showListArtikel()
    {
        $this->db->select('artikel.artikel_id, artikel.link, artikel.judul, artikel.banner, artikel.tgl_upload, artikel.dilihat, user.name');
        $this->db->from('artikel');
        $this->db->join('user', 'user.email = artikel.user_email');
        $this->db->order_by('artikel.tgl_upload', 'DESC');
        return $this->db->get()->result_array();
    }

    public function cekRowLinkArtikel($linkSlug)
    {
        $cek = $this->db->select('link')->from('artikel')->where('link', $linkSlug)->get()->num_rows();
        if ($cek > 0) {
            $resp = 'err';
        } else {
            $resp = 'ok';
        }
        return $resp;
    }

    public function handleArtikelAction($post, $file = null)
    {
        if (base64_decode($post['tokenArtikel']) == 'posting') {
            // handle upload bannerArtikel
            $upload_image = $file['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['max_size']     = '8192';
                $config['upload_path'] = './assets/img/artikel/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('bannerArtikel')) {
                    $banner = $this->upload->data('file_name');
                } else {
                    $banner = NULL;
                }
            }
            // jika tidak ada foto gagalkan proses insert pembelian
            if ($banner != NULL) {
                // masukkan ke variabel dulu, semua yang $this->input->post()
                $data = [
                    'link' => $post['linkUrlSlug'],
                    'judul' => $post['judulArtikel'],
                    'isi' => $post['isiArtikel'],
                    'user_email' => $this->session->userdata('email'),
                    'tgl_upload' => date('Y-m-d H:i:s', time()),
                    'banner' => $banner
                ];
                $resp =  ($this->db->insert('artikel', $data)) ? 'ok' : 'errInsert';
            } else $resp = 'errFoto';
        } else if (base64_decode($post['tokenArtikel']) == 'edit') {
            // define upload status
            $banner = true;
            // get file gambar lama n baru
            if ($file['name'] != '' && $file['name'] != $post['bannerOldArtikel']) {
                // upload gambar baru bannerArtikel
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['max_size']     = '8192';
                $config['upload_path'] = './assets/img/artikel/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('bannerArtikel')) {
                    $banner = $this->upload->data('file_name');
                    // hapus gambar lama
                    unlink($config['upload_path'] . $post['bannerOldArtikel']);
                    // inisial update
                    $data   = [
                        'link' => $post['linkUrlSlug'],
                        'judul' => $post['judulArtikel'],
                        'isi' => $post['isiArtikel'],
                        'banner' => $banner
                    ];
                } else $banner = false;
            } else {
                // gambar masih pakai yang lama, inisial update
                $data = [
                    'link' => $post['linkUrlSlug'],
                    'judul' => $post['judulArtikel'],
                    'isi' => $post['isiArtikel'],
                    'banner' => $post['bannerOldArtikel']
                ];
            }
            // jika upload berhasil update db
            if ($banner) {
                $this->db->set($data);
                $this->db->where('link', $post['LinkUrlSlugOldArtikel']);
                $resp = ($this->db->update('artikel')) ? 'ok' : 'err';
            } else $resp = 'errFoto';
        }
        return $resp;
    }

    public function showListSubProgram()
    {
        $this->db->select('program_detail.*, program.nama_program');
        $this->db->from('program_detail');
        $this->db->join('program', 'program.id_program = program_detail.id_program');
        return $this->db->get()->result_array();
    }

    public function handleSubProgramAction($post, $file = null)
    {
        if (base64_decode($post['token']) == 'add') {
            // handle upload bannerSubProgram
            $upload_image = $file['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['max_size']     = '8192';
                $config['upload_path'] = './assets/img/program/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('bannerSubProgram')) {
                    $banner = $this->upload->data('file_name');
                } else {
                    $banner = NULL;
                }
            }
            // jika tidak ada foto gagalkan proses insert pembelian
            if ($banner != NULL) {
                // masukkan ke variabel dulu, semua yang $this->input->post()
                $data = [
                    'id_program' => $post['id_program'],
                    'nama_detailprogram' => $post['nama_detailprogram'],
                    'banner' => $banner,
                    'deskripsi' => $post['deskripsi']
                ];
                $resp =  ($this->db->insert('program_detail', $data)) ? 'ok' : 'errInsert';
            } else $resp = 'errFoto';
        } else if (base64_decode($post['token']) == 'edit') {
            // define upload status
            $banner = true;
            // get file gambar lama n baru
            if ($file['name'] != '' && $file['name'] != $post['bannerSubProgramOld']) {
                // upload gambar baru bannerSubProgramEdit
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['max_size']     = '8192';
                $config['upload_path'] = './assets/img/program/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('bannerSubProgramEdit')) {
                    $banner = $this->upload->data('file_name');
                    // hapus gambar lama
                    unlink($config['upload_path'] . $post['bannerSubProgramOld']);
                    // inisial update
                    $data   = [
                        'id_program' => $post['id_programEdit'],
                        'nama_detailprogram' => $post['nama_detailprogramEdit'],
                        'banner' => $banner,
                        'deskripsi' => $post['deskripsiEdit']
                    ];
                } else $banner = false;
            } else {
                // gambar masih pakai yang lama, inisial update
                $data = [
                    'id_program' => $post['id_programEdit'],
                    'nama_detailprogram' => $post['nama_detailprogramEdit'],
                    'banner' => $post['bannerSubProgramOld'],
                    'deskripsi' => $post['deskripsiEdit']
                ];
            }
            // jika upload berhasil update db
            if ($banner) {
                $this->db->set($data);
                $this->db->where('id_programdetail', $post['hiddenIdSubProgram']);
                $resp = ($this->db->update('program_detail')) ? 'ok' : 'err';
            } else $resp = 'errFoto';
        }
        return $resp;
    }

    public function getProgramWithSumDana()
    {
        return $this->db->select('DISTINCT(program) AS nama_program, SUM(nominal) AS dana_program')->from('transaksi_masuk')->group_by('program')->get()->result_array();
    }

    public function showProgram()
    {
        if ($this->db->get('program')->num_rows() == 0) $data = [];
        else $program = $this->db->get('program')->result_array();
        $data = ['program' => array()];
        foreach ($program as $p) {
            $addMenu = [
                'nama_program' => $p['nama_program'],
                'program_detail' => $this->_getProgramDetail($p['id_program'])
            ];
            array_push($data['program'], $addMenu);
        }
        return $data;
    }

    private function _getProgramDetail($id_program)
    {
        $detailProgram =  $this->db->select('nama_detailprogram, banner, deskripsi')->from('program_detail')->where('id_program', $id_program)->get()->result_array();
        $data = [];
        foreach ($detailProgram as $dp) {
            $add = [
                'nama_detailprogram' => $dp['nama_detailprogram'],
                'banner_detailprogram' => base_url('assets/img/program/') . $dp['banner'],
                'deskripsi_detailprogram' => $dp['deskripsi']
            ];
            array_push($data, $add);
        }
        return $data;
    }

    public function getDataChart()
    {
        return $this->db->query("SELECT DATE_FORMAT(transaksi_masuk.tgl , '%m') AS bulan, YEAR(transaksi_masuk.tgl) AS tahun, SUM(transaksi_masuk.nominal) AS nominal FROM transaksi_masuk WHERE transaksi_masuk.status = 'settlement' GROUP BY MONTH(transaksi_masuk.tgl) ORDER BY transaksi_masuk.tgl ASC LIMIT 12")->result_array();
    }

    public function getDataPie()
    {
        return $this->db->select('DISTINCT(status) AS status, COUNT(status) AS total')->from('transaksi_masuk')->group_by('status')->get()->result_array();
    }

    public function getTotalDana()
    {
        $settlement = $this->db->select('SUM(nominal) AS total_masuk')->from('transaksi_masuk')->where('status', 'settlement')->get()->row_array();
        $keluar = $this->db->select('SUM(nominal) AS total_keluar')->from('transaksi_keluar')->get()->row_array();
        return $settlement['total_masuk'] - $keluar['total_keluar'];
    }

    public function countStatusPending()
    {
        return $this->db->select('COUNT(order_id) AS pending_count')->from('transaksi_masuk')->where('status', 'pending')->get()->row_array();
    }

    public function getTotalNominalPending()
    {
        return $this->db->select('SUM(nominal) AS pending_total')->from('transaksi_masuk')->where('status', 'pending')->get()->row_array();
    }

    public function getYearLaporan()
    {
        $masuk = $this->db->select('MIN(YEAR(tgl)) AS min_year, MAX(YEAR(tgl)) AS max_year')->get('transaksi_masuk')->row_array();
        $keluar = $this->db->select('MIN(YEAR(tgl)) AS min_year, MAX(YEAR(tgl)) AS max_year')->get('transaksi_keluar')->row_array();
        $min_year = array($masuk['min_year'], $keluar['min_year']);
        $min_year = min($min_year);
        $max_year = array($masuk['max_year'], $keluar['max_year']);
        $max_year = max($max_year);
        return [
            'min_year' => $min_year,
            'max_year' => $max_year
        ];
    }

    public function getDonaturLaporan()
    {
        return $this->db->select('DISTINCT(user_nama) AS nama')->group_by('user_nama')->get('transaksi_masuk')->result_array();
    }

    public function dataReportTransaksiMasuk($program, $periode_lap, $user_nama, $status, $post)
    {
        if ($user_nama == 'semua') {
            $user_nama = '%';
            $ket_donatur = 'Semua';
        } else {
            $ket_donatur = $user_nama;
        }

        if ($status == 'semua') {
            $status = '%';
            $ket_status = "Semua";
        } else {
            $status = '%' . $status . '%';
            $ket_status = strtoupper(explode('%', $status)[1]);
        }

        if ($program == 'semua') {
            $program = '%';
            $ket_program = "Semua";
        } else {
            $ket_program = 'TIDAK BERNAMA';
        }

        if ($periode_lap == 'hari_ini') {
            $ket_periode = date('d', time()) . ' ' . month(date('n', time()), 'mmmm') . ' ' . date('Y', time());
            $query = "SELECT transaksi_masuk.order_id, transaksi_masuk.tgl, transaksi_masuk.user_nama, transaksi_masuk.nominal, transaksi_masuk.program, transaksi_masuk.status FROM transaksi_masuk WHERE DATE(transaksi_masuk.tgl) = CURDATE() AND transaksi_masuk.user_nama LIKE '$user_nama' AND transaksi_masuk.status LIKE '$status' AND transaksi_masuk.program LIKE '$program' ORDER BY transaksi_masuk.tgl ASC";
        } else if ($periode_lap == 'bulan_ini') {
            $ket_periode = month(date('n', time()), 'mmmm') . ' ' . date('Y', time());
            $query = "SELECT transaksi_masuk.order_id, transaksi_masuk.tgl, transaksi_masuk.user_nama, transaksi_masuk.nominal, transaksi_masuk.program, transaksi_masuk.status FROM transaksi_masuk WHERE MONTH(DATE(transaksi_masuk.tgl)) = MONTH(CURDATE()) AND transaksi_masuk.user_nama LIKE '$user_nama' AND transaksi_masuk.status LIKE '$status' AND transaksi_masuk.program LIKE '$program' ORDER BY transaksi_masuk.tgl ASC";
        } else if ($periode_lap == 'tahun_ini') {
            $ket_periode = 'Tahun ' . date('Y', time());
            $query = "SELECT transaksi_masuk.order_id, transaksi_masuk.tgl, transaksi_masuk.user_nama, transaksi_masuk.nominal, transaksi_masuk.program, transaksi_masuk.status FROM transaksi_masuk WHERE YEAR(DATE(transaksi_masuk.tgl)) = YEAR(CURDATE()) AND transaksi_masuk.user_nama LIKE '$user_nama' AND transaksi_masuk.status LIKE '$status' AND transaksi_masuk.program LIKE '$program' ORDER BY transaksi_masuk.tgl ASC";
        } else if ($periode_lap == 'pertanggal') {
            $cek_tgl = (isset($post['label_tgl_akhir'])) ? 'yes' : 'false';
            $tgl_awal = $post['per_tanggal1'];
            if ($cek_tgl == 'yes') {
                $tgl_akhir = $post['per_tanggal2'];
                $ket_periode = date("d", strtotime($tgl_awal)) . " " . month(date("n", strtotime($tgl_awal)), 'mmmm') . " " . date("Y", strtotime($tgl_awal)) . " s.d. " . date("d", strtotime($tgl_akhir)) . " " . month(date("n", strtotime($tgl_akhir)), 'mmmm') . " " . date("Y", strtotime($tgl_akhir));
                $query = "SELECT transaksi_masuk.order_id, transaksi_masuk.tgl, transaksi_masuk.user_nama, transaksi_masuk.nominal, transaksi_masuk.program, transaksi_masuk.status FROM transaksi_masuk WHERE (DATE(transaksi_masuk.tgl) BETWEEN '$tgl_awal' AND '$tgl_akhir') AND transaksi_masuk.user_nama LIKE '$user_nama' AND transaksi_masuk.status LIKE '$status' AND transaksi_masuk.program LIKE '$program' ORDER BY transaksi_masuk.tgl ASC";
            } else {
                $ket_periode = date("d", strtotime($tgl_awal)) . " " . month(date("n", strtotime($tgl_awal)), 'mmmm') . " " . date("Y", strtotime($tgl_awal));
                $query = "SELECT transaksi_masuk.order_id, transaksi_masuk.tgl, transaksi_masuk.user_nama, transaksi_masuk.nominal, transaksi_masuk.program, transaksi_masuk.status FROM transaksi_masuk WHERE DATE(transaksi_masuk.tgl) = '$tgl_awal' AND transaksi_masuk.user_nama LIKE '$user_nama' AND transaksi_masuk.status LIKE '$status' AND transaksi_masuk.program LIKE '$program' ORDER BY transaksi_masuk.tgl ASC";
            }
        } else if ($periode_lap == 'perbulan') {
            $fm = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $cek_bln = (isset($post['label_bulan_akhir'])) ? 'yes' : 'false';
            $bulan1 = $post['per_bulan1'];
            $tahunbulan1 = $post['tahun_perbulan1'];
            if ($cek_bln == 'yes') {
                $bulan2 = $post['per_bulan2'];
                $tahunbulan2 = $post['tahun_perbulan2'];
                $tgl_awal = $tahunbulan1 . '-' . $bulan1 . '-01';
                $tgl_akhir = $tahunbulan2 . '-' . $bulan2 . '-31';
                $ket_periode =  $fm[$bulan1 - 1] . ' ' .  $tahunbulan1 . " s.d. " . $fm[$bulan2 - 1] . " " . $tahunbulan2;
                $query = "SELECT transaksi_masuk.order_id, transaksi_masuk.tgl, transaksi_masuk.user_nama, transaksi_masuk.nominal, transaksi_masuk.program, transaksi_masuk.status FROM transaksi_masuk WHERE (DATE(transaksi_masuk.tgl) BETWEEN '$tgl_awal' AND '$tgl_akhir') AND transaksi_masuk.user_nama LIKE '$user_nama' AND transaksi_masuk.status LIKE '$status' AND transaksi_masuk.program LIKE '$program' ORDER BY transaksi_masuk.tgl ASC";
            } else {
                $ket_periode =  $fm[$bulan1 - 1] . " " . $tahunbulan1;
                $query = "SELECT transaksi_masuk.order_id, transaksi_masuk.tgl, transaksi_masuk.user_nama, transaksi_masuk.nominal, transaksi_masuk.program, transaksi_masuk.status FROM transaksi_masuk WHERE (MONTH(DATE(transaksi_masuk.tgl)) = '$bulan1' AND YEAR(DATE(transaksi_masuk.tgl)) = '$tahunbulan1') AND transaksi_masuk.user_nama LIKE '$user_nama' AND transaksi_masuk.status LIKE '$status' AND transaksi_masuk.program LIKE '$program' ORDER BY transaksi_masuk.tgl ASC";
            }
        } else if ($periode_lap == 'pertahun') {
            $cek_thn = (isset($post['label_tahun_akhir'])) ? 'yes' : 'false';
            $per_tahun1 = $post['per_tahun1'];
            if ($cek_thn == 'yes') {
                $per_tahun2 = $post['per_tahun2'];
                $ket_periode = 'Tahun ' . $per_tahun1 . ' s.d. ' . $per_tahun2;
                $query = "SELECT transaksi_masuk.order_id, transaksi_masuk.tgl, transaksi_masuk.user_nama, transaksi_masuk.nominal, transaksi_masuk.program, transaksi_masuk.status FROM transaksi_masuk WHERE (YEAR(DATE(transaksi_masuk.tgl)) BETWEEN '$per_tahun1' AND '$per_tahun2') AND transaksi_masuk.user_nama LIKE '$user_nama' AND transaksi_masuk.status LIKE '$status' AND transaksi_masuk.program LIKE '$program' ORDER BY transaksi_masuk.tgl ASC";
            } else {
                $ket_periode = 'Tahun ' . $per_tahun1;
                $query = "SELECT transaksi_masuk.order_id, transaksi_masuk.tgl, transaksi_masuk.user_nama, transaksi_masuk.nominal, transaksi_masuk.program, transaksi_masuk.status FROM transaksi_masuk WHERE YEAR(DATE(transaksi_masuk.tgl)) = '$per_tahun1' AND transaksi_masuk.user_nama LIKE '$user_nama' AND transaksi_masuk.status LIKE '$status' AND transaksi_masuk.program LIKE '$program' ORDER BY transaksi_masuk.tgl ASC";
            }
        }

        $rows = $this->db->query($query)->num_rows();
        if ($rows > 0) {
            $tmpTotal = 0;
            $data = array(
                'periodeHeader' => $ket_periode,
                'donaturHeader' =>  $ket_donatur,
                'programHeader' => $ket_program,
                'statusHeader' => $ket_status,
                'dataTransaksi' => array(),
                'total' => 'Rp 0'
            );
            $dataTrs = $this->db->query($query)->result_array();
            foreach ($dataTrs as $d) {
                $tmpTotal = $tmpTotal + $d['nominal'];
                $add = [
                    'order_id' => $d['order_id'],
                    'tgl' => date('d', strtotime($d['tgl'])) . '/' . month(date('n', strtotime($d['tgl'])), 'mmm') . '/' . date('Y', strtotime($d['tgl'])),
                    'user_nama' => $d['user_nama'],
                    'program' => $d['program'],
                    'nominal' => format_rupiah($d['nominal']),
                    'status' => $d['status']
                ];
                array_push($data['dataTransaksi'], $add);
            }
            $data['total'] = 'Rp ' . format_rupiah($tmpTotal);
        } else {
            $data = array(
                'periodeHeader' => $ket_periode,
                'donaturHeader' =>  $ket_donatur,
                'programHeader' => $ket_program,
                'statusHeader' => $ket_status,
                'dataTransaksi' => array(),
                'total' => 'Rp 0'
            );
        }
        return $data;
    }

    public function getPetugasLaporan()
    {
        return $this->db->select('DISTINCT(petugas) AS petugas')->get('transaksi_keluar')->result_array();
    }

    public function dataReportTransaksiKeluar($program, $periode_lap, $petugas, $post)
    {
        if ($petugas == 'semua') {
            $petugas = '%';
            $ket_petugas = 'Semua';
        } else {
            $ket_petugas = $petugas;
        }

        if ($program == 'semua') {
            $program = '%';
            $ket_program = "Semua";
        } else {
            $program = '%' . $program . '%';
            $ket_program = 'TIDAK BERNAMA';
        }

        if ($periode_lap == 'hari_ini') {
            $ket_periode = date('d', time()) . ' ' . month(date('n', time()), 'mmmm') . ' ' . date('Y', time());
            $query = "SELECT transaksi_keluar.id, transaksi_keluar.tgl, transaksi_keluar.petugas, transaksi_keluar.nominal, transaksi_keluar.program, transaksi_keluar.keterangan, transaksi_keluar.penerima_nama, transaksi_keluar.penerima_telp, transaksi_keluar.penerima_alamat_instansi FROM transaksi_keluar WHERE DATE(transaksi_keluar.tgl) = CURDATE() AND transaksi_keluar.petugas LIKE '$petugas' AND transaksi_keluar.program LIKE '$program' ORDER BY transaksi_keluar.tgl ASC";
        } else if ($periode_lap == 'bulan_ini') {
            $ket_periode = month(date('n', time()), 'mmmm') . ' ' . date('Y', time());
            $query = "SELECT transaksi_keluar.id, transaksi_keluar.tgl, transaksi_keluar.petugas, transaksi_keluar.nominal, transaksi_keluar.program, transaksi_keluar.keterangan, transaksi_keluar.penerima_nama, transaksi_keluar.penerima_telp, transaksi_keluar.penerima_alamat_instansi FROM transaksi_keluar WHERE MONTH(DATE(transaksi_keluar.tgl)) = MONTH(CURDATE()) AND transaksi_keluar.petugas LIKE '$petugas' AND transaksi_keluar.program LIKE '$program' ORDER BY transaksi_keluar.tgl ASC";
        } else if ($periode_lap == 'tahun_ini') {
            $ket_periode = 'Tahun ' . date('Y', time());
            $query = "SELECT transaksi_keluar.id, transaksi_keluar.tgl, transaksi_keluar.petugas, transaksi_keluar.nominal, transaksi_keluar.program, transaksi_keluar.keterangan, transaksi_keluar.penerima_nama, transaksi_keluar.penerima_telp, transaksi_keluar.penerima_alamat_instansi FROM transaksi_keluar WHERE YEAR(DATE(transaksi_keluar.tgl)) = YEAR(CURDATE()) AND transaksi_keluar.petugas LIKE '$petugas' AND transaksi_keluar.program LIKE '$program' ORDER BY transaksi_keluar.tgl ASC";
        } else if ($periode_lap == 'pertanggal') {
            $cek_tgl = (isset($post['label_tgl_akhir'])) ? 'yes' : 'false';
            $tgl_awal = $post['per_tanggal1'];
            if ($cek_tgl == 'yes') {
                $tgl_akhir = $post['per_tanggal2'];
                $ket_periode = date("d", strtotime($tgl_awal)) . " " . month(date("n", strtotime($tgl_awal)), 'mmmm') . " " . date("Y", strtotime($tgl_awal)) . " s.d. " . date("d", strtotime($tgl_akhir)) . " " . month(date("n", strtotime($tgl_akhir)), 'mmmm') . " " . date("Y", strtotime($tgl_akhir));
                $query = "SELECT transaksi_keluar.id, transaksi_keluar.tgl, transaksi_keluar.petugas, transaksi_keluar.nominal, transaksi_keluar.program, transaksi_keluar.keterangan, transaksi_keluar.penerima_nama, transaksi_keluar.penerima_telp, transaksi_keluar.penerima_alamat_instansi FROM transaksi_keluar WHERE (DATE(transaksi_keluar.tgl) BETWEEN '$tgl_awal' AND '$tgl_akhir') AND transaksi_keluar.petugas LIKE '$petugas' AND transaksi_keluar.program LIKE '$program' ORDER BY transaksi_keluar.tgl ASC";
            } else {
                $ket_periode = date("d", strtotime($tgl_awal)) . " " . month(date("n", strtotime($tgl_awal)), 'mmmm') . " " . date("Y", strtotime($tgl_awal));
                $query = "SELECT transaksi_keluar.id, transaksi_keluar.tgl, transaksi_keluar.petugas, transaksi_keluar.nominal, transaksi_keluar.program, transaksi_keluar.keterangan, transaksi_keluar.penerima_nama, transaksi_keluar.penerima_telp, transaksi_keluar.penerima_alamat_instansi FROM transaksi_keluar WHERE DATE(transaksi_keluar.tgl) = '$tgl_awal' AND transaksi_keluar.petugas LIKE '$petugas' AND transaksi_keluar.program LIKE '$program' ORDER BY transaksi_keluar.tgl ASC";
            }
        } else if ($periode_lap == 'perbulan') {
            $fm = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $cek_bln = (isset($post['label_bulan_akhir'])) ? 'yes' : 'false';
            $bulan1 = $post['per_bulan1'];
            $tahunbulan1 = $post['tahun_perbulan1'];
            if ($cek_bln == 'yes') {
                $bulan2 = $post['per_bulan2'];
                $tahunbulan2 = $post['tahun_perbulan2'];
                $tgl_awal = $tahunbulan1 . '-' . $bulan1 . '-01';
                $tgl_akhir = $tahunbulan2 . '-' . $bulan2 . '-31';
                $ket_periode =  $fm[$bulan1 - 1] . ' ' .  $tahunbulan1 . " s.d. " . $fm[$bulan2 - 1] . " " . $tahunbulan2;
                $query = "SELECT transaksi_keluar.id, transaksi_keluar.tgl, transaksi_keluar.petugas, transaksi_keluar.nominal, transaksi_keluar.program, transaksi_keluar.keterangan, transaksi_keluar.penerima_nama, transaksi_keluar.penerima_telp, transaksi_keluar.penerima_alamat_instansi FROM transaksi_keluar WHERE (DATE(transaksi_keluar.tgl) BETWEEN '$tgl_awal' AND '$tgl_akhir') AND transaksi_keluar.petugas LIKE '$petugas' AND transaksi_keluar.program LIKE '$program' ORDER BY transaksi_keluar.tgl ASC";
            } else {
                $ket_periode =  $fm[$bulan1 - 1] . " " . $tahunbulan1;
                $query = "SELECT transaksi_keluar.id, transaksi_keluar.tgl, transaksi_keluar.petugas, transaksi_keluar.nominal, transaksi_keluar.program, transaksi_keluar.keterangan, transaksi_keluar.penerima_nama, transaksi_keluar.penerima_telp, transaksi_keluar.penerima_alamat_instansi FROM transaksi_keluar WHERE (MONTH(DATE(transaksi_keluar.tgl)) = '$bulan1' AND YEAR(DATE(transaksi_keluar.tgl)) = '$tahunbulan1') AND transaksi_keluar.petugas LIKE '$petugas' AND transaksi_keluar.program LIKE '$program' ORDER BY transaksi_keluar.tgl ASC";
            }
        } else if ($periode_lap == 'pertahun') {
            $cek_thn = (isset($post['label_tahun_akhir'])) ? 'yes' : 'false';
            $per_tahun1 = $post['per_tahun1'];
            if ($cek_thn == 'yes') {
                $per_tahun2 = $post['per_tahun2'];
                $ket_periode = 'Tahun ' . $per_tahun1 . ' s.d. ' . $per_tahun2;
                $query = "SELECT transaksi_keluar.id, transaksi_keluar.tgl, transaksi_keluar.petugas, transaksi_keluar.nominal, transaksi_keluar.program, transaksi_keluar.keterangan, transaksi_keluar.penerima_nama, transaksi_keluar.penerima_telp, transaksi_keluar.penerima_alamat_instansi FROM transaksi_keluar WHERE (YEAR(DATE(transaksi_keluar.tgl)) BETWEEN '$per_tahun1' AND '$per_tahun2') AND transaksi_keluar.petugas LIKE '$petugas' AND transaksi_keluar.program LIKE '$program' ORDER BY transaksi_keluar.tgl ASC";
            } else {
                $ket_periode = 'Tahun ' . $per_tahun1;
                $query = "SELECT transaksi_keluar.id, transaksi_keluar.tgl, transaksi_keluar.petugas, transaksi_keluar.nominal, transaksi_keluar.program, transaksi_keluar.keterangan, transaksi_keluar.penerima_nama, transaksi_keluar.penerima_telp, transaksi_keluar.penerima_alamat_instansi FROM transaksi_keluar WHERE YEAR(DATE(transaksi_keluar.tgl)) = '$per_tahun1' AND transaksi_keluar.petugas LIKE '$petugas' AND transaksi_keluar.program LIKE '$program' ORDER BY transaksi_keluar.tgl ASC";
            }
        }

        $rows = $this->db->query($query)->num_rows();
        if ($rows > 0) {
            $tmpTotal = 0;
            $data = array(
                'periodeHeader' => $ket_periode,
                'petugasHeader' =>  $ket_petugas,
                'programHeader' => $ket_program,
                'dataTransaksi' => array(),
                'total' => 'Rp 0'
            );
            $dataTrs = $this->db->query($query)->result_array();
            foreach ($dataTrs as $d) {
                $tmpTotal = $tmpTotal + $d['nominal'];
                $add = [
                    'id' => $d['id'],
                    'tgl' => date('d', strtotime($d['tgl'])) . '/' . month(date('n', strtotime($d['tgl'])), 'mmm') . '/' . date('Y', strtotime($d['tgl'])),
                    'penerima_nama' => $d['penerima_nama'],
                    'penerima_telp' => $d['penerima_telp'],
                    'penerima_alamat_instansi' => $d['penerima_alamat_instansi'],
                    'keterangan' => $d['keterangan'],
                    'petugas' => $d['petugas'],
                    'program' => $d['program'],
                    'nominal' => format_rupiah($d['nominal'])
                ];
                array_push($data['dataTransaksi'], $add);
            }
            $data['total'] = 'Rp ' . format_rupiah($tmpTotal);
        } else {
            $data = array(
                'periodeHeader' => $ket_periode,
                'petugasHeader' =>  $ket_petugas,
                'programHeader' => $ket_program,
                'dataTransaksi' => array(),
                'total' => 'Rp 0'
            );
        }
        return $data;
    }
}
