<?phpif (!defined('BASEPATH'))    exit('No direct script access allowed');class B2b extends CI_Controller {    public function __construct() {        parent::__construct();        $this->load->database();        $this->load->model('B2b_Model');        $this->load->model('Home_Model');        $this->is_admin_logged_in();    }    private function is_admin_logged_in() {        if (!$this->session->userdata('admin_logged_in')) {            redirect('login/index');        }    }    function create_user() {        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[agent_info.user_email]');        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]');        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');        //$this->form_validation->set_rules('user_logo', 'User Picture', 'trim|required');        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');        $this->form_validation->set_rules('address', 'Address', 'trim|required');        $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');        $this->form_validation->set_rules('city', 'City', 'trim|required');        $this->form_validation->set_rules('state', 'State', 'trim|required');        $this->form_validation->set_rules('country', 'Country', 'required');        $data['status'] = '';        $data['errors'] = '';        $data['country_list'] = $this->Home_Model->get_country_list();        if ($this->form_validation->run() == FALSE) {            $data['user_email'] = $this->input->post('user_email');            $data['first_name'] = $this->input->post('first_name');            $data['middle_name'] = $this->input->post('middle_name');            $data['last_name'] = $this->input->post('last_name');            $data['company_name'] = $this->input->post('company_name');            $data['mobile_no'] = $this->input->post('mobile_no');            $data['address'] = $this->input->post('address');            $data['pin_code'] = $this->input->post('pin_code');            $data['city'] = $this->input->post('city');            $data['state'] = $this->input->post('state');            $this->load->view('b2b/create_user', $data);        } else {            //echo '<pre/>';print_r($_POST);exit;            $user_email = $this->input->post('user_email');            $user_password = $this->input->post('user_password');            $title = $this->input->post('title');            $first_name = $this->input->post('first_name');            $middle_name = $this->input->post('middle_name');            $last_name = $this->input->post('last_name');            $company_name = $this->input->post('company_name');            $mobile_no = $this->input->post('mobile_no');            $address = $this->input->post('address');            $pin_code = $this->input->post('pin_code');            $city = $this->input->post('city');            $state = $this->input->post('state');            $country = $this->input->post('country');            $email_check = $this->B2b_Model->check_email_availability($user_email);            if ($email_check != '' || !empty($email_check)) {                $data['errors'] = 'Email Already Exists. Please use different email id to continue registration...';                $this->load->view('b2b/create_user', $data);            } else {                                if($_FILES['user_logo'] != ''){                    $ext = pathinfo($_FILES['user_logo']['name'],PATHINFO_EXTENSION);                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){                        $uploadPath = Image_Path;                        $newFileName = 'agentlogo_'.date('YmdHis').'.'.$ext;                        //echo $uploadPath.$newFileName;die;                        move_uploaded_file($_FILES['user_logo']['tmp_name'],$uploadPath.$newFileName);                        $user_logo = $newFileName;                    } else {                        $user_logo = '';                    }                 } else {                    $user_logo = '';                }                                $reg = $this->B2b_Model->add_user($user_email, $user_password, $title, $first_name, $middle_name, $last_name,$company_name, $mobile_no, $address, $pin_code, $city, $state, $country, $user_logo);                if ($reg != '') {                     ##################### MAIL TO USER  ##################################                    $to = trim($email);                    $toAdmin = 'info@redtagtravels.com';                    $subject = 'Welcome Agent to Redtag Travels';                    $subjectAdmin = 'New Agent Registration Notification';                    $headers = "From: info@redtagtravels.com\r\n";                    $headers .= "Reply-To: info@redtagtravels.com\r\n";                    $headers .= "MIME-Version: 1.0\r\n";                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";                    $headers.= "X-Priority: 1\r\n";                     $message = $this->load->view('b2b/registration_mail',$reg,true);                    mail($to, $subject, $message, $headers);                    mail($toAdmin, $subjectAdmin, $message, $headers);                    ###############################################################################                     redirect('b2b/user_manager', 'refresh');                } else {                    $data['errors'] = 'User Registration Not Done. Please try after some time...';                    $this->load->view('b2b/user_manager', $data);                }            }        }    }    public function user_manager() {        $data['user_info'] = $this->B2b_Model->get_user_list();        //echo '<pre/>';print_r($data['user_info']);exit;        $this->load->view('b2b/user_manager', $data);    }    function manage_user_status() {        if (isset($_POST['user_id']) && isset($_POST['status'])) {            $user_id = $_POST['user_id'];            $status = $_POST['status'];            $update = $this->B2b_Model->manage_user_status($user_id, $status);            echo $update;        } else {            return false;        }    }    public function view_user_info($user_id = '', $status = '', $errors = '') {        $data['status'] = $status;        $data['errors'] = $errors;        $data['country_list'] = $this->Home_Model->get_country_list();        $data['user_id'] = $user_id;        $data['user_info'] = $this->B2b_Model->get_user_info_by_id($user_id);        $this->load->view('b2b/view_user_info', $data);    }    function update_user_info() {        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');        $this->form_validation->set_rules('address', 'Address', 'trim|required');        $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');        $this->form_validation->set_rules('city', 'City', 'trim|required');        $this->form_validation->set_rules('state', 'State', 'trim|required');        $this->form_validation->set_rules('country', 'Country', 'required');        $data['status'] = '';        $data['errors'] = '';        $data['country_list'] = $this->Home_Model->get_country_list();        $data['user_id'] = $user_id = $this->input->post('user_id');        $data['user_info'] = $this->B2b_Model->get_user_info_by_id($user_id);        if ($this->form_validation->run() == FALSE) {            $this->load->view('b2b/view_user_info', $data);        } else {            //echo '<pre/>';print_r($_POST);exit;            $user_id = $this->input->post('user_id');            $title = $this->input->post('title');            $first_name = $this->input->post('first_name');            $middle_name = $this->input->post('middle_name');            $last_name = $this->input->post('last_name');            $company_name = $this->input->post('company_name');            $mobile_no = $this->input->post('mobile_no');            $address = $this->input->post('address');            $pin_code = $this->input->post('pin_code');            $city = $this->input->post('city');            $state = $this->input->post('state');            $country = $this->input->post('country');            $user_email = $this->input->post('user_email');            $user_logo = $this->input->post('user_logo');            /* $file_name = $_FILES['user_logo']['tmp_name'];              if(!empty($file_name))              {              $config['upload_path'] = './upload_files/b2c/images/'.$user_email.'/logos/';              $config['allowed_types'] = 'gif|jpg|png';              $config['overwrite'] = TRUE;              $config['max_size'] = '0';              $config['max_width']  = '0';              $config['max_height']  = '0';              $this->load->library('upload', $config);              if(!is_dir($config['upload_path'])){              mkdir($config['upload_path'], 0755, TRUE);              }              if(!$this->upload->do_upload('user_logo'))              {              $error = $this->upload->display_errors();              $data['errors'] =$error;              $this->load->view('b2c/view_user_info',$data);              }              else              {              $upload_data = $this->upload->data();              $image_config["image_library"] = "gd2";              $image_config["source_image"] = $upload_data["full_path"];              $image_config['create_thumb'] = FALSE;              $image_config['maintain_ratio'] = TRUE;              $image_config['new_image'] = $upload_data["file_path"] . 'user_logo.png';              $image_config['quality'] = "100%";              $image_config['width'] = 320;              $image_config['height'] = 80;              $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);              $image_config['master_dim'] = ($dim > 0)? "height" : "width";              $this->load->library('image_lib');              $this->image_lib->initialize($image_config);              if(!$this->image_lib->resize())  //Resize image              $error = $this->upload->display_errors();              $data['errors'] =$error;              $this->load->view('b2c/view_user_info',$data); //If error, redirect to an error page              }              else              {              unlink($upload_data["full_path"]);              $image_path = WEB_DIR.'upload_files/b2c/images/'.$agent_email.'/logos/user_logo.png';              if($this->B2b_Model->update_user($user_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$image_path))              {              redirect('b2c/view_user_info/'.$user_id.'/1','refresh');              }              else              {              $data['errors'] = 'User Profile Not Updated. Please try after some time...';              $this->load->view('b2c/view_user_info',$data);              }              }              }              }              else              {              if($this->B2b_Model->update_user($user_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$user_logo))              {              redirect('b2c/view_user_info/'.$user_id.'/1','refresh');              }              else              {              $data['errors'] = 'User Profile Not Updated. Please try after some time...';              $this->load->view('b2c/view_user_info',$data);              }              }             */            if ($this->B2b_Model->update_user($user_id, $title, $first_name, $middle_name, $last_name,$company_name, $mobile_no, $address, $pin_code, $city, $state, $country, $user_logo)) {                redirect('b2b/view_user_info/' . $user_id . '/1', 'refresh');            } else {                $data['errors'] = 'Agent Profile Not Updated. Please try after some time...';                $this->load->view('b2b/view_user_info', $data);            }        }    }    function change_user_password($user_id = '') {        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');        $data['status'] = '';        $data['errors'] = '';        $data['user_id'] = $user_id;        $data['user_info'] = $user_info = $this->B2b_Model->get_user_info_by_id($user_id);        if ($this->form_validation->run() == FALSE) {            $this->load->view('b2b/change_user_password', $data);        } else {            if ($this->input->post('password') == $this->input->post('passconf')) {                $password = md5($this->input->post('password'));                if ($this->B2b_Model->update_user_password($user_id, $password)) {                    $data['status'] = 1;                } else {                    $data['errors'] = 'Agent Password not Updated. Please try after some time...';                }            } else {                $data['errors'] = 'Current Password is wrong. Please enter correct current password...';            }            $this->load->view('b2b/change_user_password', $data);        }    }    // B2C Hotel Markup Manager    public function hotel_markup_manager() {        $data['agentLists'] = $this->B2b_Model->getAllAgentList();        $this->load->view('b2b/hotel_markup_manager', $data);    }    // B2C Flight Markup Manager    public function flight_markup_manager() {        $data['agentLists'] = $this->B2b_Model->getAllAgentList();        $this->load->view('b2b/flight_markup_manager', $data);    }    // B2C Car Markup Manager    public function car_markup_manager() {        $data['api_list'] = $this->Home_Model->get_api_list();        $data['country_list'] = $this->Home_Model->get_country_list();        $data['b2c_markup_list'] = $this->B2b_Model->get_car_markup_list();        //echo '<pre/>';print_r($data);exit;        $this->load->view('b2b/car_markup_manager', $data);    }    function update_b2c_markups() {        if (isset($_POST) && isset($_POST['service_type'])) {            $service_type = $_POST['service_type'];            $markup_type = $_POST['markup_type'];            $api_name = $_POST['api_name'];            $markup = $_POST['markup'];            $country = $_POST['country'];            $currency = $_POST['currency'];            $city = NULL;            $hotel = NULL;            $airline = NULL;            if ($markup_type == 'specific_city') {                $city = $_POST['city'];            }            if ($markup_type == 'specific_hotel') {                $city = 'hotel';                $hotel = $_POST['hotel'];            }            if ($markup_type == 'specific_airline') {                $city = 'airline';                $airline = $_POST['airline'];            }            if ($api_name == 'all') {                if ($markup_type == 'generic') {                    $this->B2b_Model->delete_b2c_markup($markup_type, $service_type);                }                $api_list = $this->Home_Model->get_api_list();                for ($i = 0; $i < count($api_list); $i++) {                    if ($api_list[$i]->service_type == $service_type) {                        $check = $this->B2b_Model->b2c_markup_checking($country, $city, $hotel, $airline, $api_list[$i]->api_name, $markup_type, $service_type, $currency);                        if ($check == '') {                            $this->B2b_Model->add_b2c_markup($country, $city, $hotel, $airline, $api_list[$i]->api_name, $markup, $markup_type, $service_type, $currency);                        } else {                            $this->B2b_Model->delete_id_b2c_markup($country, $city, $hotel, $airline, $api_list[$i]->api_name, $markup_type, $service_type, $currency);                            $this->B2b_Model->add_b2c_markup($country, $city, $hotel, $airline, $api_list[$i]->api_name, $markup, $markup_type, $service_type, $currency);                        }                    }                }            } else {                $check = $this->B2b_Model->b2c_markup_checking($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency);                if ($check == '') {                    $this->B2b_Model->add_b2c_markup($country, $city, $hotel, $api_name, $airline, $markup, $markup_type, $service_type, $currency);                } else {                    $this->B2b_Model->delete_id_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency);                    $this->B2b_Model->add_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup, $markup_type, $service_type, $currency);                }            }            echo '1';        } else {            echo '1';        }    }    function manage_b2c_markup_status() {        if (isset($_POST['markup_id']) && isset($_POST['status'])) {            $markup_id = $_POST['markup_id'];            $status = $_POST['status'];            if ($status != '2') {                $update = $this->B2b_Model->manage_b2c_markup_status($markup_id, $status);            } else {                $update = $this->B2b_Model->delete_b2c_markup_status($markup_id);            }            echo $update;        } else {            return false;        }    }    public function b2b_reports_manager() {        $data['flight_booking_summary'] = $this->B2b_Model->get_b2c_flight_booking_summary();        $data['hotel_booking_summary'] = $this->B2b_Model->get_b2c_hotel_booking_summary();        $data['car_booking_summary'] = $this->B2b_Model->get_b2c_car_booking_summary();        //echo '<pre/>';print_r($data);exit;        $this->load->view('b2b/b2b_reports_manager', $data);    }        public function markup_list()    {        $data['agentLists'] = $this->B2b_Model->getAllAgentList();                $this->load->view('b2b/manage_markup',$data);    }        function manage_markup_status() {        if (isset($_POST['user_id']) && isset($_POST['status'])) {            $user_id = $_POST['user_id'];            $status = $_POST['status'];            $update = $this->B2b_Model->manage_markup_status($user_id, $status);            echo $update;        } else {            return false;        }    }        function add_markup($id='')    {                if($_POST)        {            $domFlight = $this->input->post('domestic_flight');            $IntFlight = $this->input->post('international_flight');            $hotel = $this->input->post('hotels');            $car = $this->input->post('cars');            $package = $this->input->post('packages');            $sightseen = $this->input->post('sightseen');            $addMarkup = $this->B2b_Model->add_markup($domFlight,$IntFlight,$hotel,$car,$package,$sightseen);            redirect('b2b/markup_list','refresh');        }        else        {            $query = $this->db->query($sql="select * from admin_markup where module_type='b2b'");            if($query->num_rows() > 0)            {                $data['markup'] = $query->row();            }            else            {                $data['markup'] = '';            }            $this->load->view('b2b/add_markup',$data);        }            }        function update_markup($id='')    {        if($_POST)        {            $agent_id = $this->input->post('agent_id');            $domFlight = $this->input->post('domestic_flight');            $IntFlight = $this->input->post('international_flight');            $hotel = $this->input->post('hotels');            $car = $this->input->post('cars');            $package = $this->input->post('packages');            $sightseen = $this->input->post('sightseen');            $addMarkup = $this->B2b_Model->add_markup_agent($agent_id,$domFlight,$IntFlight,$hotel,$car,$package,$sightseen);            redirect('b2b/markup_list','refresh');        }        else        {            $query = $this->db->query($sql="select * from admin_markup where module_type='b2b' and agent_id='".$id."'");            if($query->num_rows() > 0)            {                $data['markup'] = $query->row();            }            else            {                $data['markup'] = '';            }                        $data['agent_id'] = $id;            $this->load->view('b2b/update_markup',$data);        }    }        function manage_deposit()    {        $data['agent_list'] = $this->B2b_Model->getAllAgentList();        $this->load->view('b2b/manage_deposit',$data);            }        function add_deposit($id = '')    {        if($_POST)        {            //echo '<pre />';print_r($_POST);die;            $deposit_type = $this->input->post('deposit_type');            $deposit_amount = $this->input->post('deposit_amount');            $mobile_number = $this->input->post('mobile_number');            if($deposit_type == 'Cash')            {                $transection_id = $this->input->post('cash_transection_id');                $deposit_bank = $this->input->post('cash_deposit_bank');                $bank_branch = $this->input->post('cash_bank_branch');                                if(file_exists(Agent_Deposit_Path)){                    $path = Agent_Deposit_Path.'';                } else {                    mkdir(Agent_Deposit_Path);                    $path = Agent_Deposit_Path;                }                                if($_FILES['cash_scan_copy'] != ''){                    $ext = pathinfo($_FILES['cash_scan_copy']['name'],PATHINFO_EXTENSION);                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){                        $uploadPath = $path;                        $newFileName = 'depscancopy_'.date('YmdHis').'.'.$ext;                        //echo $uploadPath.$newFileName;die;                        move_uploaded_file($_FILES['cash_scan_copy']['tmp_name'],$uploadPath.'/'.$newFileName);                        $scanCopy = $newFileName;                    } else {                        $scanCopy = '';                    }                 } else {                    $scanCopy = '';                }                                $cheque_drawn_bank = '';                $cheque_issue_date = '';                $cheque_no = '';                            }            if($deposit_type == 'Cheque')            {                $transection_id = $this->input->post('cheque_transection_id');                                $cheque_drawn_bank = $this->input->post('cheque_drawn_bank');                $cheque_issue_date = $this->input->post('cheque_issue_date');                $cheque_no = $this->input->post('cheque_no');                                $deposit_bank = $this->input->post('cheque_deposit_bank');                $bank_branch = $this->input->post('cheque_bank_branch');                if(file_exists(Agent_Deposit_Path)){                    $path = Agent_Deposit_Path.'';                } else {                    mkdir(Agent_Deposit_Path);                    $path = Agent_Deposit_Path;                }                                if($_FILES['cheque_scan_copy'] != ''){                    $ext = pathinfo($_FILES['cheque_scan_copy']['name'],PATHINFO_EXTENSION);                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){                        $uploadPath = $path;                        $newFileName = 'depscancopy_'.date('YmdHis').'.'.$ext;                        //echo $uploadPath.$newFileName;die;                        move_uploaded_file($_FILES['cheque_scan_copy']['tmp_name'],$uploadPath.'/'.$newFileName);                        $scanCopy = $newFileName;                    } else {                        $scanCopy = '';                    }                 } else {                    $scanCopy = '';                }                            }            if($deposit_type == 'Bank Transfer')            {                $transection_id = $this->input->post('bank_transfer_transection_id');                $deposit_bank = $this->input->post('bank_transfer_deposit_bank');                $bank_branch = $this->input->post('bank_transfer_bank_branch');                                $cheque_drawn_bank = '';                $cheque_issue_date = '';                $cheque_no = '';                                if(file_exists(Agent_Deposit_Path)){                    $path = Agent_Deposit_Path.'';                } else {                    mkdir(Agent_Deposit_Path);                    $path = Agent_Deposit_Path;                }                                if($_FILES['bank_transfer_scan_copy'] != ''){                    $ext = pathinfo($_FILES['bank_transfer_scan_copy']['name'],PATHINFO_EXTENSION);                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){                        $uploadPath = $path;                        $newFileName = 'depscancopy_'.date('YmdHis').'.'.$ext;                        //echo $uploadPath.$newFileName;die;                        move_uploaded_file($_FILES['bank_transfer_scan_copy']['tmp_name'],$uploadPath.'/'.$newFileName);                        $scanCopy = $newFileName;                    } else {                        $scanCopy = '';                    }                 } else {                    $scanCopy = '';                }            }                        $add_val = $this->input->post('add_val');                        if($scanCopy != ''){                $addDeposit = $this->B2b_Model->addDepositMoney($add_val,$deposit_type,$deposit_amount,$mobile_number,$transection_id,$deposit_bank,$bank_branch,$cheque_drawn_bank,$cheque_issue_date,$cheque_no,$scanCopy);                redirect('b2b/manage_deposit','refresh');            } else {                $data['id'] = $add_val;                $data['comp_info'] = $this->B2b_Model->getCompanyNameOnId($add_val);                $data['error'] = 'Please upload the transection scan copy';                $this->load->view('b2b/add_deposit',$data);            }        }        else        {            $data['id'] = $id;            $data['comp_info'] = $this->B2b_Model->getCompanyNameOnId($id);            $this->load->view('b2b/add_deposit',$data);        }    }        function view_deposit_history($id)    {        $data['val_id'] = $id;        $data['agent_details'] = $this->B2b_Model->getAgentDetailsOnId($id);        $data['deposit_details'] = $this->B2b_Model->getAllDepositHistoryById($id);        $this->load->view('b2b/deposit_history',$data);    }        function view_deposit($id){                $data['tran_details'] = $this->B2b_Model->getTransectionDetailsOnId($id);                if($data['tran_details'] != ''){            $data['agentDetails'] = $this->B2b_Model->getAgentDetailsOnId($data['tran_details']->agent_id);            $data['id'] = $id;            $this->load->view('b2b/view_deposit',$data);        }        else        {            redirect('b2b/manage_new_deposit');        }    }        function manage_new_deposit()    {        $data['new_deposit'] = $this->B2b_Model->getAllNewDepositRequest();        $this->load->view('b2b/manage_new_deposit',$data);    }        function activate_new_deposit($id = '')    {        if($_POST)        {            $status = $this->input->post('activate_deposit');            if($status != ''){                $depId = $this->input->post('add_val');                $this->B2b_Model->activateUserDepositRequest($depId,$status);                redirect('b2b/manage_new_deposit','refresh');            }            else            {                redirect('b2b/manage_new_deposit','refresh');            }                    }        else        {            $data['tran_details'] = $this->B2b_Model->getTransectionDetailsOnId($id);            if($data['tran_details'] != ''){                $data['id'] = $id;                $this->load->view('b2b/activate_new_deposit',$data);            }            else            {                redirect('b2b/manage_new_deposit');            }        }    }        function hotel_booking_report(){        $data['bookings'] = $this->B2b_Model->getAllHotelBookings();        $this->load->view('b2b/hotel_booking_report',$data);    }        function updateAgentFlightMarkup(){        if($_POST){            $data = $_POST;            $this->B2b_Model->updateAgentFlightMarkup($data);        }    }        function updateAgentHotelMarkup(){        if($_POST){            $data = $_POST;            $this->B2b_Model->updateAgentHotelMarkup($data);        }    }}/* End of file b2b.php *//* Location: ./admin/controllers/b2b.php */