<?php defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class MY_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->auth = ['webapp', 'uw-w!|ds2^9#3+f'];
        $this->app_key = 'zK8znMHjlwmzmA56XatOkwoKS7QoYA6Q';
        $this->client = new Client([
            'base_uri' => 'http://localhost/pptppa/api/',
            'auth' => $this->auth,
            'query' => ['X-API-KEY' => $this->app_key],
        ]);

        $this->load->model(['web/Setting_model', 'web/Log_model']);
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

    public function _setting($name)
    {
        $data['settings'] = $this->Setting_model->get_all_settings()['content'];
        foreach ($data['settings'] as $settings) {
            $_data[$settings['name']] = $settings['value'];
        }
        return $_data[$name];
    }
}
