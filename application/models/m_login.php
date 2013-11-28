<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_login extends CI_Model {

    public function getLoginData($usr, $pwd) {
        $u = mysql_real_escape_string($usr);
        $p = md5(mysql_real_escape_string($pwd));
        $q_cek_login = $this->db->get_where('wp_users', array('user_pass' => $u, 'user_pass' => $p));
        if (count($q_cek_login->result()) > 0) {
            foreach ($q_cek_login->result() as $qck) {
                foreach ($q_cek_login->result() as $qcd) {
                    $sess_data['logged_in'] = 'yesGetMeLogin';
                    $sess_data['username'] = $qcd->username;
                    $sess_data['nama_pengguna'] = $qcd->nama_pengguna;
                    $this->session->set_userdata($sess_data);
                }
                header('location:' . base_url() . 'index.php/ads');
            }
        } else {
            $this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
            header('location:' . base_url() . 'index.php/admin');
        }
    }

    function edit() {
        $d = $this->db->get_where('tb_admin', array('id_user' => 1))->row();
        return $d;
    }

    function update($a) {
        $nama = $this->input->post('nama');
        $uname = $this->input->post('uname');
        $oldpass = $this->input->post('oldpass');
        $pass = $this->input->post('newpass');
        $p = md5(mysql_real_escape_string($pass));
        $o = md5(mysql_real_escape_string($oldpass));
        $query = $this->db->query('select password FROM tb_admin where id_user='.$a)->row();
        $dbpass = $query->password;
        //print_r($dbpass);
        if ($o == $dbpass) {
            $data = array(
                'username' => $uname,
                'password' => $p,
                'nama_pengguna' => $nama);
            $this->db->where('id_user', $a);
            $this->db->update('tb_admin', $data);
            $this->session->set_flashdata('result_pass_true', 'Password berhasil di ubah.');
            header('location:' . site_url('admin/profil'));
        } else {
           $this->session->set_flashdata('result_pass', 'Password lama yang anda masukkan salah.');
            header('location:' . site_url('admin/profil'));
           //echo 'Password lama yang anda masukkan salah';
        }
    }

}

?>