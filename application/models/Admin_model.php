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
        $karakter = 'QASZDCXWERVRTCYFGHCBVNMKNYIOIPGLMAGEZACUOQNDFTUZMXRJKOAMWPEXBUQI';
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
}
