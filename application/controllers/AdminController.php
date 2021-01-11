<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
        $this->load->model('AdminModel');
        // if(!$this->session->userdata('user_login'))
		// { 
        //     redirect(base_url("AdminController/loginpage"));
        // }
        // else
        // {
        //     redirect(base_url('AdminController/listProyek'));
        // }
    }

    public function show_form()
    {
        $this->load->view('formlogin');
    }

    public function login()
    {
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);
        $user = $this->AdminModel->login($email, $password);
        if ($user)
        {
            $data_session = array(
                'id' => $user->id,
                'email' => $user->email,
                'password' => $user->password,
            );
            $this->session->set_userdata('user_login',$data_session);
            redirect(base_url('ListProyekController/listProyek'));
        }
        else
        {
            $this->session->set_flashdata('message', array('type' => 'error', 'message' => "Email atau password tidak sesuai!"));
            redirect(base_url("AdminController/login")); 
        }
    }    
}