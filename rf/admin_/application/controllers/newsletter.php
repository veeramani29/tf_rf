<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {

	public function __construct() {
		parent::__construct();
        	$this->load->helper(array('form', 'url'));
		$this->load->model('Newsletter_Model');
        	$this->load->model('Email_Model');
		 $this->check_isvalidated();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		if($this->session->userdata('admin_logged_in')){
			$this->load->model('Privilege_Model');
			$sub_admin_id = $this->session->userdata('admin_id');
			$this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
		}

	}
	private function check_isvalidated(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
	    	}else{
	    		redirect('login/index');
	    	}
	}
	public function manage_newsletter() {
		$data['title'] = 'Add Newsletter';
        	$data['breadcrumb']['Add Newletter'] = '';
        	$data['newsletter_list'] = $this->Newsletter_Model->get_all_newsletter_list();
       		$this->load->view('newsletter/manage_newsletter/newsletter_view.php', $data);
	}

	public function fetch_newsletter_template($id) {
		$template_data = $this->Newsletter_Model->fetch_newsletter_template($id);
		echo json_encode($template_data); /* Return back the json object to the AJAX request. */
    	}

	public function newsletter_add() {
		$data['title'] = 'Add Newsletter Template';
		$this->load->view('newsletter/manage_newsletter/newsletter_add', $data);
	}

    public function save_newsletter() {
        if (!empty($_FILES['file']['name'])) {
            $config['upload_path'] = IMAGE_UPLOAD_PATH . 'newsletter/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());

                $data['status'] = '<div class="alert alert-block alert-danger">
                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                        <h4 class="alert-heading">Banner Image!</h4>
                                        ' . $error['error'] . '
                                    </div>';

                $data['title'] = 'Manage Newsletter';
                $data['breadcrumb']['Manage Newsletter'] = '';
                $this->load->view('admin/manage_newsletter', $data);
            } else {
                $cc = $this->upload->data('file');
                $image_path = WEB_URL.'upload_files/newsletter/'.$cc['file_name'].'';

                $data['template_name'] = $this->input->post('template_name');
                $data['template_images'] = $image_path;
                $data['template_content'] = $this->input->post('template_content');

                $this->Newsletter_Model->save_newsletter($data);
                redirect('newsletter/manage_newsletter');
            }
        } else {
            $data['template_name'] = $this->input->post('template_name');
            $data['template_content'] = $this->input->post('template_content');
            $this->Newsletter_Model->save_newsletter($data);
            redirect('newsletter/manage_newsletter');
        }
    }



    public function change_newsletter_status($id, $status) {
    	$this->Newsletter_Model->change_newsletter_status($id, $status);
        redirect('newsletter/manage_newsletter');
    }

    public function delete_newsletter($id) {
    	$this->Newsletter_Model->delete_newsletter($id);
        redirect('newsletter/manage_newsletter');
    }

    public function edit_newsletter($id) {
        $data['title'] = 'Edit Newsletter';
        $data['newsletter_data'] = $this->Newsletter_Model->get_single_newsletter_details($id);
        $this->load->view('newsletter/manage_newsletter/newsletter_edit.php', $data);
    }

    public function update_newsletter($id) {
        
        if(!empty($_FILES['file']['name'])) {
            $config['upload_path'] = IMAGE_UPLOAD_PATH . 'newsletter/'; //change this folder to newsletter after taking permissions...
            $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
            
            $this->load->library('upload', $config);
            
            
            if (!$this->upload->do_upload('file')) { 
                $error = array('error' => $this->upload->display_errors());

                $data['status'] = '<div class="alert alert-block alert-danger">
                                        <a href="#" data-dismiss="alert" class="close">×</a>
                                        <h4 class="alert-heading">Banner Image!</h4>
                                        ' . $error['error'] . '
                                    </div>';

                $data['title'] = 'Add Images';
                $data['breadcrumb']['Banner Images'] = '';
                redirect('newsletter/manage_newsletter');
            } else { 
                $cc = $this->upload->data('file');
                
                $image_path = WEB_URL.'upload_files/newsletter/'.$cc['file_name'].'';

                $data['template_name'] = $this->input->post('template_name');
                $data['template_images'] = $image_path;
                $data['template_content'] = $this->input->post('template_content');

                $this->Newsletter_Model->update_newsletter($id, $data);
                redirect('newsletter/manage_newsletter');
            }
        } else {
            $data['template_name'] = $this->input->post('template_name');
            $data['template_content'] = $this->input->post('template_content');
            $this->Newsletter_Model->update_newsletter($id, $data);
            redirect('newsletter/manage_newsletter');
        }
    }

    public function all_campaign(){
        $data['title'] = 'Add Campaign';

        $data['campaign_data'] = $this->Newsletter_Model->get_all_campaign_list();
        $this->load->view('newsletter/manage_campaign/campaign_all', $data);
    }

    public function fetch_campaign_template($id) {
        $campaign_template = $this->Newsletter_Model->fetch_campaign_template($id);
        echo json_encode($campaign_template); /* Return back the json object to the AJAX request. */
    }

    public function send_campaign_email($id) {
        
        $allB2c_check = $this->input->post('allB2c');
        $allB2b_check = $this->input->post('allB2b');
        $allSub_check = $this->input->post('allSub');

        

        if($allB2c_check == 1) {
            $b2c_email_id = $this->Email_Model->get_b2c_email_id();            
        } else {
            $b2c_email_id = array();
        }
        
        if($allB2b_check == 1) {
            $b2b_email_id = $this->Email_Model->get_b2b_email_id();               
        } else {
            $b2b_email_id = array();
        }
        
        if($allSub_check == 1) {
            $allSub_email_id = $this->Email_Model->get_allSub_email_id();
        } else {
            $allSub_email_id = array();
        }

        $additional_emails = $this->Email_Model->get_additional_campaign_email($id);
        if($additional_emails != "") {
            $additional_emails_array = explode(';', $additional_emails[0]->campaign_email_to);            
        } else {
            $additional_emails_array = array();    
        }

        $mail_list = array();
        if (!empty($b2c_email_id)) {
            foreach ($b2c_email_id as $mail_id) {
                $mail_list[] = $mail_id->email . '';
            }
        }

        if (!empty($b2b_email_id)) {
            foreach ($b2b_email_id as $mail_id) {
                $mail_list[] = $mail_id->email_id . '';
            }
        }
        if (!empty($allSub_email_id)) {
            foreach ($allSub_email_id as $mail_id) {
                $mail_list[] = $mail_id->email_id . '';
            }
        }
        
        $mail_list = array_merge($mail_list, $additional_emails_array);

        
        $mail_content = $this->Newsletter_Model->get_single_campaign_details($id);
        $email_config = $this->Email_Model->get_email_access_details();
        $get_email_from_id = $this->Email_Model->get_from_email($id);

        $email_from_id = $get_email_from_id->email_from;
        
        $sendemail = $this->Email_Model->sendCampaignEmail($mail_list, $mail_content, $email_config, $email_from_id);
    }

    public function send_test_campaign_email() {
        $id = $this->input->post('id');
        $emailid = $this->input->post('emailid');
        $mail_list = explode(';', $emailid);

        $mail_content = $this->Newsletter_Model->get_single_campaign_details($id);
        $email_config = $this->Email_Model->get_email_access_details();

        $sendemail = $this->Email_Model->sendmail_reg($mail_list, $mail_content, $email_config);
    }

     public function select_campaign() {
        $data['title'] = 'Add Campaign';

        $data['campaign_data'] = $this->Newsletter_Model->get_all_newsletter_list();
        $this->load->view('newsletter/manage_campaign/campaign_template_view', $data);
    }

    public function create_campaign($id) {
        $data['title'] = 'Create Campaign';
        
        $data['template_data'] = $this->Newsletter_Model->get_single_newsletter_details($id);
        $data['id'] = $id;
        $this->load->view('newsletter/manage_campaign/campaign_create', $data);
    }

   public function add_campaign($id) {

        $data['campaign_name'] = $this->input->post('campaign_name');
        $data['email_subject'] = $this->input->post('campaign_email_subject');
        $data['email_from'] = $this->input->post('campaign_from_email');
        $data['email_from_name'] = $this->input->post('campaign_from_name');
        $data['campaign_email_to'] = $this->input->post('campaign_email_to');
        $data['campaign_template'] = $this->input->post('campaign_template_content');
        $data['template_id'] = $id;
        $this->Newsletter_Model->add_campaign($id, $data); 
        redirect('newsletter/all_campaign');
    }

    public function edit_campaign($id) {
        $data['title'] = 'Edit Campaign';
        $data['campaign_data'] = $this->Newsletter_Model->get_single_campaign_details($id);

        $this->load->view('newsletter/manage_campaign/campaign_edit.php', $data);
    }

    public function update_campaign($id) {
        $data['campaign_name'] = $this->input->post('campaign_name');
        $data['email_subject'] = $this->input->post('email_subject');
        $data['email_from'] = $this->input->post('email_from');
        $data['email_from_name'] = $this->input->post('email_from_name');
        $data['campaign_email_to'] = $this->input->post('campaign_email_to');
        $data['campaign_template'] = $this->input->post('campaign_template');

        $this->Newsletter_Model->update_campaign($id, $data);
        redirect('newsletter/all_campaign');
    }

    public function delete_campaign($id) {
        $this->Newsletter_Model->delete_campaign($id);
        redirect('newsletter/all_campaign');
    }

    public function view_subscribers(){
	$data['subscribers'] = $this->Newsletter_Model->get_all_subscribers();
	$data['b2c'] = $this->Newsletter_Model->get_b2c_subscribers();
	$data['b2b'] = $this->Newsletter_Model->get_b2b_subscribers();
	$data['asubs'] = array_merge($data['subscribers'],$data['b2c'],$data['b2b']);
	$allsubs = $data['asubs'];
	$alls = array();
	foreach($allsubs as $as){
		$alls[] = !empty($as->email)?$as->email:$as->email_id;
	}
	$data['alsubs'] = array_unique($alls);

	$this->load->view('newsletter/subscribers', $data);
    }

    // Export Excel File
    function export_all_subscribers() {

        $selected_ids = $this->input->post('cid');
	      
        if (!empty($selected_ids)) {
            $this->load->library("Excel");
            $phpExcel = new PHPExcel();
            $prestasi = $phpExcel->setActiveSheetIndex(0);
            //merger
            $phpExcel->getActiveSheet()->mergeCells('A1:H1');
            //manage row hight
            $phpExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);
            //style alignment
            $styleArray = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ),
            );
            $phpExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $phpExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);
            //border
            $styleArray1 = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            //background
            $styleArray12 = array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'startcolor' => array(
                        'rgb' => '00acec',
                    //'rgb' => '009933',
                    ),
                ),
            );
            //freeepane
            $phpExcel->getActiveSheet()->freezePane('A3');
            //coloum width
            $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.1);
            $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $phpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
            $phpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
            $phpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
            $prestasi->setCellValue('A1', 'All Subscribers');
            $phpExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
            $phpExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray1);
            $phpExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray12);
            $prestasi->setCellValue('A2', 'S.No');
            $prestasi->setCellValue('B2', 'Email');
            
            if(!empty($selected_ids)){
		      $user_data = array_unique($selected_ids);
    	   }else{
    		   /*$data['subscribers'] = $this->Newsletter_Model->get_all_subscribers();
    		   $data['b2c'] = $this->Newsletter_Model->get_b2c_subscribers();
    		   $data['b2b'] = $this->Newsletter_Model->get_b2b_subscribers();
    		   $data['asubs'] = array_merge($data['subscribers'],$data['b2c'],$data['b2b']);
    		   $allsubs = $data['asubs'];
    		   $alls = array();
    		   foreach($allsubs as $as){
    		      $alls[] = !empty($as->email)?$as->email:$as->email_id;
    		   }
    		   $user_data = array_unique($alls);*/
    	   }
	    
	    
	   
            $no = 0;
            $rowexcel = 2;
            foreach ($user_data as $row) {
                $no++;
                $rowexcel++;
                $phpExcel->getActiveSheet()->getStyle('A' . $rowexcel . ':H' . $rowexcel)->applyFromArray($styleArray);
                $phpExcel->getActiveSheet()->getStyle('A' . $rowexcel . ':H' . $rowexcel)->applyFromArray($styleArray1);
                $prestasi->setCellValue('A' . $rowexcel, $no);
                $prestasi->setCellValue('B' . $rowexcel, $row);
            }
            $prestasi->setTitle('All Subscribers');
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"all_subscribers.xlsx\"");
            header("Cache-Control: max-age=0");
            $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
            $objWriter->save("php://output");
        } else {
            redirect('newsletter/view_subscribers');
        }
    }

    public function b2b_subscriber() {
        $data['b2b_sub_list'] = $this->Newsletter_Model->get_b2b_subscribers();
        $this->load->view('newsletter/b2b_subscriber', $data);
    }

    public function b2b_deleteSubscriber($id) {
        $this->Newsletter_Model->b2b_deleteSubscriber($id);
        redirect(WEB_URL.'newsletter/b2b_subscriber');
    }

    public function b2c_subscriber() {
        $data['b2c_sub_list'] = $this->Newsletter_Model->get_b2c_subscribers();
        $this->load->view('newsletter/b2c_subscriber', $data);
    }

    public function b2c_deleteSubscriber($id) {
        $this->Newsletter_Model->b2c_deleteSubscriber($id);
        redirect(WEB_URL.'newsletter/b2c_subscriber');
    }

    public function unregistered_subscriber() {
        $data['unreg_sub_list'] = $this->Newsletter_Model->get_all_subscribers();
        $this->load->view('newsletter/unregistered_subscriber', $data);
    }

    public function unregistered_deleteSubscriber($id) {
        $this->Newsletter_Model->unregistered_deleteSubscriber($id);
        redirect(WEB_URL.'newsletter/unregistered_subscriber');
    }

}
