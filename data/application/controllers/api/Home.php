<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->auth = ['webapp', '1122334455'];
        $this->app_key = 'WFQIXQj2Lp4xv3mQZ5UWu6RaUiJxoZw7';
        $this->client = new Client([
            'base_uri' => 'http://localhost/pupuk_kujang/api/',
            'auth' => $this->auth,
            'query' => ['X-API-KEY' => $this->app_key],
        ]);
    }

    public function index()
    {
        $data = ['query' => ['X-API-KEY' => $this->app_key]];
        $read_data = $this->client->request('GET', 'karyawan/get_all/', $data);
        if ($read_data->getStatusCode() == '200') {
            $result = json_decode($read_data->getBody()->getContents(), TRUE);
            print_r($result['EMP']);
        }
    }
}
