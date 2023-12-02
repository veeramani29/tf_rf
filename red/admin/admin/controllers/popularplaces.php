<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Popularplaces extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->model('popularplaces_model');
        $this->is_admin_logged_in();
    }

    private function is_admin_logged_in() {

        if (!$this->session->userdata('admin_logged_in')) {

            redirect('login/index');
        }
    }

    public function index() {

        redirect('home/dashboard');
    }



//redirect if needed, otherwise display the user list

function manage_gallery($msg=NULL)
{

if($msg == '1') {

$this->data['msg'] = "<p style='color:red'>Slide Deleted Successfully!</p>";

} else if($msg == '2') {

$this->data['msg'] = "<p style='color:red'>Unable To Delete The Album!<br>It has Images inside </p>";

} else if($msg == '3') {

$this->data['msg'] = "<p style='color:red'>You Dont have Access to delete!</p>";

} else {

$this->data['msg'] = "<p style='color:green'>Listing of Slides!</p>";

}

$this->data['popularplaces'] = $this->popularplaces_model->get_popularplaces()->result();
//print("<pre>");print_r($this->data['galleries']);exit;

$this->load->view("popularplaces/view_album",$this->data);
	



}


// create a new group

function create_album()

{


$this->data['title'] = "Add Slide";

$this->form_validation->set_rules('url', "Url", 'xss_clean');

if ($this->form_validation->run() == TRUE)
{

$data['cover_pic'] = $this->upload_slide();
$data['url'] = $this->input->post('url');
$gallery_id =  $this->popularplaces_model->create_popularplaces($data);


if($gallery_id)

{

//$this->session->set_flashdata('message', $this->ion_auth->messages());
redirect("popularplaces/manage_gallery");

}

}

else

{


$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

$this->load->view("popularplaces/create_album",$this->data);


}

}

public function upload_slide(){

$uniqe =  time();

$config['upload_path'] = './upload/';
$config['allowed_types'] = 'gif|jpg|png|jpeg|doc|txt|pdf|zip|rar';
$config['max_size']	= '20480';
$config['max_width']  = '1024';
$config['max_height']  = '768';
$this->load->library('upload',$config);

//$this->upload->initialize($config);	
$new_img =  $uniqe."_".$_FILES['file']['name'];

$tmpName  = $_FILES['file']['tmp_name'];  

//$this->dashboard_model->update_image($agent_id,$new_img);

$data =array( 'upload_data' => move_uploaded_file($tmpName,"./upload/popularplaces/$new_img"));

return $new_img;

}


function edit_album($id=NULL)

{

$this->data['popularplaces'] =  $this->popularplaces_model->edit_popularplaces($id);
$this->data['title'] = "Edit popularplaces Link";

//validate form input
$this->form_validation->set_rules('url', "Url", 'xss_clean');

if ($this->form_validation->run() == TRUE)
{
$file_name =  $_FILES['file']['name'];

if($file_name !=''){

$data['cover_pic'] = $this->upload_slide();
$data['url'] = $this->input->post('url');


} else {

$data['url'] = $this->input->post('url');

}

$gallery_id =  $this->popularplaces_model->update_popularplaces($data,$id);

//echo $new_category_id;exit;

if($gallery_id)

{

//$this->session->set_flashdata('message', $this->ion_auth->messages());
redirect("popularplaces/manage_gallery");

}

}

else

{

$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
$this->load->view("popularplaces/edit_album",$this->data);


}

}



function delete_album($id)
{

		$page_delete = $this->popularplaces_model->delete_popularplaces($id);
		//unlink("./upload/popularplaces/cover_pic/$img");
		redirect("popularplaces/manage_gallery");
}

function update_publish(){

	$data['publish'] =  1;
	$data['withdraw'] =  1;
	$id = $_REQUEST['id'];
	$news_id =  $this->popularplaces_model->update_ads($data,$id);
	echo $id;

}

function un_publish(){

	$data['publish'] =  0;
	$data['withdraw'] =  0;
	$id = $_REQUEST['id'];
	$news_id =  $this->popularplaces_model->update_ads($data,$id);
	echo $id;

}
public function delete()
{
    $ids = ( explode( ',', $this->input->get_post('ids') ));
    $this->popularplaces_model->delete($ids);
}



}
