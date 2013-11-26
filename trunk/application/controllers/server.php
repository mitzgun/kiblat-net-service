<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 */
class Server extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('post');
		$this -> load -> library('xmlrpc');
		$this -> load -> library('xmlrpcs');
		$this -> load -> library('simple_html_dom');
	}

	public function index() {

		$config['functions']['getPost'] = array('function' => 'server.getPost');
		$config['functions']['getPopularTag'] = array('function' => 'server.getPopularTag');
		$config['functions']['getPostbyIdTag'] = array('function' => 'server.getPostbyIdTag');
		$config['functions']['getPopularPost'] = array('function' => 'server.getPopularPost');
		$config['functions']['tes'] = array('function' => 'server.tes');
		$config['functions']['search'] = array('function' => 'server.search');
		$config['functions']['beritaterkini'] = array('function' => 'server.beritaterkini');
		$config['functions']['beritapopuler'] = array('function' => 'server.beritapopuler');
		$config['functions']['beritabyidkategori'] = array('function' => 'server.beritabyidkategori');
		$this -> xmlrpcs -> initialize($config);
		$this -> xmlrpcs -> serve();
	}

	function beritaterkini($request) {
		$parameters = $request -> output_parameters();
		$data = $this -> post -> beritaterkini($parameters['0']);
		foreach ($data as $key => $d) {
			$html = new Simple_html_dom();
			$html -> load($d['content']);
			$content = $html -> plaintext;
			$url_img = $this -> post -> getimagebyidpost($d['ID']);
			$data[$key]['content'] = substr(str_replace("\\", '/', $content), 0, 50);
			$data[$key]['img'] = $url_img;
		}
		//print_r($data);

		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}

	function beritapopuler($request) {
		$parameters = $request -> output_parameters();
		$data = $this -> post -> beritapopuler();
		foreach ($data as $key => $d) {
			$html = new Simple_html_dom();
			$html -> load($d['content']);
			$content = $html -> plaintext;
			$url_img = $this -> post -> getimagebyidpost($d['ID']);
			$data[$key]['content'] = substr(str_replace("\\", '/', $content), 0, 50);
			$data[$key]['img'] = $url_img;
		}
		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}

	function beritabyidkategori($request) {
		$parameters = $request -> output_parameters();
		$data = $this -> post -> beritabyidkategori($parameters[0], $parameters[1]);
		foreach ($data as $key => $d) {
			$html = new Simple_html_dom();
			$html -> load($d['content']);
			$content = $html -> plaintext;
			$url_img = $this -> post -> getimagebyidpost($d['ID']);
			$data[$key]['content'] = substr(str_replace("\\", '/', $content), 0, 50);
			$data[$key]['img'] = $url_img;
		}
		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}

	function getPost() {
		$data = $this -> post -> selectPost();
		foreach ($data as $key => $d) {
			$html = new Simple_html_dom();
			$html -> load($d['post_content']);
			$content = $html -> plaintext;
			$url_img = $this -> post -> getimagebyidpost($d['ID']);
			$data[$key]['post_content'] = str_replace("\\", '/', $content);
			$data[$key]['img'] = $url_img;

		}
		//print_r($data);

		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}

	function getPopularPost() {
		$data = $this -> post -> popularpost();
		foreach ($data as $key => $d) {
			$html = new Simple_html_dom();
			$html -> load($d['post_content']);
			$content = $html -> plaintext;
			$url_img = $this -> post -> getimagebyidpost($d['ID']);
			$data[$key]['post_content'] = str_replace("\\", '/', $content);
			;
			$data[$key]['img'] = $url_img;
		}
		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}

	function tes() {

		return $this -> xmlrpc -> send_response(date('Y-m-d'));
	}

	function getPopularTag() {
		$data = $this -> post -> populartag();
		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}

	function getPostbyIdTag() {
		$data = $this -> post -> postbyidtag(21);
		foreach ($data as $key => $d) {
			$html = new Simple_html_dom();
			$html -> load($d['post_content']);
			$content = $html -> plaintext;
			$data[$key]['post_content'] = str_replace("\\", '/', $content);
		}

		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}

	function search($request) {
		$parameters = $request -> output_parameters();
		$data = $this -> post -> search($parameters['0']);
		foreach ($data as $key => $d) {
			$html = new Simple_html_dom();
			$html -> load($d['content']);
			$content = $html -> plaintext;
			$url_img = $this -> post -> getimagebyidpost($d['ID']);
			$data[$key]['content'] = str_replace("\\", '/', $content);
			$data[$key]['img'] = $url_img;
		}
		//print_r($data);

		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
