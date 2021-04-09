<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = ['query' => ['X-API-KEY' => $this->app_key]];
        $read_data = $this->client->request('GET', 'karyawan/get_all/', $data);
        if ($read_data->getStatusCode() == '200') {
            $result = json_decode($read_data->getBody()->getContents(), TRUE);
            $this->data['karyawan'] = $result['EMP'];
        }

        $this->data['lakilaki'] = 0;
        $this->data['perempuan'] = 0;
        $this->data['jumlahjabatan'] = NULL;
        $this->data['namajabatan'] = NULL;
        foreach ($this->data['karyawan'] as $index => $karyawan) {
            $this->data['jeniskelamin'][$index] = $karyawan['JK'];
            if ($karyawan['JK'] == "Male") {
                $this->data['lakilaki']++;
            }
            if ($karyawan['JK'] == "Female") {
                $this->data['perempuan']++;
            }

            $this->data['namajabatan'] = $this->data['namajabatan'] . "'" . $karyawan['DETAIL_JABATAN']['DESC'] . "', ";
            $kd_jabatan = $karyawan['DETAIL_JABATAN']['KD_JABATAN'];
            $jumlahjabatan[$kd_jabatan] = 0;
        }

        foreach ($this->data['karyawan'] as $index => $karyawan) {
            $kd_jabatan = $karyawan['DETAIL_JABATAN']['KD_JABATAN'];
            $jumlahjabatan[$kd_jabatan] = $jumlahjabatan[$kd_jabatan] + 1;
        }

        foreach ($jumlahjabatan as $jabatan) {
            $this->data['jumlahjabatan'] = $this->data['jumlahjabatan'] . "'" . $jabatan . "', ";
        }
        $this->data['page_title'] = "Dashboard";
        $this->load->view('web/home', $this->data);
    }

    public function cari()
    {
        $this->data['page_title'] = "Cari Data";
        $this->load->view('web/home', $this->data);
    }
}
