<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-10-17T13:30:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Cart_Model extends CI_Model {
	
	public function getCartData($session_id){
		$this->db->where('session_id',$session_id);
		//$this->db->join('cart_apartment','cart_apartment.ID = cart_global.ref_id');
		return $this->db->get('cart_global');
	}

	public function getCartDataByModule($cart_id,$module){
		$this->db->where('cart_id',$cart_id);
		if($module == 'APARTMENT'){
			$this->db->join('cart_apartment','cart_apartment.ID = cart_global.ref_id');
		}
		if($module == 'FLIGHT'){
			$this->db->join('cart_flight','cart_flight.ID = cart_global.ref_id');
		}
		if($module == 'HOTEL'){
			$this->db->join('cart_hotel','cart_hotel.ID = cart_global.ref_id');
		}
		if($module == 'CAR'){
			$this->db->join('cart_car','cart_car.ID = cart_global.ref_id');
		}
		if($module == 'VACATION'){
			$this->db->join('cart_vacation','cart_vacation.ID = cart_global.ref_id');
		}
		return $this->db->get('cart_global');
	}

	public function getCart($session_id){
		$cart_data = $this->getCartData($session_id)->result();
		$data['count'] = count($cart_data);
		if(count($cart_data) > 0){
			$data['isCart'] = true;
		}else{
			$data['isCart'] = false;
		}
        if(!empty($cart_data)){
            $data['C_URL'] = WEB_URL.'/booking/'.$session_id;
            foreach ($cart_data as $key => $cartt) {
            	if($cartt->module == 'APARTMENT'){
            		$cart = $this->getCartDataByModule($cartt->cart_id,$cartt->module)->row();
	                $data['cart'][] = array(
	                    'RID' => $session_id.'cart'.$key,
	                    'CID' => $cart->cart_id,
	                    'REF_ID' => $cart->ref_id,
	                    'TYPE' => 'apartmentcart',
	                    'NAME' => $cart->PROP_NAME,
	                    'URL' => WEB_URL.'/rooms/'.$cart->PROP_ID,
	                    'ADDRESS' => $cart->PROP_ADDR1.', '.$cart->PROP_CITY.', '.$cart->PROP_REGION.', '.$cart->PROP_COUNTRY_NAME,
	                    'TOTAL' => $this->account_model->currency_convertor($cart->TOTAL),
	                    'IMAGE' => $this->view_property_file($cart->PROP_PHOTO)
	                );
                	$GRAND_TOTAL[] = $cart->TOTAL;
                }else if($cartt->module == 'FLIGHT'){
                	$cart = $this->getCartDataByModule($cartt->cart_id,$cartt->module)->row();
                	$request = json_decode(base64_decode($cart->request));
                	$data['cart'][] = array(
	                    'RID' => $session_id.'cart'.$key,
	                    'CID' => $cart->cart_id,
	                    'REF_ID' => $cart->ref_id,
	                    'TYPE' => 'flightcart',
	                    'NAME' => $cart->fromCityName.' ('.$cart->Origin.') - '.$cart->toCityName.' ('.$cart->Destination.')',
	                    'URL' => WEB_URL,
	                    'ADDRESS' => date('d M, Y H:i', $cart->DepartureTime).' - '.date('d M, Y H:i', $cart->ArrivalTime),
	                    'TOTAL' => $this->account_model->currency_convertor($cart->TotalPrice),
	                    'IMAGE' => $cart->AirImage
	                );
                	$GRAND_TOTAL[] = $cart->TotalPrice;
                }else if($cartt->module == 'HOTEL'){
                    $cart = $this->getCartDataByModule($cartt->cart_id,$cartt->module)->row();
                    $data['cart'][] = array(
                        'RID' => $session_id.'cart'.$key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'hotelcart',
                        'NAME' => $cart->hotel_name.' ('.$cart->room_name.')',
                        'URL' => WEB_URL,
                        'ADDRESS' => $cart->city,
                        'TOTAL' => $this->account_model->currency_convertor($cart->total_cost),
                        'IMAGE' => $cart->imageurl
                    );
                    $GRAND_TOTAL[] = $cart->total_cost;
                }else if($cartt->module == 'CAR'){
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id,$cartt->module)->row();
                    $data['cart'][] = array(
                        'RID' => $session_id.'cart'.$key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'carcart',
                        'NAME' => $cart->pickupCityName.' ('.$cart->Pickup.') - '.$cart->dropoffCityName.' ('.$cart->Dropoff.')',
                        'URL' => WEB_URL,
                        'ADDRESS' => date('d M, Y H:i', $cart->DepartureTime).' - '.date('d M, Y H:i', $cart->ReturnTime),
                        'TOTAL' => $this->account_model->currency_convertor($cart->TotalPrice),
                        'IMAGE' => $cart->CarImage
                    );
                    $GRAND_TOTAL[] = $cart->TotalPrice;
                }else if($cartt->module == 'VACATION'){
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id,$cartt->module)->row();
                    $vacation = json_decode(base64_decode($cart->response));
                    $data['cart'][] = array(
                        'RID' => $session_id.'cart'.$key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'vacationcart',
                        'NAME' => $cart->vacCityName.' ('.$cart->city.') - '.date('d M, Y H:i', strtotime($cart->vacDate)),
                        'URL' => WEB_URL,
                        'ADDRESS' => $vacation->package_name.' - '.$vacation->package_type,
                        'TOTAL' => $this->account_model->currency_convertor($cart->TotalPrice),
                        'IMAGE' => $cart->VacationImage
                    );
                    $GRAND_TOTAL[] = $cart->TotalPrice;
                }
            }
            $data['GRAND_TOTAL'] = $this->account_model->currency_convertor(array_sum($GRAND_TOTAL));
            //$data['GRAND_TOTAL'] = 0;
        }
	    $data['status'] = 1;
        return $data;
	}

	public function removeCart($session_id, $cart_id, $ref_id){
		$this->db->where('cart_id',$cart_id);
		$this->db->where('ref_id',$ref_id);
		$this->db->where('session_id',$session_id);
		$this->db->delete('cart_global');
	}

    public function removeAllCart(){
        $session_id = $this->session->userdata('session_id');
        $this->db->where('session_id',$session_id);
        $this->db->delete('cart_global');
    }
	public function get_currency_info(){
		$this->db->select('*');
	$this->db->order_by('country');
		$query = $this->db->get('currency_converter');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}else{
      			return array();
      		}
      		
	}

	public function view_property_file($PHOTO_CONTENT) {
		$uniqid = uniqid('TAPT'); 
        file_put_contents(FRONT_UPLOAD_PATH . 'temp_image/'.$uniqid.'.jpg', base64_decode($PHOTO_CONTENT));
		
		$url = ASSETS.'upload_files/temp_image/'.$uniqid.'.jpg';
		return $url;
    }

    public function getBookingTemp($session_id){
        $this->db->where('session_id',$session_id);
        /*$this->db->join('cart_apartment','cart_apartment.ID = cart_global.ref_id');
        $data = $this->db->get('cart_global')->row();
        $this->db->join('cart_apartment','cart_apartment.ID = cart_global.ref_id');
        if($data->USER_TYPE == '3'){
            $this->db->join('b2c', 'b2c.user_id = cart_apartment.USER_ID');
        }else if($data->USER_TYPE == '2'){
            $this->db->join('b2b', 'b2b.user_id = cart_apartment.USER_ID');
        }
        $this->db->where('session_id',$session_id);*/
        return $this->db->get('cart_global');
    }
	

	public function getBookingTempByModule($cart_id,$module){
		$this->db->where('cart_id',$cart_id);
		if($module == 'APARTMENT'){
			$this->db->join('cart_apartment','cart_apartment.ID = cart_global.ref_id');
		}
		if($module == 'FLIGHT'){
			$this->db->join('cart_flight','cart_flight.ID = cart_global.ref_id');
		}
		return $this->db->get('cart_global');
	}

    public function insert_cart_global($cart_global){
        $this->db->insert('cart_global', $cart_global);
        return $this->db->insert_id();
    }
}

