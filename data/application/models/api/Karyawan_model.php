<?php defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->order_by('NO_BADGE', 'asc');
        $read = $this->db->get('m_karyawan');
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

    function search($data)
    {
        if (empty($data['cari']) || $data['cari'] == NULL) {
            $response = array(
                'EMP' => FALSE
            );
        } else {
            $cari = $data['cari'];
            $this->db->distinct();
            $this->db->select('k.*');
            $this->db->from('m_karyawan k');
            $this->db->join('m_keluarga l', 'l.NO_BADGE=k.NO_BADGE', 'left');
            $this->db->like('k.NAMA', $cari);
            $this->db->or_like('k.NO_BADGE', $cari);
            $this->db->or_like('l.NAMA', $cari);
            $this->db->order_by('k.NO_BADGE', 'asc');

            $read = $this->db->get();
            if ($read->num_rows() > 0) {
                $response = array(
                    'EMP' => $read->result_array(),
                );
            } else {
                $response = array(
                    'EMP' => false,
                );
            }
        }
        return $response;
    }
}
