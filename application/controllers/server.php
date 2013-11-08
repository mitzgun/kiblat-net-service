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

		$config['functions']['GetPost'] = array('function' => 'server.getPost');
		$config['functions']['getPopularTag'] = array('function' => 'server.getPopularTag');
		$config['functions']['getPostbyIdTag'] = array('function' => 'server.getPostbyIdTag');
		$config['functions']['tes'] = array('function' => 'server.tes');
		$this -> xmlrpcs -> initialize($config);
		$this -> xmlrpcs -> serve();
	}

	function getPost() {
		$data = $this -> post -> selectPost();
		foreach ($data as $key => $d) {
			$html = new Simple_html_dom();
			$html -> load($d['post_content']);
			$content = $html -> plaintext;
			$data[$key]['post_content'] = str_replace("\\", '/', $content);
		}
		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}
	
	function tes() {
		
		return $this -> xmlrpc -> send_response('tes');
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
