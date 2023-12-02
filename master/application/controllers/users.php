<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	

		public function __construct()
		{
		parent::__construct();
		$this->load->model('Users_Model');
		
		}


		public function actions()
	{



		if ($_GET["action"] == "delete") {
		$this->delete($_POST['user_id']);
		//Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }else if ($_GET["action"] == "update") {
    	$post_data=$this->input->post();
        $edit_id=$post_data['user_id'];
        unset($post_data['user_id']);
        $get_results=$this->Users_Model->update_users($post_data,$edit_id);
        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }
    //Creating a new record (createAction)
    else if ($_GET["action"] == "create") {

    		$_POST['access_level']='ACC-4';

$get_results=$this->Users_Model->insert_users($_POST);
 setcookie("addedStudent", serialize($_POST), time()+2);

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Record'] = $_POST;
        print json_encode($jTableResult);
    }
//Getting records (listAction)
elseif ($_GET["action"] == "list") {
$get_all_userss=$this->Users_Model->get_all_users();
$rows = array();$json_length_updated=0;
if($get_all_userss['num_rows']>0){
	$json=json_encode($get_all_userss['results'],true);
$json = json_decode($json, true);
$json_length = sizeof($json);
$json_updated = $json;
$json_length_updated = sizeof($json_updated);

$start = $_GET["jtStartIndex"];
$pageSize = $_GET["jtPageSize"];
$page_length = ($start+$pageSize < $json_length_updated) ? $start+$pageSize : $json_length_updated;


for($i=$start;$i<$page_length;$i++){
$rows[] = $json_updated[$i];
}
}


$jTableResult['Result'] = "OK";
$jTableResult['TotalRecordCount'] = $json_length_updated;
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);
}

   

	}

	public function index()
	{


		$this->load->view('manage_user');
	}

	public function edit($edit_id='')
	{

$data['error_msg']='';
$data['success_msg']='';
$edit_id=($edit_id!=null)?$edit_id:$this->session->userdata('admin_data')['user_id'];

if($this->input->post('change')!=null){
$this->form_validation->set_rules('new_password', 'Current Password', 'trim|matches[hdnpassword]|xss_clean');
$this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]|xss_clean');
$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean');

	if ($this->form_validation->run() == TRUE)
		{ 
			$post_data['password']=$this->input->post('password');
			$get_pass_results=$this->Users_Model->update_users_password($post_data,$edit_id);
			if(is_string($get_pass_results)){
				$data['error_msg']=$get_pass_results;
			}else{
				$data['success_msg']='Successfully changed your password';
			}
			
		}

}else{
$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique_edit['.ADMIN.'.user_email.user_id.'.$edit_id.']|xss_clean');
$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|xss_clean');
$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
$this->form_validation->set_rules('access_level', 'Access Level', 'trim|required|xss_clean');	

if ($this->form_validation->run() == TRUE)
		{ 
			$post_data=$this->input->post();
			$get_results=$this->Users_Model->update_users($post_data,$edit_id);
			if(is_string($get_results)){
				$data['error_msg']=$get_results;
			}else{
				$data['success_msg']='Successfully updated admin details';
			}
			
		}


}

		$get_all_userss=$this->Users_Model->get_edit_userss($edit_id);
		$data['edit_userss']=$get_all_userss;
		$this->load->view('edit_users',$data);
	}


			public function add()
			{


			$data['error_msg']='';
			$data['success_msg']='';
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique['.ADMIN.'.user_email]|xss_clean');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('access_level', 'Access Level', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]|xss_clean');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean');
			if ($this->form_validation->run() == TRUE)
			{ 
			$post_data=$this->input->post();
			unset($post_data['passconf']);
			$post_data['access_level']='ACC-4';

			$get_results=$this->Users_Model->insert_users($post_data);
			if(is_string($get_results)){
			$data['error_msg']=$get_results;
			}else{
			$data['success_msg']='Successfully added admin details';
			}

			}
			$this->load->view('edit_users',$data);
			}
			public function	delete($id){
			$this->db->where('user_id',$id);
			$result=$this->db->delete(ADMIN);
			return $result;
			}

			public function	inactive($id){
			$this->db->where_in('user_id',$id);
			$result=$this->db->update(ADMIN,array('user_status' => 'Inactive' ));
			return $result;
			}
			public function	active($id){
			
			$this->db->where_in('user_id',$id);
			$result=$this->db->update(ADMIN,array('user_status' => 'Active' ));
			return $result;

			}

			public function	unauthorized(){
				$this->load->view('errors/unauthorized');
			}
	
}
