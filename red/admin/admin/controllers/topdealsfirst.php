<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Topdealsfirst extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->model('topdealsfirst_model');
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



$this->data['topdealsfirst'] = $this->topdealsfirst_model->get_topdealsfirst()->result();
//print("<pre>");print_r($this->data['galleries']);exit;

$this->load->view("topdealsfirst/view_album",$this->data);
	



}


// create a new group

function create_album()

{


$this->data['title'] = "Add Slide";

$this->form_validation->set_rules('title', "title", 'xss_clean');

if ($this->form_validation->run() == TRUE)
{

$data['cover_pic'] = $this->upload_slide();
$data['title'] = $this->input->post('title');
$data['place'] = $this->input->post('place');
$data['price'] = $this->input->post('price');
$data['content'] = $this->input->post('content');

$gallery_id =  $this->topdealsfirst_model->create_topdealsfirst($data);


if($gallery_id)

{

//$this->session->set_flashdata('message', $this->ion_auth->messages());
redirect("topdealsfirst/manage_gallery");

}

}

else

{


$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

$this->load->view("topdealsfirst/create_album",$this->data);


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

$data =array( 'upload_data' => move_uploaded_file($tmpName,"./upload/topdealsfirst/$new_img"));

return $new_img;

}


function edit_album($id)

{

$this->data['topdealsfirst'] =  $this->topdealsfirst_model->edit_topdealsfirst($id);
$this->data['title'] = "Edit topdealsfirst Link";

//validate form input
$this->form_validation->set_rules('title', "title", 'xss_clean');

if ($this->form_validation->run() == TRUE)
{
$file_name =  $_FILES['file']['name'];

if($file_name !=''){

$data['cover_pic'] = $this->upload_slide();
$data['title'] = $this->input->post('title');
$data['place'] = $this->input->post('place');
$data['price'] = $this->input->post('price');
$data['content'] = $this->input->post('content');


} else {

$data['title'] = $this->input->post('title');
$data['place'] = $this->input->post('place');
$data['price'] = $this->input->post('price');
$data['content'] = $this->input->post('content');

}

$gallery_id =  $this->topdealsfirst_model->update_topdealsfirst($data,$id);

//echo $new_category_id;exit;

if($gallery_id)

{

//$this->session->set_flashdata('message', $this->ion_auth->messages());
redirect("topdealsfirst/manage_gallery");

}

}

else

{

$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
$this->load->view("topdealsfirst/edit_album",$this->data);


}

}



function delete_album($id)
{

$page_delete = $this->topdealsfirst_model->delete_topdealsfirst($id);
//unlink("./upload/topdealsfirst/cover_pic/$img");
redirect("topdealsfirst/manage_gallery");
}

function update_publish(){

	$data['publish'] =  1;
	$data['withdraw'] =  1;
	$id = $_REQUEST['id'];
	$news_id =  $this->topdealsfirst_model->update_ads($data,$id);
	echo $id;

}

function un_publish(){

	$data['publish'] =  0;
	$data['withdraw'] =  0;
	$id = $_REQUEST['id'];
	$news_id =  $this->topdealsfirst_model->update_ads($data,$id);
	echo $id;

}
public function delete()
{
    $ids = ( explode( ',', $this->input->get_post('ids') ));
    $this->topdealsfirst_model->delete($ids);
}



}
