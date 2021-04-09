<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RESTController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Karyawan extends RESTController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('api/karyawan_model');
    }

    function get_all_get()
    {
        $data = $this->karyawan_model->get_all($this->get());
        foreach ($data["EMP"] as $index => $d) {
            $data["EMP"][$index]['DETAIL_JABATAN'] = $this->karyawan_model->get_detail_jabatan($d['KD_JABATAN']);
            $data["EMP"][$index]['FAMILY'] = $this->karyawan_model->get_detail_family($d['NO_BADGE']);
        }
        $this->response($data, RESTController::HTTP_OK);
    }

    function get_jabatan_by_id_get()
    {
        $data = $this->karyawan_model->get_detail_jabatan($this->get());
        $this->response($data, RESTController::HTTP_OK);
    }

    function search_get()
    {
        $data = $this->karyawan_model->search($this->get());
        $this->response($data, RESTController::HTTP_OK);
    }
}
