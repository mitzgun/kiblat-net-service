<?php

if (!defined('BASEPATH'))
    exit('No Direct Access Allowed !');

class admin extends CI_Controller {
    /* Controller untuk  manajemen routing */

    function __construct() {
        parent::__construct();
		$this->load->model('m_login');
        $this->load->helper(array('url', 'form'));
    }

    public function index() {
    	
        $cek = $this->session->userdata('logged_in');
        if (empty($cek)) {
            $this->load->view("login");
        } else {
            header('location:' . site_url('/ads'));
        }
    }

    public function login() {
        $cek = $this->session->userdata('logged_in');
        if (empty($cek)) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view("admin/login/index");
            } else {
                $u = $this->input->post('username');
                $p = $this->input->post('password');
                $this->m_login->getLoginData($u, $p);
            }
        } else {
            redirect('admin');
        }
    }

    function profil() {
        $cek = $this->session->userdata('logged_in');
        if (empty($cek)) {
            header('location:' . site_url('admin'));
        } else {
            $dt = $this->m_login->edit();
            $d['nama'] = $dt->nama_pengguna;
            $d['uname'] = $dt->username;
            $d['pass'] = "";
            $d['id'] = $dt->id_user;
            $this->load->view('admin/global/header');
            $this->load->view('admin/user/edit', $d);
            $this->load->view('admin/global/footer');
        }
    }

    function simpan() {
        $cek = $this->session->userdata('logged_in');
        if (empty($cek)) {
            header('location:' . site_url('admin'));
        } else {
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('uname', 'Username', 'trim|required');
            $this->form_validation->set_rules('oldpass', 'Password lama', 'trim|required');
            $this->form_validation->set_rules('newpass', 'Password baru', 'trim|required|min_length[6]');
            if ($this->input->post('submit')) {
                if ($this->form_validation->run() == FALSE) {
                    $d['nama'] = $this->input->post('nama');
                    $d['uname'] = $this->input->post('uname');
                    $d['pass'] = $this->input->post('oldpass');
                    $d['id'] = $this->input->post('id');
                    $this->load->view('admin/global/header');
                    $this->load->view('admin/user/edit', $d);
                    $this->load->view('admin/global/footer');
                } else {
                    $a = $this->input->post('id');
                    $this->m_login->update($a);
                    $nm = $this->m_login->edit();
                    $n = $nm->nama_pengguna;
                    $this->session->set_userdata('nama_pengguna', $n);
                   // $this->session->set_flashdata('result_pass', 'Password sudah berhasil diubah.');
                    header('location:' . site_url('admin/profil'));
                }
            }
        }
    }

    function logout() {
        $this->session->sess_destroy();
        header('location:' . site_url(''));
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
