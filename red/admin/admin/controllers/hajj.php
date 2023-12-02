<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hajj extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->model('hajj_model');
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



$this->data['hajj'] = $this->hajj_model->get_hajj()->result();
//print("<pre>");print_r($this->data['galleries']);exit;

$this->load->view("hajj/view_album",$this->data);
	



}


// create a new group

function create_album()

{


$this->data['title'] = "Add Slide";

$this->form_validation->set_rules('title', "title", 'xss_clean');

if ($this->form_validation->run() == TRUE)
{

$data['pkimage'] = $this->upload_slide();
$data['hotelimage'] = $this->upload_slide1();


$data['pkdest'] = $this->input->post('pkdest');
$data['pkname'] = $this->input->post('pkname');
$data['pkdesc'] = $this->input->post('pkdesc');
$data['price'] = $this->input->post('price');
$data['category'] = $this->input->post('category');
$data['airline'] = $this->input->post('airline');
$data['from_date'] = $this->input->post('from_date');
$data['to_date'] = $this->input->post('to_date');
$data['hotelname'] = $this->input->post('hotelname');
$data['hotelrating'] = $this->input->post('hotelrating');
$data['pkiternary'] = $this->input->post('pkiternary');
$data['hoteldet'] = $this->input->post('hoteldet');
$data['inclusions'] = $this->input->post('inclusions');
$data['faqs'] = $this->input->post('faqs');


$gallery_id =  $this->hajj_model->create_hajj($data);


if($gallery_id)

{

//$this->session->set_flashdata('message', $this->ion_auth->messages());
redirect("hajj/manage_gallery");

}

}

else

{


$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

$this->load->view("hajj/create_album",$this->data);


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


function edit_album($id)

{

$this->data['hajj'] =  $this->hajj_model->edit_hajj($id);

//validate form input
$this->form_validation->set_rules('title', "title", 'xss_clean');

if ($this->form_validation->run() == TRUE)
{

$pkimage =  $_FILES['pkimage']['name'];
$hotelimage =  $_FILES['hotelimage']['name'];

if($hotelimage !='' && $pkimage !='') {

$data['pkimage'] = $this->upload_slide();
$data['hotelimage'] = $this->upload_slide1();

$data['pkdest'] = $this->input->post('pkdest');
$data['pkname'] = $this->input->post('pkname');
$data['pkdesc'] = $this->input->post('pkdesc');
$data['price'] = $this->input->post('price');
$data['category'] = $this->input->post('category');
$data['airline'] = $this->input->post('airline');
$data['from_date'] = $this->input->post('from_date');
$data['to_date'] = $this->input->post('to_date');
$data['hotelname'] = $this->input->post('hotelname');
$data['hotelrating'] = $this->input->post('hotelrating');
$data['pkiternary'] = $this->input->post('pkiternary');
$data['hoteldet'] = $this->input->post('hoteldet');
$data['inclusions'] = $this->input->post('inclusions');
$data['faqs'] = $this->input->post('faqs');

} else if($hotelimage !='') {


$data['hotelimage'] = $this->upload_slide1();

$data['pkdest'] = $this->input->post('pkdest');
$data['pkname'] = $this->input->post('pkname');
$data['pkdesc'] = $this->input->post('pkdesc');
$data['price'] = $this->input->post('price');
$data['category'] = $this->input->post('category');
$data['airline'] = $this->input->post('airline');
$data['from_date'] = $this->input->post('from_date');
$data['to_date'] = $this->input->post('to_date');
$data['hotelname'] = $this->input->post('hotelname');
$data['hotelrating'] = $this->input->post('hotelrating');
$data['pkiternary'] = $this->input->post('pkiternary');
$data['hoteldet'] = $this->input->post('hoteldet');
$data['inclusions'] = $this->input->post('inclusions');
$data['faqs'] = $this->input->post('faqs');

} else if($pkimage !='') {

$data['pkimage'] = $this->upload_slide();


$data['pkdest'] = $this->input->post('pkdest');
$data['pkname'] = $this->input->post('pkname');
$data['pkdesc'] = $this->input->post('pkdesc');
$data['price'] = $this->input->post('price');
$data['category'] = $this->input->post('category');
$data['airline'] = $this->input->post('airline');
$data['from_date'] = $this->input->post('from_date');
$data['to_date'] = $this->input->post('to_date');
$data['hotelname'] = $this->input->post('hotelname');
$data['hotelrating'] = $this->input->post('hotelrating');
$data['pkiternary'] = $this->input->post('pkiternary');
$data['hoteldet'] = $this->input->post('hoteldet');
$data['inclusions'] = $this->input->post('inclusions');
$data['faqs'] = $this->input->post('faqs');

} else {

$data['pkdest'] = $this->input->post('pkdest');
$data['pkname'] = $this->input->post('pkname');
$data['pkdesc'] = $this->input->post('pkdesc');
$data['price'] = $this->input->post('price');
$data['category'] = $this->input->post('category');
$data['airline'] = $this->input->post('airline');
$data['from_date'] = $this->input->post('from_date');
$data['to_date'] = $this->input->post('to_date');
$data['hotelname'] = $this->input->post('hotelname');
$data['hotelrating'] = $this->input->post('hotelrating');
$data['pkiternary'] = $this->input->post('pkiternary');
$data['hoteldet'] = $this->input->post('hoteldet');
$data['inclusions'] = $this->input->post('inclusions');
$data['faqs'] = $this->input->post('faqs');

}

$gallery_id =  $this->hajj_model->update_hajj($data,$id);

//echo $new_category_id;exit;

if($gallery_id)

{

//$this->session->set_flashdata('message', $this->ion_auth->messages());
redirect("hajj/manage_gallery");

}

}

else

{

$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
$this->load->view("hajj/edit_album",$this->data);


}

}



function delete_album($id)
{

$page_delete = $this->hajj_model->delete_hajj($id);
//unlink("./upload/hajj/cover_pic/$img");
redirect("hajj/manage_gallery");
}

function update_publish(){

	$data['publish'] =  1;
	$data['withdraw'] =  1;
	$id = $_REQUEST['id'];
	$news_id =  $this->hajj_model->update_ads($data,$id);
	echo $id;

}

function un_publish(){

	$data['publish'] =  0;
	$data['withdraw'] =  0;
	$id = $_REQUEST['id'];
	$news_id =  $this->hajj_model->update_ads($data,$id);
	echo $id;

}
public function delete()
{
    $ids = ( explode( ',', $this->input->get_post('ids') ));
    $this->hajj_model->delete($ids);
}



}
