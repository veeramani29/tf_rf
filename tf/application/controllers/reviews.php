<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('reviews_model');
        $this->load->model('Auth_Model');
        $this->load->model('email_model');
		$this->load->model('apartment_model');
		
        $this->load->model('verification_model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
        $this->load->model('Help_Model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
    }

	public function index($ref_id,$a_status){
       // $reference = array(
       //     'a_status' => $a_status
       // );
       // $this->reference_model->updateReferenceById($reference,$ref_id);
		//$apartmentUserType = $data['Apartment']->USER_TYPE;
		//$data['host_review_count'] = $this->reviews_model->reviewsAboutYouAccepted($apartmentUserId, $apartmentUserType); 


        redirect(WEB_URL.'/dashboard/profile/reviews');
    }

	function user_reviews($key,$booking_apartment_id='',$stop='')
	{
		
		if($stop!='' && $booking_apartment_id!='')
		{
			$this->reviews_model->update_review_to_stop_user($key,$booking_apartment_id);
		}
		
		$rdata = $this->reviews_model->isvalidKey($key)->num_rows();
		
		if($rdata!='0')
		{
			$rdata2 = $this->reviews_model->isvalidKey($key)->row();
		
			$data['user_data'] = $this->account_model->GetUserData($rdata2->user_type,$rdata2->user_id)->row();
			$data['apartment_data'] = $this->reviews_model->get_apartment_data($booking_apartment_id);
			$data['vid'] =$key;
			$data['booking_apartment_id'] =$booking_apartment_id;
			$this->load->view('public_profile/user_reviews',$data);
		}
		else
		{
			 redirect(WEB_URL);
		}
		
	}
    function host_reviews($key,$booking_apartment_id='',$stop='')
	{
		if($stop!='' && $booking_apartment_id!='')
		{
			$this->reviews_model->update_review_to_stop_host($key,$booking_apartment_id);
		}
		
		$rdata = $this->reviews_model->isvalidKey_host($key)->num_rows();
		
		if($rdata!='0')
		{
			
			$rdata2 = $this->reviews_model->isvalidKey_host($key)->row();
		
			 $data['user_data'] = $this->account_model->GetUserData($rdata2->review_user_type, $rdata2->review_to)->row();
			  $data['host_data'] = $this->account_model->GetUserData($rdata2->host_type, $rdata2->host_id)->row();
			 $data['apartment_data'] = $this->reviews_model->get_apartment_data($booking_apartment_id);
			 $data['vid'] =$key;
			 $data['booking_apartment_id'] =$booking_apartment_id;
			 $this->load->view('public_profile/host_reviews',$data);
			 
		}
		else
		{
			 redirect(WEB_URL);
		}
		
		
		
	}
	 function guest_reviews($key,$booking_apartment_id='',$stop='')
	{
		if($stop!='' && $booking_apartment_id!='')
		{
			$this->reviews_model->update_review_to_stop_guest($key,$booking_apartment_id);
		}
		
		$rdata = $this->reviews_model->isvalidKey_guest($key)->num_rows();
		
		if($rdata!='0')
		{
			
			$rdata2 = $this->reviews_model->isvalidKey_guest($key)->row();
		
			 $data['user_data'] = $this->account_model->GetUserData($rdata2->user_type, $rdata2->user_id)->row();

			 $data['host_data'] = $this->account_model->GetUserData($rdata2->review_user_type, $rdata2->review_to)->row();
			 $data['apartment_data'] = $this->reviews_model->get_apartment_data($booking_apartment_id);
			 $data['vid'] =$key;
			 $data['booking_apartment_id'] =$booking_apartment_id;
			 $this->load->view('public_profile/guest_reviews',$data);
			 
		}
		else
		{
			 redirect(WEB_URL);
		}
		
		
		
	}
	function update_host_reviews($key)
	{
		$comments = '';
		
		$rdata = $this->reviews_model->isvalidKey_host($key)->row();

						  $reviews = array(
                                'host_id' =>  $rdata->host_id,
								'host_type' =>  1,
								'user_id' => 1,
								'user_type' =>  1,
								'review_comments' =>  $comments,
								'domian_id' => '1'
		                  );
        $this->reviews_model->updateReference_host1($reviews);
		$this->reviews_model->deletereview_host($key);	
		$this->load->view('public_profile/host_reviews');
		
	}

	function update_user_reviews($key)
	{
		$this->load->view('public_profile/host_reviews');
	}
	function update_user_reviewdata()
	{
		$rdata = $this->reviews_model->isvalidKey($_POST['vid'])->num_rows();
		if($rdata!='0')
		{
			$rdata2 = $this->reviews_model->isvalidKey($_POST['vid'])->row();
			
			if($this->session->userdata('b2c_id')){
                $data['user_type']=$user_type = 3;
                $data['user_id']=$user_id = $this->session->userdata('b2c_id');
            }else if($this->session->userdata('b2b_id')){
                $data['user_type']=$user_type = 2;
                $data['user_id']=$user_id = $this->session->userdata('b2b_id');
            }

			 if($user_id != "" && $user_id == $rdata2->user_id)
			 { 
					if(isset($_POST['r_recom']))
					{
						$recommended=1;
					}else
					{
						$recommended=0;
					}
						  $reviews = array(
                                'cleanliness' =>  $_POST['Cleanliness'],
								'communication' =>  $_POST['Communication'],
								'checkin' => $_POST['checkin'],
								'costvalue' =>  $_POST['costvalue'],
								'accuracy' => $_POST['Accuracy'],
								'localtion' => $_POST['Locations'],
								'recommended' => $recommended,
								'review_title' => $_POST['r_title'],
								'review_comment' => $_POST['comments'],
								'user_type' => $rdata2->user_type,
								'user_id' => $rdata2->user_id,
								'host_type' => $rdata2->host_type,
								'host_id' => $rdata2->host_id,
								'domain_id' => 1,
								'property_id' => $rdata2->apartment_id
		                  );
					$this->reviews_model->updatereview_data($reviews);
					
					$this->reviews_model->update_review_to_stop_user($_POST['vid'],$rdata2->booking_apartment_id);
						$this->load->view('public_profile/reviews_end');
			 }
			 else
			 {
				 redirect(WEB_URL,'refresh');
			 }
		}else
			 {
				 redirect(WEB_URL,'refresh');
			 }
	}
	function update_host_reviewdata()
	{
		$rdata = $this->reviews_model->isvalidKey_host($_POST['vid'])->num_rows();
		if($rdata!='0')
		{
			$rdata2 = $this->reviews_model->isvalidKey_host($_POST['vid'])->row();
			if($this->session->userdata('b2c_id')){
                $data['user_type']=$user_type = 3;
                $data['user_id']=$user_id = $this->session->userdata('b2c_id');
            }else if($this->session->userdata('b2b_id')){
                $data['user_type']=$user_type = 2;
                $data['user_id']=$user_id = $this->session->userdata('b2b_id');
            }
			 if($user_id != "" && $user_id == $rdata2->host_id)
			 {
				
					if($_POST['recommendation']!='')
					{
						$recommended=$_POST['recommendation'];
					}else
					{
						$recommended='Nil';
					}
						  $reviews = array(
                                
								'review_comments' => $recommended,
								'user_type' => $rdata2->review_user_type,
								'user_id' => $rdata2->review_to,
								'host_type' => $rdata2->host_type,
								'host_id' => $rdata2->host_id,
								'domain_id' => 1
		                  );
					$this->reviews_model->updatereview_data_host($reviews);
					
					$this->reviews_model->update_review_to_stop_host($_POST['vid'],$rdata2->booking_apartment_id);
						$this->load->view('public_profile/reviews_end');
			 }
			 else
			 {
				 redirect(WEB_URL,'refresh');
			 }
		}else
			 {
				 redirect(WEB_URL,'refresh');
			 }
	}
	function update_guest_reviewdata()
	{
		$rdata = $this->reviews_model->isvalidKey_guest($_POST['vid'])->num_rows();
		if($rdata!='0')
		{
			$rdata2 = $this->reviews_model->isvalidKey_guest($_POST['vid'])->row();
			
			if($this->session->userdata('b2c_id')){
                $data['user_type']=$user_type = 3;
                $data['user_id']=$user_id = $this->session->userdata('b2c_id');
            }else if($this->session->userdata('b2b_id')){
                $data['user_type']=$user_type = 2;
                $data['user_id']=$user_id = $this->session->userdata('b2b_id');
            }

			 if($user_id != "" && $user_id == $rdata2->user_id)
			 {
					if($_POST['recommendation']!='')
					{
						$recommended=$_POST['recommendation'];
					}else
					{
						$recommended='Nil';
					}
						  $reviews = array(
                                
								'review_comments' => $recommended,
								'user_type' => $rdata2->user_type,
								'user_id' => $rdata2->user_id,
							
								'host_type' => $rdata2->review_user_type,
								'host_id' => $rdata2->review_to,
								'domain_id' => 1
		                  );
					$this->reviews_model->updatereview_data_guest($reviews);
					
					$this->reviews_model->update_review_to_stop_guest($_POST['vid'],$rdata2->booking_apartment_id);
						$this->load->view('public_profile/reviews_end');
			 }
			 else
			 {
				 redirect(WEB_URL,'refresh');
			 }
		}else
			 {
				 redirect(WEB_URL,'refresh');
			 }
	}
function update_host_reviewdatsssa()
	{
		$rdata = $this->reviews_model->isvalidKey_host($_POST['vid'])->num_rows();
		if($rdata!='0')
		{
			$rdata2 = $this->reviews_model->isvalidKey_host($_POST['vid'])->row();
			
			 if($this->session->userdata('b2c_id') && $this->session->userdata('b2c_id')== $rdata2->host_id)
			 {
				
					if($_POST['recommendation']!='')
					{
						$recommended=$_POST['recommendation'];
					}else
					{
						$recommended='Nil';
					}
						  $reviews = array(
                                
								'review_comments' => $recommended,
								'user_type' => $rdata2->review_user_type,
								'user_id' => $rdata2->review_to,
								'host_type' => $rdata2->host_type,
								'host_id' => $rdata2->host_id,
								'domain_id' => 1
		                  );
					$this->reviews_model->updatereview_data_host($reviews);
					
					$this->reviews_model->update_review_to_stop_host($_POST['vid'],$rdata2->booking_apartment_id);
						$this->load->view('public_profile/reviews_end');
			 }
			 else
			 {
				 redirect(WEB_URL,'refresh');
			 }
		}else
			 {
				 redirect(WEB_URL,'refresh');
			 }
	}
	public function getReviews($apt_id, $prop_user_id,$prop_user_type) { 
		$getReviewData = $this->reviews_model->getReviews($apt_id)->result();
		
		$cleanliness = 0;
		$communication = 0;
		$checkin = 0;
		$location = 0;
		$costvalue = 0;
		$accuracy = 0;
		$recommended = 0;


		$verifiedUserCount = $avgFacilityDenoCount = count($getReviewData);

		if($avgFacilityDenoCount == 0) {
			$data['rating'] = array('clean'=>'', 
								  	'communication'=>'', 
									'checkin'=>'', 
									'location'=>'', 
									'costvalue'=>'', 
									'accuracy'=>'', 
									'overAllAvg'=>'',
									'overAllAvg_prcntge'=>'',
									'recommended'=>'',
									'ratingRemark'=>'',
									'verifiedUserCount'=>'');
			echo json_encode($data['rating']);
			return false;
		}

		foreach($getReviewData as $key) {
			$cleanliness = $cleanliness + $key->cleanliness;
			$communication = $communication + $key->communication;
			$checkin = $checkin + $key->checkin;
			$location = $location + $key->localtion;
			$costvalue = $costvalue + $key->costvalue;
			$accuracy = $accuracy + $key->accuracy;

			if($key->recommended == 1) {
				$recommended = $recommended + 1;
			}

		}
		$cleanlinessAvg = $cleanliness/$avgFacilityDenoCount;
		$communication = $communication/$avgFacilityDenoCount;
		$checkin = $checkin/$avgFacilityDenoCount;
		$location = $location/$avgFacilityDenoCount;
		$costvalue = $costvalue/$avgFacilityDenoCount;
		$accuracy = $accuracy/$avgFacilityDenoCount;

		$cleanliness = round($cleanliness, 1);
		$communication = round($communication, 1);
		$checkin = round($checkin, 1);
		$location = round($location, 1);
		$costvalue = round($costvalue, 1);
		$accuracy = round($accuracy, 1);


		$recommendedAvg_prcntge = ($recommended/$avgFacilityDenoCount)*100;

		$avgOverallDenoCount = 6;
		$overallAvgAdd = $cleanlinessAvg+$communication+$checkin+$location+$costvalue+$accuracy;

		$overAllAvg = $overallAvgAdd/$avgOverallDenoCount;
		$overAllAvg_round = round($overAllAvg, 1);

		$overAllAvg_prcntge = ($overAllAvg_round/6)*100;

		if($overAllAvg_round >= 4 && $overAllAvg_round <= 5) {
			$ratingRemark = "Wonderful!";
		} else if($overAllAvg_round >= 3 && $overAllAvg_round <= 4) {
			$ratingRemark = "Nice";
		} else if($overAllAvg_round >= 2 && $overAllAvg_round <= 3) {
			$ratingRemark = "Neutral";
		} else if($overAllAvg_round >= 1 && $overAllAvg_round <= 2) {
			$ratingRemark = "Neutral";
		} else if($overAllAvg_round >= 1 && $overAllAvg_round <= 0) {
			$ratingRemark = "Dislike";
		} 

		$data['rating'] = array('clean'=>$cleanlinessAvg, 
					  	'communication'=>$communication, 
						'checkin'=>$checkin, 
						'location'=>$location, 
						'costvalue'=>$costvalue, 
						'accuracy'=>$accuracy, 
						'overAllAvg'=>$overAllAvg_round,
						'overAllAvg_prcntge'=>$overAllAvg_prcntge,
						'recommended'=>$recommendedAvg_prcntge,
						'ratingRemark'=>$ratingRemark,
						'verifiedUserCount'=>$verifiedUserCount);

		$data['reviews'] = $this->reviews_model->reviewsAboutPropAccepted($prop_user_id, $prop_user_type)->result();
		echo json_encode($data);
	}

	public function reviewAboutYouHostStatus($reviews_host_data_id, $status) {
		$this->reviews_model->reviewAboutYouHostStatus($reviews_host_data_id, $status);
		redirect(WEB_URL.'/dashboard/profile/reviews');
	}

	public function reviewAboutYouGuestStatus($reviews_guest_data_id, $status) {
		$this->reviews_model->reviewAboutYouGuestStatus($reviews_guest_data_id, $status);
		redirect(WEB_URL.'/dashboard/profile/reviews');
	}

	public function reviewAboutPropStatus($reviews_host_data_id, $status) {
		$this->reviews_model->reviewAboutPropStatus($reviews_host_data_id, $status);
		redirect(WEB_URL.'/dashboard/profile/reviews');
	}

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
