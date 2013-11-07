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
	}

	public function index() {
		$this -> load -> library('xmlrpc');
		$this -> load -> library('xmlrpcs');
		$config['functions']['getPost'] = array('function' => 'server.getPost');
		$config['functions']['getPopularTag'] = array('function' => 'server.getPopularTag');
		$config['functions']['getPostbyIdTag'] = array('function' => 'server.getPostbyIdTag');
		$this -> xmlrpcs -> initialize($config);
		$this -> xmlrpcs -> serve();
	}

	function getPost() {
		$data = $this -> post -> selectPost();
		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}

	function getPopularTag() {
		$data = $this -> post -> populartag();
		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}
	
	function getPostbyIdTag() {
		//$parameters = $request -> output_parameters();
		//$id=$parameters['0'];
		$data = $this -> post -> postbyidtag(21);
		$response = array(json_encode($data));
		return $this -> xmlrpc -> send_response($response);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
