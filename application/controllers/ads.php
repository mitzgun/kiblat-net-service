<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ads extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper('directory');
		$this -> load -> helper('file');
	}

	function index() {

		$map = directory_map('./ads');
		//$data['data'];
		foreach ($map as $key => $m) {
			$data['data'][$key]['name'] = $m;
			$data['data'][$key]['url'] = base_url() . 'ads/' . $m;

		}

		$this -> load -> view('ads', $data);
	}

	function hapus_ads() {
		$filename_dihapus = $this -> input -> get('url');
		unlink($filename_dihapus);
		redirect('ads');
	}

	function tambah() {
		$this -> load -> view('tambahimage');
	}

	function do_upload() {
		$config['upload_path'] = './ads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';

		$this -> load -> library('upload', $config);

		if (!$this -> upload -> do_upload()) {
			$error = array('error' => $this -> upload -> display_errors());

			$this -> load -> view('tambahimage', $error);
		} else {
			//$data = array('upload_data' => $this -> upload -> data());
			redirect('ads');
			//$this->load->view('upload_success', $data);
		}
	}

}
?>