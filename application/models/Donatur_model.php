<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donatur_model extends CI_Model
{
    public function getDataChart($email)
    {
        return $this->db->query("SELECT DATE_FORMAT(transaksi_masuk.tgl , '%m') AS bulan, YEAR(transaksi_masuk.tgl) AS tahun, SUM(transaksi_masuk.nominal) AS nominal FROM transaksi_masuk WHERE transaksi_masuk.status = 'settlement' AND transaksi_masuk.user_email = '$email' GROUP BY MONTH(transaksi_masuk.tgl) ORDER BY transaksi_masuk.tgl ASC LIMIT 12")->result_array();
    }

    public function getTotalInfaqDonatur($email)
    {
        return $this->db->select('SUM(nominal) AS total')->from('transaksi_masuk')->where(['user_email' => $email, 'status' => 'settlement'])->get()->row_array();
    }

    public function countStatusPending($email)
    {
        return $this->db->select('COUNT(order_id) AS pending_count')->from('transaksi_masuk')->where(['user_email' => $email, 'status' => 'pending'])->get()->row_array();
    }

    public function getTotalNominalPending($email)
    {
        return $this->db->select('SUM(nominal) AS pending_total')->from('transaksi_masuk')->where(['user_email' => $email, 'status' => 'pending'])->get()->row_array();
    }

    public function getHistoryDonatur($email)
    {
        return $this->db->select('tgl, order_id, nominal, status, program, pdf_url')->from('transaksi_masuk')->where('user_email', $email)->get()->result_array();
    }
}
