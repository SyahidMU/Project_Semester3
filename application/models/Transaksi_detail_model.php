<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_detail_model extends CI_Model{

	function get_jam_mulai_terpakai($tanggal, $paket_id){
		$this->db->select('jam_mulai, durasi, jam_selesai');
		$this->db->where('tanggal', $tanggal);
		$this->db->where('paket_id', $paket_id);
		return $query = $this->db->get('transaksi_detail')->result();

		// $sql = "
		// 		SELECT
		// 			jam_mulai, durasi, jam_selesai
		// 		FROM photo_studio_transaksi_detail
		// 		where
		// 			tanggal = ? and paket_id = ?
		// 		";
		// $query = $this->db->query($sql, array($tanggal, $paket_id));
		//
		// return $query->result();
	}
}
