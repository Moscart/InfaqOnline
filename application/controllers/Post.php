<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function index()
    {
        echo json_encode([
            'response' => [
                'code' => 200,
                'description' => 'Ok'
            ],
            'url' => [
                'tambah data transaksi masuk' => base_url('post/addtransaksiMasuk')
            ]
        ]);
    }

    public function addTransaksiMasuk()
    {
        // set form validation
        $this->form_validation->set_rules('order_id', 'ID order', 'trim|required|is_unique[transaksi_masuk.order_id]', [
            'is_unique' => 'Id order ini sudah terdaftar.'
        ]);
        $this->form_validation->set_rules('tgl', 'Tanggal transaksi', 'trim|required');
        $this->form_validation->set_rules('user_nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('user_telp', 'No. HP', 'trim');
        $this->form_validation->set_rules('nominal', 'Nominal', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('program', 'Program', 'trim');
        if ($this->form_validation->run() == false) {
            echo json_encode([
                'response' => [
                    'code' => 501,
                    'description' => 'kesalahan saat validasi inputan'
                ],
                'ketentuan_post' => [
                    'order_id' => [
                        'type' => 'int',
                        'maxlength' => '11',
                        'syntax' => ['PHP' => "rand()"],
                        'example' => rand(),
                        'validation' => 'trim|required|is_unique[transaksi_masuk.order_id]'
                    ],
                    'tgl' => [
                        'type' => 'datetime',
                        'maxlength' => '',
                        'syntax' => ['PHP' => "date('Y-m-d H:i:s', time())"],
                        'example' => date('Y-m-d H:i:s', time()),
                        'validation' => 'trim|required'
                    ],
                    'user_nama' => [
                        'type' => 'varchar',
                        'maxlength' => '50',
                        'syntax' => "",
                        'example' => 'Ibu Budi',
                        'validation' => 'trim|required'
                    ],
                    'user_email' => [
                        'type' => 'varchar',
                        'maxlength' => '128',
                        'syntax' => "",
                        'example' => 'contoh@email.com',
                        'validation' => 'trim|valid_email'
                    ],
                    'user_telp' => [
                        'type' => 'varchar',
                        'maxlength' => '15',
                        'syntax' => "",
                        'example' => '085123890456',
                        'validation' => 'trim|valid_email'
                    ],
                    'nominal' => [
                        'type' => 'int',
                        'maxlength' => '11',
                        'syntax' => [
                            'PHP' => "format_rupiah(1000)",
                            'JavaScript on input (object)' => 'input type="text" name="nominal" id="nominal" onkeyup="convertToRupiah(this);"',
                            'JavaScript on scripting (integer)' => 'convertToRupiahInt(angka)'
                        ],
                        'example' => '1.000',
                        'validation' => 'trim|required'
                    ],
                    'status' => [
                        'type' => 'varchar',
                        'maxlength' => '15',
                        'syntax' => [
                            'pending' => 'Transaksi berhasil dibuat dan menunggu pembayaran oleh customer melalui (ATM/ebanking/E-wallet app/ store).',
                            'capture' => 'Transaksi kartu berhasil dilakukan. Jika tidak dilakukan manual, Transaksi akan otomatis berubah menjadi settlement pada hari selanjutnya.',
                            'settlement' => 'Dana telah diterima, Transaksi berhasil. Status transaksi capture aman untuk dianggap sebagai pembayaran yang berhasil.',
                            'deny' => 'Payment provider / Fraud Detection System menolak kredensial yang digunakan untuk pembayaran. Anda dapat melihat detail/alasan transaksi tersebut ditolak pada nilai parameter status_message.',
                            'cancel' => 'Transaksi dibatalkan. pembatalan transaksi dapat dilakukan oleh Midtrans atau merchant.',
                            'expire' => 'Transaksi sudah tidak tersedia / kadaluarsa, dikarenakan tidak ada pembayaran yang diterima atau lewat dari batas waktu yang telah ditentukan.',
                            'failure' => 'Kesalahan tak terduga selama pemrosesan transaksi. Kegagalan transaksi dapat disebabkan oleh berbagai alasan, sebagian besar masalah ini terjadi dikarenakan seperti bank gagal memberikan respons (time-out) dan kasus ini sangat jarang terjadi.',
                            'refund' => 'Refund dapat dilakuan oleh Merchant. Transaksi akan ditandai sebagai refund.',
                            'partial_refund' => 'Transaksi ditandai sebagai partial refund.',
                            'partial_chargeback' => 'Transaksi ditandai sebagai partial chrgeback.',
                        ],
                        'example' => 'settlement',
                        'validation' => 'trim|required'
                    ],
                    'program' => [
                        'type' => 'varchar',
                        'maxlength' => '100',
                        'syntax' => $this->db->select('nama_detailprogram')->get('program_detail')->result_array(),
                        'example' => 'Infak',
                        'validation' => 'trim'
                    ],
                ]
            ]);
        } else {
            // insert data
            if ($this->db->insert('transaksi_masuk', [
                'order_id' => htmlspecialchars($this->input->post('order_id')),
                'tgl' => htmlspecialchars($this->input->post('tgl')),
                'user_nama' => htmlspecialchars($this->input->post('user_nama')),
                'user_email' => htmlspecialchars($this->input->post('user_email')),
                'user_telp' => htmlspecialchars($this->input->post('user_telp')),
                'nominal' => reset_rupiah($this->input->post('nominal')),
                'status' => htmlspecialchars($this->input->post('status')),
                'program' => htmlspecialchars($this->input->post('program'))
            ])) echo json_encode([
                'response' => [
                    'code' => 201,
                    'description' => 'Berhasil menyimpan data transaksi masuk'
                ],
            ]);
            else echo json_encode([
                'response' => [
                    'code' => 501,
                    'description' => 'kesalahan saat input database'
                ],
            ]);
        }
    }
}
