<?php

use App\Controllers\BaseController;

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends BaseController {

    public $adminModel; 

    public function __construct() {
        parent::__construct();

        if (!is_logged_in()) {
            redirect('login'); // Redirect to login page if not logged in
        }
        
        $this->load->model('AdminModel', 'adminModel');
    }

    public function dashboard() {
        $data['content'] = 'admin/dashboard';
        $this->load->view('admin/main', $data);
    }

    public function quarters() {
        $data['quarters'] = $this->adminModel->get_quarters();

        $data['content'] = 'admin/quarters';
        $this->load->view('admin/main', $data);
    }

    public function activate_quarter() {
        $quarterid = $this->uri->segment(3);
        $this->adminModel->update_quarter_status($quarterid);
        $this->session->set_flashdata('update', true);
        redirect('admin/registry/quarters');
    }

    
}
