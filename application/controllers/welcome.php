<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");	
		$this->load->database();
		$this->load->library('session');
		$this->load->library('encrypt');
	} 

	public function paste()
	{
		echo "Display Paste";
		$this->load->view("paste");	
	}
	
	public function upload()
	{
		$this->db->insert("image",array("session_id"=>$this->session->userdata("session_id"),"image"=>			                            $_REQUEST["html"], "datetime"=>date("Y/m/d H:i:s")));
		echo "Added to Photo Gallery";
	}
	
	public function create_gallery()
	{
		//var_dump($_REQUEST);
		$title=$this->input->post("title");		
		$des=$this->input->post("des");
		$respo=$this->db->insert("gallery",array("session_id"=>$this->session->userdata("session_id"),"title"=>$title,"description"=>$des, "datetime"=>date("Y/m/d H:i:s")));
		if(isset($respo)){
		$this->db->select("*")->from("gallery")->where("session_id",$this->session->userdata("session_id"));
		$query=$this->db->get();
		$get_url=$query->row_array();
		//echo $this->encrypt->encode($get_url["session_id"]);
		//echo $this->encrypt->encode($get_url["id"]);
		echo "Please note this URL <br /><a style='color:#0000ff; text-decoration:underline;'>".base_url("welcome/my_gallery")."/".$get_url["session_id"]."/".$get_url["id"]."</a>";
		$this->session->sess_destroy();
		}
		else
		{
		 	echo "gallery could not be created";	
		}
		
	}
	
	public function my_gallery($sess,$id)
	{
		//$key="DU709dbvoSSE0gntNQjBwn5Z0725w3T1";
		//echo $sess;
		//echo "<br>".$id;
		$this->db->select("*");
		$this->db->from("image");	
		$this->db->where("session_id",$sess);
		$query=$this->db->get();
		$data["file"]=$query->result_array();
		$this->load->view("display",$data);
	}
	

	public function display()
	{
		$this->db->select("*");
		$this->db->from("image");
		$query=$this->db->get();
		$data["file"]=$query->result_array();
		$this->load->view("display",$data);
	}
	

	

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
