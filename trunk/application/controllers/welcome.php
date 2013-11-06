<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('post');
	}
	public function index()
	{
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
		$config['functions']['getPost'] = array('function' => 'welcome.getPost');
		$this->xmlrpcs->initialize($config);
        $this->xmlrpcs->serve();
	}

	function getPost(){
		$data = $this->post->selectPost();
		 $response = array(json_encode($data));
        return $this->xmlrpc->send_response($response);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */