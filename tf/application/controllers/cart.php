<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('cart_model');
    }

	public function getCartData(){
        $session_id = $this->session->userdata('session_id');
        $cart_data = $this->cart_model->getCart($session_id);
        echo json_encode($cart_data);
    }

    public function removeCart(){
        $ref_id = $this->input->get('refid');
        $cart_id = $this->input->get('cid');
        $session_id = $this->session->userdata('session_id');
        $this->cart_model->removeCart($session_id, $cart_id, $ref_id);
        $cart_data = $this->cart_model->getCart($session_id);
        echo json_encode($cart_data);
    }

    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */