<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class rooms extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->model('rooms_model');
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

private $_uploaded;

//redirect if needed, otherwise display the user list

function manage_gallery($msg=NULL)
{



$this->data['rooms'] = $this->rooms_model->get_rooms()->result();
//print("<pre>");print_r($this->data['galleries']);exit;

$this->load->view("rooms/view_album",$this->data);
	



}


// create a new group

function create_album()

{


$this->data['hotel_list'] = $this->rooms_model->get_hotel_list();

//print("<pre>"); print_r($this->data); exit;

$this->data['title'] = "Add Slide";

$this->form_validation->set_rules('title', "title", 'xss_clean');

if ($this->form_validation->run() == TRUE)
{

$data['room_img'] = $this->upload_slide();


$data['hotel_id'] = $this->input->post('hotel_id');
$data['room_type'] = $this->input->post('room_type');
$data['room_inclusion'] = $this->input->post('room_inclusion');
$data['max_adult'] = $this->input->post('max_adult');
$data['max_child'] = $this->input->post('max_child');
$data['price'] = $this->input->post('price');


$room_facilities = $this->input->post('room_fac');

$fac = '';
foreach($room_facilities as $rfk=>$rfval)
{
 $fac .= $rfval.',';

}
$fac = rtrim($fac,',');
$data['room_fac'] = $fac;

//print("<pre>"); print_r($data); exit;
$gallery_id =  $this->rooms_model->create_rooms($data);


if($gallery_id)

{

//$this->session->set_flashdata('message', $this->ion_auth->messages());
redirect("rooms/manage_gallery");

}

}

else

{


$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

$this->load->view("rooms/create_album",$this->data);


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
$new_img =  $uniqe."_".$_FILES['room_img']['name'];

$tmpName  = $_FILES['room_img']['tmp_name'];  

//$this->dashboard_model->update_image($agent_id,$new_img);

$data =array( 'upload_data' => move_uploaded_file($tmpName,"./upload/hotels/$new_img"));

return $new_img;

}

public function edit_album($id)

{

$this->data['hotel_list'] = $this->rooms_model->get_hotel_list();
$this->data['rooms'] =  $this->rooms_model->edit_rooms($id);


//validate form input
$this->form_validation->set_rules('title', "title", 'xss_clean');



if ($this->form_validation->run() == TRUE)
{

$roomimg = $_FILES['room_img']['name'];
if($roomimg != '') {
$data['room_img'] = $this->upload_slide();

$data['hotel_id'] = $this->input->post('hotel_id');
$data['room_type'] = $this->input->post('room_type');
$data['room_inclusion'] = $this->input->post('room_inclusion');
$data['max_adult'] = $this->input->post('max_adult');
$data['max_child'] = $this->input->post('max_child');
$data['price'] = $this->input->post('price');


$room_facilities = $this->input->post('room_fac');

$fac = '';
foreach($room_facilities as $rfk=>$rfval)
{
 $fac .= $rfval.',';

}
$fac = rtrim($fac,',');
$data['room_fac'] = $fac;
} else {

$data['hotel_id'] = $this->input->post('hotel_id');
$data['room_type'] = $this->input->post('room_type');
$data['room_inclusion'] = $this->input->post('room_inclusion');
$data['max_adult'] = $this->input->post('max_adult');
$data['max_child'] = $this->input->post('max_child');
$data['price'] = $this->input->post('price');


$room_facilities = $this->input->post('room_fac');

$fac = '';
foreach($room_facilities as $rfk=>$rfval)
{
 $fac .= $rfval.',';

}
$fac = rtrim($fac,',');
$data['room_fac'] = $fac;
}




$gallery_id =  $this->rooms_model->update_rooms($data,$id);

//echo $new_category_id;exit;

if($gallery_id)

{

//$this->session->set_flashdata('message', $this->ion_auth->messages());
redirect("rooms/manage_gallery");

}

}

else

{

$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
$this->load->view("rooms/edit_album",$this->data);


}

}



function delete_album($id)
{

$page_delete = $this->rooms_model->delete_rooms($id);
//unlink("./upload/rooms/cover_pic/$img");
redirect("rooms/manage_gallery");
}

function get_city(){

	
	$val = $_REQUEST['val'];
	$city_list = $this->rooms_model->get_hotel_city_list($val);
	$data1['city_list'] = $city_list;
	echo json_encode($data1);
	

	
	
}

function un_publish(){

	$data['publish'] =  0;
	$data['withdraw'] =  0;
	$id = $_REQUEST['id'];
	$news_id =  $this->rooms_model->update_ads($data,$id);
	echo $id;

}
public function delete()
{
    $ids = ( explode( ',', $this->input->get_post('ids') ));
    $this->rooms_model->delete($ids);
}



}
