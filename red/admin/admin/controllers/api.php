<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class api extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->model('api_model');
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



$this->data['api'] = $this->api_model->get_api()->result();
//print("<pre>");print_r($this->data['galleries']);exit;

$this->load->view("api/view_album",$this->data);
	



}


// create a new group

function create_album()

{


$this->data['title'] = "Add Slide";

$this->form_validation->set_rules('title', "title", 'xss_clean');

if ($this->form_validation->run() == TRUE)
{



$data['service_type'] = $this->input->post('service_type');
$data['api_name'] = $this->input->post('api_name');
$data['client_id'] = $this->input->post('client_id');
$data['username'] = $this->input->post('username');
$data['password'] = $this->input->post('password');
$data['live_url'] = $this->input->post('live_url');
$data['demo_url'] = $this->input->post('demo_url');
$data['order_no'] = $this->input->post('order_no');
$data['mode'] = $this->input->post('mode');


$gallery_id =  $this->api_model->create_api($data);


if($gallery_id)

{

//$this->session->set_flashdata('message', $this->ion_auth->messages());
redirect("api/manage_gallery");

}

}

else

{


$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

$this->load->view("api/create_album",$this->data);


}

}

public function upload_slide() {

$uniqe =  time();

$config['upload_path'] = './upload/';
$config['allowed_types'] = 'gif|jpg|png|jpeg';
$config['max_size']	= '20480';
$config['max_width']  = '1024';
$config['max_height']  = '768';
$this->load->library('upload',$config);

//$this->upload->initialize($config);	
$new_img =  $uniqe."_".$_FILES['pkimage']['name'];

$tmpName  = $_FILES['pkimage']['tmp_name'];  

//$this->dashboard_model->update_image($agent_id,$new_img);

$data =array( 'upload_data' => move_uploaded_file($tmpName,"./upload/pkimage/$new_img"));

return $new_img;

}

public function upload_slide1() {

$uniqe =  time();

$config['upload_path'] = './upload/';
$config['allowed_types'] = 'gif|jpg|png|jpeg';
$config['max_size']	= '20480';
$config['max_width']  = '1024';
$config['max_height']  = '768';
$this->load->library('upload',$config);

//$this->upload->initialize($config);	
$new_img1 =  $uniqe."_".$_FILES['hotelimage']['name'];

$tmpName  = $_FILES['hotelimage']['tmp_name'];  

//$this->dashboard_model->update_image($agent_id,$new_img);

$data =array( 'upload_data' => move_uploaded_file($tmpName,"./upload/hotelimage/$new_img1"));

return $new_img1;

}


function edit_album($api_id)

{

$this->data['api'] =  $this->api_model->edit_api($api_id);

//validate form input
$this->form_validation->set_rules('title', "title", 'xss_clean');

if ($this->form_validation->run() == TRUE)
{

$pkimage =  $_FILES['pkimage']['name'];
$hotelimage =  $_FILES['hotelimage']['name'];

$data['service_type'] = $this->input->post('service_type');
$data['api_name'] = $this->input->post('api_name');
$data['client_id'] = $this->input->post('client_id');
$data['username'] = $this->input->post('username');
$data['password'] = $this->input->post('password');
$data['live_url'] = $this->input->post('live_url');
$data['demo_url'] = $this->input->post('demo_url');
$data['order_no'] = $this->input->post('order_no');
$data['mode'] = $this->input->post('mode');

$gallery_id =  $this->api_model->update_api($data,$api_id);

//echo $new_category_id;exit;

if($gallery_id)

{

//$this->session->set_flashdata('message', $this->ion_auth->messages());
redirect("api/manage_gallery");

}

}

else

{

$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
$this->load->view("api/edit_album",$this->data);


}

}



function delete_album($api_id)
{

$page_delete = $this->api_model->delete_api($api_id);
//unlink("./upload/api/cover_pic/$img");
redirect("api/manage_gallery");
}

 public function manage_api_status() {

        if (isset($_POST['api_id']) && isset($_POST['status'])) {

            $api_id = $_POST['api_id'];

            $status = $_POST['status'];

            $update = $this->api_Model->manage_api_status($api_id, $status);

            redirect("api/manage_gallery");
        } else {

            return false;
        }
    }

function update_publish(){

	$data['publish'] =  1;
	$data['withdraw'] =  1;
	$api_id = $_REQUEST['id'];
	$news_id =  $this->api_model->update_ads($data,$api_id);
	echo $api_id;

}

function un_publish(){

	$data['publish'] =  0;
	$data['withdraw'] =  0;
	$api_id = $_REQUEST['id'];
	$news_id =  $this->api_model->update_ads($data,$api_id);
	echo $api_id;

}
public function delete()
{
    $api_ids = ( explode( ',', $this->input->get_post('ids') ));
    $this->api_model->delete($api_ids);
}



}