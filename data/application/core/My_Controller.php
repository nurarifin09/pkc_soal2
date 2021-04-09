<?php defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class MY_Controller extends CI_Controller
{
    protected $data = array();
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

    public function _debug($value, $die = FALSE)
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        if ($die == TRUE) {
            die();
        }
    }

}
