<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class DoPayment extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('payment_model');
		$this->load->model('flight_model');
    }

	function success(){
		//WLQR5V9611ML
		
		//print_r($_REQUEST);exit;die;
	if (isset($_REQUEST['ec']) && !empty($_REQUEST)){
				$_REQUEST['STATUS']=5;
			$payment_response = $_REQUEST;
			$payment_res = base64_encode(json_encode($payment_response));
			//echo '<pre>';print_r($payment_response);exit;
			$order_id = $payment_response['ec'];
			
			$transaction = array(
				'transaction_id' => $payment_response['trxid'],
				'transaction_status' => 'SUCCESS',
				'payment_status' => $payment_response['STATUS'],
				'payment_res' => $payment_res
			);
			$count = $this->payment_model->validate_order_id($order_id)->num_rows();
			//echo $count;die;
			if($count >= 1){
				$this->payment_model->update_transaction($order_id,$transaction);
				$this->payment_model->update_loayalty($order_id);
				if(isset($_SESSION['RedeemStatus'])){ unset($_SESSION['RedeemStatus']); }
				if(isset($_SESSION['RedeemPoints'])){ unset($_SESSION['RedeemPoints']); }
 				if($payment_response['STATUS']==5){
					$payment_data = $this->payment_model->validate_order_id_v1($order_id)->row();
					$order_id = $payment_data->parent_pnr;
					if($payment_data->module == "FLIGHT"){
						redirect(WEB_URL.'/booking/book/'.$order_id);	
					}elseif($payment_data->module == "HOTEL"){
						redirect(WEB_URL.'/booking/book/'.$order_id);	
					}elseif($payment_data->module == "CAR"){
						redirect(WEB_URL.'/booking/book/'.$order_id);	
					}elseif($payment_data->module == "VACATION"){
						redirect(WEB_URL.'/booking/book/'.$order_id);	
					}elseif($payment_data->module == "APARTMENT"){
						redirect(WEB_URL.'/booking/book/'.$order_id);	
					}else{
						$msg = 'Your transaction has been completed successfully but your order doesnot exists.';
						$orderid =  $payment_response['ec'];
						$payid =  $payment_response['trxid'];
						$msg = base64_encode($msg);
						redirect(WEB_URL.'/error/payment/'.$msg.'/'.$order_id.'/'.$payid,'refresh');
					}
				}else{
					$msg = 'Your transaction has been not authorized.';
					$orderid =  $payment_response['ec'];
					$payid =  $payment_response['trxid'];
					$msg = base64_encode($msg);
					redirect(WEB_URL.'/error/payment/'.$msg.'/'.$order_id.'/'.$payid,'refresh');
				}
			}else{
				$msg = 'Your transaction has been failured and your order doest not exists.';
				$orderid =  $payment_response['ec'];
				$payid =  $payment_response['trxid'];
				$msg = base64_encode($msg);
				redirect(WEB_URL.'/error/payment/'.$msg.'/'.$order_id.'/'.$payid,'refresh');
			}
		}else{
			$msg = 'Failure : Your transaction has been failured.';
			$msg = base64_encode($msg);
			redirect(WEB_URL.'/error/payment_failure/'.$msg,'refresh');
		}
		
	}
	function decline(){
		if (isset($_REQUEST['ec']) && !empty($_REQUEST)){
			$payment_response = $_REQUEST;
			//echo '<pre>';print_r($ar);
			$payment_res = base64_encode(json_encode($payment_response));
			$order_id = $payment_response['ec'];
			$transaction = array(
				'transaction_id' => $payment_response['TransactionReference'],
				'transaction_status' => 'DECLINE',
				'payment_status' => $payment_response['STATUS'],
				'payment_res' => $payment_res
			);
			$count = $this->payment_model->validate_order_id($order_id)->num_rows();
			if($count >= 1){
				$this->payment_model->update_transaction($order_id,$transaction);
				$msg = 'Your transaction has been declined.';
				$orderid =  $payment_response['ec'];
				$payid =  $payment_response['trxid'];
				$msg = base64_encode($msg);
				redirect(WEB_URL.'/error/payment/'.$msg.'/'.$order_id.'/'.$payid,'refresh');
			}else{
				$msg = 'Your transaction has been declined and your order doest not exists.';
				$orderid =  $payment_response['ec'];
				$payid =  $payment_response['trxid'];
				$msg = base64_encode($msg);
				redirect(WEB_URL.'/error/payment/'.$msg.'/'.$order_id.'/'.$payid,'refresh');
			}
		}else{
			$msg = 'Failure : Your transaction has been declined';
			$msg = base64_encode($msg);
			redirect(WEB_URL.'/error/payment_failure/'.$msg,'refresh');
		}
		
	}
	function exception(){
		if (isset($_REQUEST['ec']) && !empty($_REQUEST)){
			$payment_response = $_REQUEST;
			$payment_res = base64_encode(json_encode($payment_response));
			//echo '<pre>';print_r($ar);
			$order_id = $payment_response['ec'];
			$transaction = array(
				'transaction_id' => $payment_response['TransactionReference'],
				'transaction_status' => 'EXCEPTION',
				'payment_status' => $payment_response['STATUS'],
				'payment_res' => $payment_res
			);
			$count = $this->payment_model->validate_order_id($order_id)->num_rows();
			if($count >= 1){
				$this->payment_model->update_transaction($order_id,$transaction);
				$msg = 'Your transaction has been uncertain.';
				$orderid =  $payment_response['ec'];
				$payid =  $payment_response['trxid'];
				$msg = base64_encode($msg);
				redirect(WEB_URL.'/error/payment/'.$msg.'/'.$order_id.'/'.$payid,'refresh');
			}else{
				$msg = 'Your transaction has been uncertain and your order doest not exists.';
				$orderid =  $payment_response['ec'];
				$payid =  $payment_response['trxid'];
				$msg = base64_encode($msg);
				redirect(WEB_URL.'/error/payment/'.$msg.'/'.$order_id.'/'.$payid,'refresh');
			}
		}else{
			
			$msg = 'Failure : Your transaction has been uncertain.';
			$msg = base64_encode($msg);
			redirect(WEB_URL.'/error/payment_failure/'.$msg,'refresh');
		}
		
	}
	function cancel(){
		if (isset($_REQUEST['ec']) && !empty($_REQUEST)){
			$payment_response = $_REQUEST;
			$payment_res = base64_encode(json_encode($payment_response));
			//echo '<pre>';print_r($ar);
			$order_id = $payment_response['ec'];
			$transaction = array(
				'transaction_id' => $payment_response['TransactionReference'],
				'transaction_status' => 'CANCEL',
				'payment_status' => $payment_response['STATUS'],
				'payment_res' => $payment_res
			);
			$count = $this->payment_model->validate_order_id($order_id)->num_rows();
			if($count >= 1){
				$this->payment_model->update_transaction($order_id,$transaction);
				$msg = 'Your transaction has been canceled';
				$orderid =  $payment_response['ec'];
				$payid =  $payment_response['trxid'];
				$msg = base64_encode($msg);
				redirect(WEB_URL.'/error/payment/'.$msg.'/'.$order_id.'/'.$payid,'refresh');
				
			}else{
				$msg = 'Your transaction has been canceled and your order doest not exists.';
				$orderid =  $payment_response['ec'];
				$payid =  $payment_response['trxid'];
				$msg = base64_encode($msg);
				redirect(WEB_URL.'/error/payment/'.$msg.'/'.$order_id.'/'.$payid,'refresh');
				
			}
		}else{
			$msg = 'Failure : Your transaction has been canceled';
			$msg = base64_encode($msg);
			redirect(WEB_URL.'/error/payment_failure/'.$msg,'refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
