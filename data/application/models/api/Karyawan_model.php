<?php defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{
    public $table = 'm_karyawan';

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->order_by('NO_BADGE', 'asc');
        $read = $this->db->get($this->table);
        if ($read->num_rows() > 0) {
            $response = array(
                'EMP' => $read->result_array(),
            );
        } else {
            $response = array(
                'EMP' => false,
            );
        }
        return $response;
    }

    function get_detail_jabatan($data)
    {
        $read = $this->db->get_where("m_jabatan", ['KD_JABATAN' => $data]);
        if ($read->num_rows() > 0) {
            $response = $read->row_array();
        } else {
            $response = array(
                'id tidak ditemukan',
            );
        }
        return $response;
    }

    function get_detail_family($data)
    {
        $read = $this->db->get_where("m_keluarga", ['NO_BADGE' => $data]);
        if ($read->num_rows() > 0) {
            $response = $read->result_array();
        } else {
            $response = array(
                'id tidak ditemukan',
            );
        }
        return $response;
    }

}
