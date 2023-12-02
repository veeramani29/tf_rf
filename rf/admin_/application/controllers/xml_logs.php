<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xml_Logs extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->database(); 
		$this->load->model('Api_Model');
		$this->load->model('Admin_Model');
		$this->load->model('Domain_Model');
		$this->load->model('Home_Settings_Model');
		$this->load->library('form_validation');
		$this->load->model('Xml_Logs_Model');
		$this->load->model('Support_Model');
		$this->load->model('Email_Model');
		$this->load->model('Home_Model');
		$this->load->model('B2c_Model');
		$this->load->model('B2B_Model');
		$this->load->model('Privilege_Model');
		$this->check_isvalidated();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		if($this->session->userdata('admin_logged_in')){
			$this->load->helper('url');
			$controller = $this->router->fetch_class();
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
	public function getAllXmlLogs(){
		$data['xml_logs'] = $this->Xml_Logs_Model->getAllXmlLogs();
		$this->load->view('xml_logs/xml_logs',$data);
	
	}

	public function getOneXmlLogs($id){

		$data['one_xml_logs'] = $this->Xml_Logs_Model->getOneXmlLogs($id);
		$this->load->view('xml_logs/xml_logs',$data);
    	}

 // Export Excel File
    function export_all_xml_logs($id) {
        $selected_ids = $id;

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
            $prestasi->setCellValue('B2', 'Request');
            $prestasi->setCellValue('C2', 'Response');

            //$user_data = $this->B2c_Model->export_b2c_users($selected_ids)->result();
	    
	   $user_data = $this->Xml_Logs_Model->getOneXmlLogs($selected_ids);
           $no = 1;
           $rowexcel = 3;
           
	   $phpExcel->getActiveSheet()->getStyle('A' . $rowexcel . ':H' . $rowexcel)->applyFromArray($styleArray);
	   $phpExcel->getActiveSheet()->getStyle('A' . $rowexcel . ':H' . $rowexcel)->applyFromArray($styleArray1);
	   $prestasi->setCellValue('A' . $rowexcel, $no);
	   $prestasi->setCellValue('B' . $rowexcel, $user_data->XML_Request);
	   $prestasi->setCellValue('C' . $rowexcel, $user_data->XML_Response);
           
            $prestasi->setTitle('XML Request and Response');
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"xml_logs.xlsx\"");
            header("Cache-Control: max-age=0");
            $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
            $objWriter->save("php://output");
        } else {
            redirect('xml_logs/getAllXmlLogs');
        }
    }

    public function export_xml_log_request($id){
	$user_data = $this->Xml_Logs_Model->getOneXmlLogs($id); 
	$xmldata = '<?xml version="1.0" encoding="utf-8"?>';
	$xmldata .= $user_data->XML_Request;
	

	if(file_put_contents('Request.xml',$xmldata)) // this code is working fine xml get created
	{
	    //echo "file created";exit;
	    header('Content-type: text/xml');   // i am getting error on this line
	    //Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\yii\framework\web\CController.php:793)

	    header('Content-Disposition: Attachment; filename="Request.xml"');
	    // File to download
	    readfile('Request.xml');        // i am not able to download the same file
	}
	
    }
	
    public function export_xml_log_response($id){
	$user_data = $this->Xml_Logs_Model->getOneXmlLogs($id); 
	$xmldata = '<?xml version="1.0" encoding="utf-8"?>';
	$xmldata .= $user_data->XML_Response;
	

	if(file_put_contents('Response.xml',$xmldata)) // this code is working fine xml get created
	{
	    //echo "file created";exit;
	    header('Content-type: text/xml');   // i am getting error on this line
	    //Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\yii\framework\web\CController.php:793)

	    header('Content-Disposition: Attachment; filename="Response.xml"');
	    // File to download
	    readfile('Response.xml');        // i am not able to download the same file
	}
	
    }
   
    
	
	
}

/* End of file xml_logs.php */
/* Location: ./application/controllers/welcome.php */
