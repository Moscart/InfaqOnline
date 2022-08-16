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
                    'banner' => $banner
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
                        'banner' => $banner
                    ];
                } else $banner = false;
            } else {
                // gambar masih pakai yang lama, inisial update
                $data = [
                    'id_program' => $post['id_programEdit'],
                    'nama_detailprogram' => $post['nama_detailprogramEdit'],
                    'banner' => $post['bannerSubProgramOld']
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
        return $this->db->select('program AS nama_program, SUM(nominal) AS dana_program')->from('transaksi_masuk')->group_by('program')->get()->result_array();
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
        $detailProgram =  $this->db->select('nama_detailprogram, banner')->from('program_detail')->where('id_program', $id_program)->get()->result_array();
        $data = [];
        foreach ($detailProgram as $dp) {
            $add = [
                'nama_detailprogram' => $dp['nama_detailprogram'],
                'banner_detailprogram' => base_url('assets/img/program/') . $dp['banner']
            ];
            array_push($data, $add);
        }
        return $data;
    }
}
