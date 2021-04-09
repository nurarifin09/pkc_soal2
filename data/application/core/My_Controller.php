<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = array();
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');

        $this->load->model(['web/Setting_model', 'web/Log_model']);
        $this->data['settings'] = $this->Setting_model->get_all_settings()['content'];
        foreach ($this->data['settings'] as $settings) {
            $this->data[$settings['name']] = $settings['value'];
        }
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

    function add_log($message)
    {
        $params = array(
            'id_user' => (isset($this->ion_auth->user()->row()->id)) ? $this->ion_auth->user()->row()->id : NULL,
            'time' => time(),
            'ip' => $this->input->ip_address(),
            'referrer_url' => $_SERVER['HTTP_REFERER'],
            'current_url' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'messages' => serialize([
                'message' => $message,
                'data' => base64_encode(serialize((!empty($this->input->post())) ? $this->input->post() : NULL)),
            ]),
        );
        $this->Log_model->add_log($params);
    }
}

class User_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('message', 'Silahkan lakukan login terlebih dahulu!');
            redirect('auth/login/', 'refresh');
        }

        if ($this->ion_auth->in_group('admin')) {
            $this->data['in_group'] = "admin";
        } else if ($this->ion_auth->in_group('satgas')) {
            $this->data['in_group'] = "satgas";
        } else if ($this->ion_auth->in_group('pendamping')) {
            $this->data['in_group'] = "pendamping";
        } else {
            $this->data['in_group'] = "pelapor";
        }
        $this->load->model(['web/Users_model', 'web/Identity_model', 'web/Notifikasi_model']);
        $this->load->library('breadcrumbs');
        $this->breadcrumbs->push('Dashboard', '/dashboard/');
        $this->data['user'] = $this->Users_model->get_user($this->ion_auth->user()->row()->id)['content'];
        $this->data['identity'] = $this->Identity_model->get_identity($this->ion_auth->user()->row()->id)['content'];

        //////////// NOTIFIKASI APLIKASI ////////////
        $this->data['notifikasi'] = $this->Notifikasi_model->get_all($this->ion_auth->user()->row()->id)['content'];
        $hitung = 0;
        if ($this->data['notifikasi'] != NULL) {
            foreach ($this->data['notifikasi'] as $index => $notif) {
                $this->data['notifikasi'][$index]['waktu'] = $this->time_elapsed_string($notif['waktu'], TRUE);
                if ($notif['status'] == 0) {
                    $this->data['counter']['notif_unread'] = $hitung + 1;
                } else {
                    $this->data['counter']['notif_unread'] = $hitung;
                }
            }
        }
        //////////// NOTIFIKASI APLIKASI ////////////

        $this->data['theme'] = $this->data['user']['theme'];
        $this->data['page_title'] = 'Dashboard';
    }

    private function time_elapsed_string($datetime)
    {
        $etime = time() - $datetime;

        if ($etime < 1) {
            return '0 seconds';
        }

        $a = array(
            365 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60  =>  'month',
            24 * 60 * 60  =>  'day',
            60 * 60  =>  'hour',
            60  =>  'minute',
            1  =>  'second'
        );
        $a_plural = array(
            'year'   => 'years',
            'month'  => 'months',
            'day'    => 'days',
            'hour'   => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }
}

class Admin_Controller extends User_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->in_group('admin')) {
            redirect('auth/login/', 'refresh');
        }

        $this->data['notification'] = '';
    }
}
