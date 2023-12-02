<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0);
error_reporting(E_ALL);
session_start();

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Home_Model');
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $user_info = $this->Home_Model->getUserInfoOnId($_SESSION['agent']['user_id']);
            $_SESSION['agent']['depositBalance'] = $this->Home_Model->getAgentDepositBalance($_SESSION['agent']['user_id']);
            $_SESSION['agent']['agentName'] = $user_info->first_name;
            $_SESSION['agent']['companyName'] = $user_info->company_name;
            $_SESSION['agent']['userNo'] = $user_info->user_no;
        }
    }

    public function login($status = '') {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            redirect('home/searchengine');
        } else {
            $this->form_validation->set_rules('agent_email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('agent_pass', 'Password', 'trim|required');
            $data['status'] = $status;
            if ($this->form_validation->run() == FALSE) {
                $data['agent_email'] = $this->input->post('agent_email');
                $data['agent_pass'] = $this->input->post('agent_pass');
                $this->load->view('login', $data);
            } else {
                $data['agent_email'] = $this->input->post('agent_email');
                $data['agent_pass'] = $this->input->post('agent_pass');
                $login = $this->Home_Model->checkUserLoginExist($data);
                if ($login !== '') {
                    ##################### Agent Loggedin Data  ##################################
                    $_SESSION['agent']['logged_in'] = '1';
                    $_SESSION['agent']['email'] = $login->user_email;
                    $_SESSION['agent']['user_id'] = $login->user_id;
                    $_SESSION['agent']['user_type'] = $login->user_type;
                    ###############################################################################
                    redirect('home/searchengine');
                } else {
                    redirect('home/login/failed');
                }
            }
        }
    }

    public function register($status = '') {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            redirect('home/dashboard');
        } else {
            $data['phone_codes'] = $this->Home_Model->getAllCountryPhoneCodes();
            $this->form_validation->set_rules('agent_name', 'Agent Name', 'trim|required');
            $this->form_validation->set_rules('agent_email', 'Email', 'trim|required|valid_email|is_unique[agent_info.user_email]');
            $this->form_validation->set_rules('phone_code', 'Mobile Code', 'trim|required|integer|min_length[2]|max_length[3]');
            $this->form_validation->set_rules('phone_no', 'Mobile No', 'trim|required|integer|min_length[10]|max_length[10]');
            $data['status'] = $status;
            $data['country_list'] = $this->Home_Model->getAllCountryList();
            if ($this->form_validation->run() == FALSE) {
                $data['agent_name'] = $this->input->post('agent_name');
                $data['agent_email'] = $this->input->post('agent_email');
                $data['company_name'] = $this->input->post('company_name');
                $data['agent_country'] = $this->input->post('agent_country');
                $data['agent_city'] = $this->input->post('agent_city');
                $data['phone_code'] = $this->input->post('phone_code');
                $data['phone_no'] = $this->input->post('phone_no');
                $data['agent_comments'] = $this->input->post('agent_comments');
                $this->load->view('register', $data);
            } else {
                $data['agent_name'] = $this->input->post('agent_name');
                $data['agent_email'] = $this->input->post('agent_email');
                $data['company_name'] = $this->input->post('company_name');
                $data['agent_country'] = $this->input->post('agent_country');
                $data['agent_city'] = $this->input->post('agent_city');
                $data['phone_code'] = $this->input->post('phone_code');
                $data['phone_no'] = $this->input->post('phone_no');
                $data['agent_comments'] = $this->input->post('agent_comments');
                $register = $this->Home_Model->registerNewUserData($data);
                if ($register !== '') {
                    $data['pass'] = $register['password'];
                    $data['user_no'] = $register['user_no'];
                    ##################### MAIL TO USER  ##################################
                    $to = trim($data['agent_email']);
                    $subject = 'Welcome to Redtag Travels - Agent Portal';
                    $headers = "From: info@redtagtravels.com\r\n";
                    $headers .= "Reply-To: info@redtagtravels.com\r\n";
                    $headers .= "CC: pm.ajtravellabs@gmail.com\r\n";
                    $headers .= "CC: faye.b@redtagtravels.com\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headers.= "X-Priority: 1\r\n";
                    $message = $this->load->view('home/registration_mail', $data, true);
                    mail($to, $subject, $message, $headers);
                    ###############################################################################
                    redirect('home/register/success');
                } else {
                    redirect('home/register/failed');
                }
            }
        }
    }

    public function dashboard() {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $data = '';
            $this->load->view('home/dashboard', $data);
        } else {
            redirect('home/login');
        }
    }

    public function user_profile() {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $data['user_data'] = $this->Home_Model->getUserDetails($_SESSION['agent']['user_id']);
            $data['country_list'] = $this->Home_Model->getAllCountryList();
            $this->load->view('home/user/user_profile', $data);
        } else {
            redirect('home');
        }
    }

    public function manage_deposit() {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $data['deposit_list'] = $this->Home_Model->getAgentDepositList($_SESSION['agent']['user_id']);
            $this->load->view('home/user/manage_deposit', $data);
        } else {
            redirect('home');
        }
    }

    public function subagent_list() {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $data['sub_agent_list'] = $this->Home_Model->getAllSubAgentListOnAgentId($_SESSION['agent']['user_id']);
            $this->load->view('home/subagent/subagent_list', $data);
        } else {
            redirect('home');
        }
    }

    public function add_subagent() {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $data['country_list'] = $this->Home_Model->getAllCountryList();
            $this->load->view('home/subagent/add_subagent', $data);
        } else {
            redirect('home');
        }
    }

    public function subagent_markup() {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $data['sub_agent_list'] = $this->Home_Model->getAllSubAgentListOnAgentId($_SESSION['agent']['user_id']);
            $this->load->view('home/subagent/subagent_markup', $data);
        } else {
            redirect('home');
        }
    }

    public function subagent_markup_list($subAgentId = '') {
        if ($subAgentId != '') {
            $data['subagent_id'] = $subAgentId;
            $data['airline_list'] = $this->Home_Model->getAllAirlineList();
            $data['fl_markup_data'] = $this->Home_Model->getSubAgentFlightMarkupOnId($subAgentId,$_SESSION['agent']['user_id']);
            $data['ho_markup_data'] = $this->Home_Model->getSubAgentHotelMarkupOnId($subAgentId,$_SESSION['agent']['user_id']);
            $this->load->view('home/subagent/markup_list', $data);
        }
    }

    public function markup_list() {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $data['airline_list'] = $this->Home_Model->getAllAirlineList();
            $data['fl_markup_data'] = $this->Home_Model->getAgentFlightMarkupOnId($_SESSION['agent']['user_id'],$_SESSION['agent']['user_type']);
            $data['ho_markup_data'] = $this->Home_Model->getAgentHotelMarkupOnId($_SESSION['agent']['user_id'],$_SESSION['agent']['user_type']);
            $this->load->view('home/user/markup_list', $data);
        } else {
            redirect('home');
        }
    }

    public function subagent_deposit($status = '') {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $data['sub_agent_list'] = $this->Home_Model->getAllSubAgentListOnAgentId($_SESSION['agent']['user_id']);
            $data['status'] = $status;
            $this->load->view('home/subagent/subagent_deposit', $data);
        } else {
            redirect('home');
        }
    }

    function changeSubAgentStatus($subAgentId, $status) {
        $change = $this->Home_Model->changeSubAgentStatus($_SESSION['agent']['user_id'], $subAgentId, $status);
        if ($change) {
            $result = 0;
        } else {
            $result = 1;
        }

        echo json_encode(array('result' => $result));
    }

    public function add_deposit_data() {
        if (isset($_POST)) {
            $err = 0;
            $data = $_POST;
            $deposit_type = $data['deposit_type'];
            $deposit_amount = $data['deposit_amount'];
            $mobile_number = $data['mobile_number'];
            $extArr = array('jpeg', 'jpg', 'png', 'gif');
            if ($deposit_type === 'Cash') {
                $transection_id = $data['cash_transection_id'];
                $deposit_bank = $data['cash_deposit_bank'];
                $bank_branch = $data['cash_bank_branch'];
                $cheque_drawn_bank = '';
                $cheque_issue_date = '';
                $cheque_no = '';
                if (isset($_FILES['cash_scan_copy']['name'])) {
                    $filename = $_FILES['cash_scan_copy']['name'];
                    $tmpFileName = $_FILES['cash_scan_copy']['tmp_name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $newFileName = date('ymdHis') . '_' . $_SESSION['agent']['user_id'] . '.' . $ext;
                } else {
                    $filename = '';
                    $ext = '';
                }

                if ($deposit_amount == '' || !is_numeric($deposit_amount)) {
                    $err = 1;
                } else if ($mobile_number == '' || !is_numeric($mobile_number)) {
                    $err = 1;
                } else if ($transection_id == '') {
                    $err = 1;
                } else if ($deposit_bank == '') {
                    $err = 1;
                } else if ($bank_branch == '') {
                    $err = 1;
                } else if ($filename == '') {
                    $err = 1;
                } else if (!in_array($ext, $extArr)) {
                    $err = 1;
                } else {
                    $err = 0;
                }
            }

            if ($deposit_type === 'Cheque') {
                $transection_id = $data['cheque_transection_id'];
                $cheque_drawn_bank = $data['cheque_drawn_bank'];
                $cheque_issue_date = $data['cheque_issue_date'];
                $cheque_no = $data['cheque_no'];
                $deposit_bank = $data['cheque_deposit_bank'];
                $bank_branch = $data['cheque_bank_branch'];
                if (isset($_FILES['cheque_scan_copy']['name'])) {
                    $filename = $_FILES['cheque_scan_copy']['name'];
                    $tmpFileName = $_FILES['cheque_scan_copy']['tmp_name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $newFileName = date('ymdHis') . '_' . $_SESSION['agent']['user_id'] . '.' . $ext;
                } else {
                    $filename = '';
                    $ext = '';
                }

                if ($deposit_amount == '' || !is_numeric($deposit_amount)) {
                    $err = 1;
                } else if ($mobile_number == '' || !is_numeric($mobile_number)) {
                    $err = 1;
                } else if ($transection_id == '') {
                    $err = 1;
                } else if ($cheque_drawn_bank == '') {
                    $err = 1;
                } else if ($cheque_issue_date == '') {
                    $err = 1;
                } else if ($cheque_no == '') {
                    $err = 1;
                } else if ($deposit_bank == '') {
                    $err = 1;
                } else if ($bank_branch == '') {
                    $err = 1;
                } else if ($filename == '') {
                    $err = 1;
                } else if (!in_array($ext, $extArr)) {
                    $err = 1;
                } else {
                    $err = 0;
                }
            }

            if ($deposit_type === 'Bank Transfer') {
                $transection_id = $data['bank_transfer_transection_id'];
                $deposit_bank = $data['bank_transfer_deposit_bank'];
                $bank_branch = $data['bank_transfer_bank_branch'];
                $cheque_drawn_bank = '';
                $cheque_issue_date = '';
                $cheque_no = '';
                if (isset($_FILES['bank_transfer_scan_copy']['name'])) {
                    $filename = $_FILES['bank_transfer_scan_copy']['name'];
                    $tmpFileName = $_FILES['bank_transfer_scan_copy']['tmp_name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $newFileName = date('ymdHis') . '_' . $_SESSION['agent']['user_id'] . '.' . $ext;
                } else {
                    $filename = '';
                    $ext = '';
                }

                if ($deposit_amount == '' || !is_numeric($deposit_amount)) {
                    $err = 1;
                } else if ($mobile_number == '' || !is_numeric($mobile_number)) {
                    $err = 1;
                } else if ($transection_id == '') {
                    $err = 1;
                } else if ($deposit_bank == '') {
                    $err = 1;
                } else if ($bank_branch == '') {
                    $err = 1;
                } else if ($filename == '') {
                    $err = 1;
                } else if (!in_array($ext, $extArr)) {
                    $err = 1;
                } else {
                    $err = 0;
                }
            }


            if ($err == 0) {
                $target = Image_Path;
                move_uploaded_file($tmpFileName, $target . $newFileName);

                $addDeposit = $this->Home_Model->addDepositMoney($_SESSION['agent']['user_id'], $_SESSION['agent']['user_type'], $deposit_type, $deposit_amount, $mobile_number, $transection_id, $deposit_bank, $bank_branch, $cheque_drawn_bank, $cheque_issue_date, $cheque_no, $newFileName);
                if ($addDeposit > 0) {
                    $data['deposit_type'] = $deposit_type;
                    $data['deposit_amount'] = $deposit_amount;
                    $data['agent_email'] = $_SESSION['agent']['user_email'];
                    ##################### MAIL TO ADMIN  ##################################
                    $data['mail_type'] = 'admin';
                    $to = 'faye.b@redtagtravels.com';
                    $subject = 'New Deposit Request - Redtag Travels';
                    $headers = "From: info@redtagtravels.com\r\n";
                    $headers .= "Reply-To: info@redtagtravels.com\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headers.= "X-Priority: 1\r\n";
                    $message = $this->load->view('home/deposit_request_mail', $data, true);
                    mail($to, $subject, $message, $headers);
                    ###############################################################################
                    ##################### MAIL TO USER  ##################################
                    $data['mail_type'] = 'agent';
                    $toUser = trim($data['agent_email']);
                    $subjectUser = 'Deposit Request Confirmation - Redtag Travels';
                    $headersUser = "From: info@redtagtravels.com\r\n";
                    $headersUser .= "Reply-To: info@redtagtravels.com\r\n";
                    $headersUser .= "MIME-Version: 1.0\r\n";
                    $headersUser .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headersUser .= "X-Priority: 1\r\n";
                    $messageUser = $this->load->view('home/deposit_request_mail', $data, true);
                    mail($toUser, $subjectUser, $messageUser, $headersUser);
                    ###############################################################################
                    echo json_encode(array('result' => '0'));
                } else {
                    echo json_encode(array('result' => '1'));
                }
            } else {
                echo json_encode(array('result' => '1'));
            }
        } else {
            echo json_encode(array('result' => '1'));
        }
    }

    public function update_user_profile() {
        $result = 1;
        if (isset($_POST)) {
            $data = $_POST;
            $agent_name = $data['agent_name'];
            $address = $data['address'];
            $city = $data['city'];
            $phone_code = $data['phone_code'];
            $phone_no = $data['phone_no'];
            $company_name = $data['company_name'];
            $zip_code = $data['zip_code'];
            $country = $data['country'];
            if ($agent_name != '' && $phone_code != '' && $phone_no != '' && $company_name != '' && $country != '') {
                if ($_FILES['new_image']['name'] != '') {
                    $filename = $_FILES['new_image']['name'];
                    $tmpFileName = $_FILES['new_image']['tmp_name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $newFileName = date('ymdHis') . '_' . $_SESSION['agent']['user_id'] . '.' . $ext;
                    $target = Image_Path;
                    move_uploaded_file($tmpFileName, $target . $newFileName);
                } else {
                    $newFileName = $data['old_image'];
                }
                $updateUser = $this->Home_Model->updateUserData($_SESSION['agent']['user_id'], $agent_name, $address, $city, $phone_code, $phone_no, $company_name, $zip_code, $country, $newFileName);
                //echo $updateUser.'___';die;
                if ($updateUser !== '' && $updateUser === 0) {
                    $result = 0;
                } else if ($updateUser !== '' && $updateUser > 0) {
                    $result = 0;
                } else {
                    $result = 1;
                }
            } else {
                $result = 1;
            }
        } else {
            $result = 1;
        }

        echo json_encode(array('result' => $result));
    }

    public function update_user_password() {
        if (isset($_POST)) {
            $data = $_POST;
            $err = 0;
            if ($data['old_pass'] == '') {
                $err = 1;
            } else if ($data['new_pass'] == '') {
                $err = 1;
            } else if ($data['conf_pass'] == '') {
                $err = 1;
            } else if ($data['conf_pass'] !== $data['new_pass']) {
                $err = 1;
            } else {
                $updatePass = $this->Home_Model->updateUserPassword($_SESSION['agent']['user_id'], $data);
                if ($updatePass != '' || $updatePass > 0) {
                    ##################### MAIL TO USER  ##################################
                    $data['mail_type'] = 'agent';
                    $data['agent_name'] = $this->agentName;
                    $toUser = trim($_SESSION['agent']['user_email']);
                    $subjectUser = 'Password change detected - Redtag Travels';
                    $headersUser = "From: info@redtagtravels.com\r\n";
                    $headersUser .= "Reply-To: info@redtagtravels.com\r\n";
                    $headersUser .= "MIME-Version: 1.0\r\n";
                    $headersUser .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headersUser .= "X-Priority: 1\r\n";
                    $messageUser = $this->load->view('home/user_password_change_mail', $data, true);
                    mail($toUser, $subjectUser, $messageUser, $headersUser);
                    ###############################################################################
                    echo json_encode(array('result' => '0'));
                } else {
                    echo json_encode(array('result' => '1'));
                }
            }
        } else {
            echo json_encode(array('result' => '1'));
        }
    }

    public function add_subagent_data() {
        $result = 1;
        if (isset($_POST)) {
            $data = $_POST;
            $agent_name = $data['sub_agent_name'];
            $address = $data['sub_agent_address'];
            $city = $data['sub_agent_city'];
            $phone_code = $data['sub_agent_phone_code'];
            $phone_no = $data['sub_agent_phone_no'];
            $company_name = $data['sub_agent_company_name'];
            $zip_code = $data['sub_agent_zip_code'];
            $country = $data['sub_agent_country'];
            $email = $data['sub_email_id'];
            $pass = $data['sub_pass'];
            $conf_pass = $data['sub_conf_pass'];

            if ($agent_name != '' && $phone_code != '' && $phone_no != '' && $company_name != '' && $country != '' && $email != '' && $pass != '' && ($pass == $conf_pass)) {
                if ($_FILES['new_image']['name'] != '') {
                    $filename = $_FILES['new_image']['name'];
                    $tmpFileName = $_FILES['new_image']['tmp_name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $newFileName = date('ymdHis') . '_' . $_SESSION['agent']['user_id'] . '.' . $ext;
                    $target = Image_Path;
                    move_uploaded_file($tmpFileName, $target . $newFileName);
                } else {
                    $newFileName = '';
                }
                $addAgent = $this->Home_Model->addSubAgentData($_SESSION['agent']['user_id'], $agent_name, $address, $city, $phone_code, $phone_no, $company_name, $zip_code, $country, $newFileName, $email, $pass);
                //echo $addAgent;die;
                if ($addAgent['err'] == '0') {
                    $data['user_no'] = $addAgent['user_no'];
                    $data['agent_name'] = $_SESSION['agent']['agentName'];
                    $data['company_name'] = $_SESSION['agent']['companyName'];
                    ##################### MAIL TO AGENT  ##################################
                    $data['mail_type'] = 'agent';
                    $toUser = trim($_SESSION['agent']['user_email']);
                    $subjectUser = 'Sub Agent added successfully - Redtag Travels';
                    $headersUser = "From: info@redtagtravels.com\r\n";
                    $headersUser .= "Reply-To: info@redtagtravels.com\r\n";
                    $headersUser .= "MIME-Version: 1.0\r\n";
                    $headersUser .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headersUser .= "X-Priority: 1\r\n";
                    $messageUser = $this->load->view('home/sub_agent_add_mail', $data, true);
                    mail($toUser, $subjectUser, $messageUser, $headersUser);
                    ###############################################################################
                    ##################### MAIL TO SUB AGENT  ##################################
                    $data['mail_type'] = 'sub_agent';
                    $to = trim($_SESSION['agent']['user_email']);
                    $subject = 'Password change detected - Redtag Travels';
                    $headers = "From: info@redtagtravels.com\r\n";
                    $headers .= "Reply-To: info@redtagtravels.com\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headers .= "X-Priority: 1\r\n";
                    $message = $this->load->view('home/sub_agent_add_mail', $data, true);
                    mail($to, $subject, $message, $headers);
                    ###############################################################################
                    $result = 'Sub Agent successfully added.';
                    $err = 0;
                } else if ($addAgent['err'] == '2') {
                    $result = 'Email id already exists. Please use another email id.';
                    $err = 1;
                } else {
                    $result = 'Sub Agent could not be added. Please try again.';
                    $err = 1;
                }
            } else {
                $result = 'Please enter all the required fields for adding the sub agent.';
                $err = 1;
            }
        } else {
            $result = 'Sub Agent could not be added. Please try again.';
            $err = 1;
        }

        echo json_encode(array('result' => $result, 'err' => $err));
    }

    public function update_flight_markup() {
        $err = 1;
        $data = $_POST;
        if ($data['flight_markup_type'] != '') {
            $updateFlMarkup = $this->Home_Model->updateAgentFlightMarkup($_SESSION['agent']['user_id'], $_SESSION['agent']['user_type'], $data);
            if ($updateFlMarkup['type'] == 'insert' && $updateFlMarkup['id'] > 0) {
                $err = 0;
            } else if ($updateFlMarkup['type'] == 'update' && ($updateFlMarkup['id'] > 0 || $updateFlMarkup['id'] == 0)) {
                $err = 0;
            } else {
                $err = 1;
            }
        } else {
            $err = 1;
        }
        echo json_encode(array('result' => $err));
    }

    public function update_subagent_flight_markup() {
        //print_r($_POST);die;
        $err = 1;
        $data = $_POST;
        $check = $this->Home_Model->checkSubagentOnAgent($_SESSION['agent']['user_id'],$data['sub_id']);
        if($check){
            if ($data['flight_markup_type'] != '') {
                $updateFlMarkup = $this->Home_Model->updateSubAgentFlightMarkup($data,$_SESSION['agent']['user_id']);
                if ($updateFlMarkup['type'] == 'insert' && $updateFlMarkup['id'] > 0) {
                    $err = 0;
                } else if ($updateFlMarkup['type'] == 'update' && ($updateFlMarkup['id'] > 0 || $updateFlMarkup['id'] == 0)) {
                    $err = 0;
                } else {
                    $err = 1;
                }
            } else {
                $err = 1;
            }
        } else {
            $err = 1;
        }
        echo json_encode(array('result' => $err));
    }

    public function update_hotel_markup() {
        $err = 1;
        $markupType = $_POST['hotel_markup_type'];
        $domMarkupAmount = $_POST['domHo_markup_amount'];
        $intlMarkupAmount = $_POST['intlHo_markup_amount'];
        if ($markupType != '' && $domMarkupAmount != '' && $intlMarkupAmount != '') {
            $updateHoMarkup = $this->Home_Model->updateAgentHotelMarkup($_SESSION['agent']['user_id'], $_SESSION['agent']['user_type'], $markupType, $domMarkupAmount, $intlMarkupAmount);
            if ($updateHoMarkup['type'] == 'insert' && $updateHoMarkup['id'] > 0) {
                $err = 0;
            } else if ($updateHoMarkup['type'] == 'update' && ($updateHoMarkup['id'] > 0 || $updateHoMarkup['id'] == 0)) {
                $err = 0;
            } else {
                $err = 1;
            }
        } else {
            $err = 1;
        }
        echo json_encode(array('result' => $err));
    }
    
    public function updateSubAgentHoMarkupDetails(){
        $err = 1;
        $markupType = $_POST['hotel_markup_type'];
        $domMarkupAmount = $_POST['domHo_markup_amount'];
        $intlMarkupAmount = $_POST['intlHo_markup_amount'];
        $check = $this->Home_Model->checkSubagentOnAgent($_SESSION['agent']['user_id'],$_POST['sub_id']);
        if($check){
            if ($markupType != '' && $domMarkupAmount != '' && $intlMarkupAmount != '') {
                $updateHoMarkup = $this->Home_Model->updateSubAgentHotelMarkup($_POST['sub_id'],$_SESSION['agent']['user_id'], $_SESSION['agent']['user_type'], $markupType, $domMarkupAmount, $intlMarkupAmount);
                if ($updateHoMarkup['type'] == 'insert' && $updateHoMarkup['id'] > 0) {
                    $err = 0;
                } else if ($updateHoMarkup['type'] == 'update' && ($updateHoMarkup['id'] > 0 || $updateHoMarkup['id'] == 0)) {
                    $err = 0;
                } else {
                    $err = 1;
                }
            } else {
                $err = 1;
            }
        } else {
            $err = 1;
        }
        echo json_encode(array('result' => $err));
    }

    public function showSubagentDepositWindow($agentId, $subAgentId) {
        $data['agentId'] = $agentId;
        $data['subAgentId'] = $subAgentId;
        $qry = $this->db->query($sql = "select total_balance_amount from b2b_deposit_payment_history where agent_id = '" . $agentId . "'");
        if ($qry->num_rows() > 0) {
            $agentDep = $qry->row();
            $data['agentDepBal'] = $agentDep->total_balance_amount;
        } else {
            $data['agentDepBal'] = 0;
        }
        $view = $this->load->view('home/subagent/subagent_deposit_popup', $data, true);
        echo json_encode(array('view' => $view));
    }

    public function add_sub_agent_deposit() {
        if ($_POST) {
            $subAgentId = $this->input->post('sub_id');
            $agentId = $_SESSION['agent']['user_id'];
            $depositAmount = $this->input->post('deposit_amount');
            if ($depositAmount != '' && $subAgentId != '') {
                $check = $this->Agent_Model->addSubAgentDeposit($agentId, $subAgentId, $depositAmount);
                if ($check['status']) {
                    $data['deposit_amount'] = $depositAmount;
                    $data['sub_details'] = $check['sub_data'];
                    $data['agent_name'] = $_SESSION['agent']['agentName'];
                    $data['company_name'] = $_SESSION['agent']['companyName'];
                    ##################### MAIL TO AGENT  ##################################
                    $data['mail_type'] = 'agent';
                    $toUser = trim($_SESSION['agent']['user_email']);
                    $subjectUser = 'Deposit balance notification for sub agent - Redtag Travels';
                    $headersUser = "From: info@redtagtravels.com\r\n";
                    $headersUser .= "Reply-To: info@redtagtravels.com\r\n";
                    $headersUser .= "MIME-Version: 1.0\r\n";
                    $headersUser .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headersUser .= "X-Priority: 1\r\n";
                    $messageUser = $this->load->view('home/sub_agent_deposit_mail', $data, true);
                    mail($toUser, $subjectUser, $messageUser, $headersUser);
                    ###############################################################################
                    ##################### MAIL TO AGENT  ##################################
                    $data['mail_type'] = 'sub_agent';
                    $to = trim($check['sub_data']['user_email']);
                    $subject = 'Deposit balance notification for your account - Redtag Travels';
                    $headers = "From: info@redtagtravels.com\r\n";
                    $headers .= "Reply-To: info@redtagtravels.com\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headers .= "X-Priority: 1\r\n";
                    $message = $this->load->view('home/sub_agent_deposit_mail', $data, true);
                    mail($to, $subject, $message, $headers);
                    ###############################################################################
                    redirect('home/subagent_deposit/success');
                } else {
                    redirect('home/subagent_deposit/error');
                }
            } else {
                redirect('home/subagent_deposit/error');
            }
        } else {
            redirect('home/subagent_deposit/error');
        }
    }

    public function showSubagentEditWindow($agentId, $subAgentId) {
        $data['agentId'] = $agentId;
        $data['subAgentId'] = $subAgentId;
        $data['country_list'] = $this->Home_Model->getAllCountryList();
        $data['subagent_details'] = $this->Home_Model->getSubAgentDetailsOnId($subAgentId);
        $view = $this->load->view('home/subagent/subagent_edit_popup', $data, true);
        echo json_encode(array('view' => $view));
    }

    public function edit_subagent_data() {
        $result = 1;
        if (isset($_POST)) {
            $data = $_POST;
            $agent_name = $data['sub_agentedit_name'];
            $address = $data['sub_agentedit_address'];
            $city = $data['sub_agentedit_city'];
            $phone_code = $data['sub_agentedit_phone_code'];
            $phone_no = $data['sub_agentedit_phone_no'];
            $company_name = $data['sub_agentedit_company_name'];
            $zip_code = $data['sub_agentedit_zip_code'];
            $country = $data['sub_agentedit_country'];
            $sub_id = $data['sub_id'];

            if ($agent_name != '' && $phone_code != '' && $phone_no != '' && $company_name != '' && $country != '') {
                if ($_FILES['new_image']['name'] != '') {
                    $filename = $_FILES['new_image']['name'];
                    $tmpFileName = $_FILES['new_image']['tmp_name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $newFileName = date('ymdHis') . '_' . $_SESSION['agent']['user_id'] . '.' . $ext;
                    $target = Image_Path;
                    move_uploaded_file($tmpFileName, $target . $newFileName);
                } else {
                    $newFileName = '';
                }
                $addAgent = $this->Home_Model->editSubAgentData($_SESSION['agent']['user_id'], $sub_id, $agent_name, $address, $city, $phone_code, $phone_no, $company_name, $zip_code, $country, $newFileName);
                //echo $addAgent;die;
                if ($addAgent == '0') {
                    $result = 'Sub Agent successfully updated. Updated data will reflect on page refresh.';
                    $err = 0;
                } else if ($addAgent == '2') {
                    $result = 'Sub Agent is not associated to the logged in agent.';
                    $err = 1;
                } else {
                    $result = 'Sub Agent could not be updated. Please try again.';
                    $err = 1;
                }
            } else {
                $result = 'Please enter all the required fields for adding the sub agent.';
                $err = 1;
            }
        } else {
            $result = 'Sub Agent could not be added. Please try again.';
            $err = 1;
        }

        echo json_encode(array('result' => $result, 'err' => $err));
    }

    public function flight_autofill() {
        $input = $_GET['name_startsWith'];
        $result = $this->Home_Model->getFlightAutoFillData($input);
        $data = array();
        foreach ($result as $val) {
            array_push($data, trim($val['airport_city']) . ' , ' . trim($val['airport_country']) . ' , ' . trim($val['airport_code']));
        }
        echo json_encode($data);
    }
    
    public function activity_autofill() {
        $input = $_GET['name_startsWith'];
        $result = $this->Home_Model->getActivityAutoFillData($input);
        $data = array();
        foreach ($result as $val) {
            array_push($data, trim($val['city_name']) . ' , ' . trim($val['country_name']));
        }
        echo json_encode($data);
    }
    
    public function getPreferredAirline(){
        $input = $_GET['name_startsWith'];
        $result = $this->Home_Model->getPreferredAirline($input);
        $data = array();
        foreach ($result as $val) {
            array_push($data, trim($val['airline_name']) . ' , ' . trim($val['airline_code']));
        }
        echo json_encode($data);
    }

    public function hotel_autofill() {
        $input = $_GET['name_startsWith'];
        $result = $this->Home_Model->getHotelAutoFillData($input);
        $data = array();

        if($result['roomsxml'] != ''){
            foreach ($result['roomsxml'] as $val) {
                array_push($data, trim($val['region_name']) . ' , ' . trim($val['country_name']));
            }
        }
        if($result['tacenter'] != ''){
            foreach($result['tacenter'] as $val) {
                    array_push($data, trim($val['city_name']).' , ' .trim($val['country_name']));	
            }
        }
        if($result['rezlive'] != ''){
            foreach($result['rezlive'] as $val) {
                    array_push($data, trim($val['name']).' , ' .trim($val['country_name']));	
            }
        }

        $data = array_unique($data);
        echo json_encode($data);
    }

    public function adult_child_binding($count) {
        $data['room_count'] = $count;
        $this->load->view('adult_child_binding', $data);
    }
    
    public function adult_child_binding_mod($count) {
        $data['room_count'] = $count;
        $this->load->view('adult_child_binding_mod', $data);
    }

    public function child_age_binding($child_count, $room_id) {
        $data['child_count'] = $child_count;
        $data['room_id'] = $room_id;
        $this->load->view('child_age_binding', $data);
    }
    
    public function child_age_binding_mod($child_count, $room_id) {
        $data['child_count'] = $child_count;
        $data['room_id'] = $room_id;
        $this->load->view('child_age_binding_mod', $data);
    }

    public function checkUserLoginData() {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        if (trim($email) != '' && trim($pass) != '') {
            $check = $this->Home_Model->checkUserLoginExist($email, $pass);
            if ($check != '') {
                $_SESSION['user']['logged_in'] = '1';
                $_SESSION['user']['email'] = $check->user_email;
                $_SESSION['user']['user_id'] = $check->user_id;
                $_SESSION['user']['user_type'] = 3;
                echo json_encode(
                        array(
                            'logged_in' => '1'
                        )
                );
            } else {
                echo json_encode(
                        array(
                            'logged_in' => '0'
                        )
                );
            }
        } else {
            echo json_encode(
                    array(
                        'logged_in' => '0'
                    )
            );
        }
    }

    public function forgot_password() {
        $email = $_POST['email'];
        if (trim($email) != '') {
            $data['email'] = $email;
            $data['check'] = $this->Home_Model->checkEmailExistForgotPassword($email);
            if ($data['check']['pass'] != '') {
                ##################### MAIL TO USER  ##################################
                $to = trim($email);
                $subject = 'Passoerd recovery - Redtag Travels';
                $headers = "From: info@redtagtravels.com\r\n";
                $headers .= "Reply-To: info@redtagtravels.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers.= "X-Priority: 1\r\n";

                $message = $this->load->view('home/forgotpass_mail', $data, true);
                mail($to, $subject, $message, $headers);
                ###############################################################################
                echo json_encode(
                        array(
                            'logged_in' => '1'
                        )
                );
            } else {
                echo json_encode(
                        array(
                            'logged_in' => '0'
                        )
                );
            }
        } else {
            echo json_encode(
                    array(
                        'logged_in' => '0'
                    )
            );
        }
    }

    public function logout() {
        unset($_SESSION['agent']);
        session_destroy();
        redirect('home/login');
    }

    public function searchengine() {
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $data['nationality'] = $this->Home_Model->getNationalityList();
            $this->load->view('home/searchengine',$data);
        } else {
            redirect('home/dashboard');
        }
    }
    
    public function mybookings(){
        if (isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') {
            $data['fl_booking_data'] = $this->Home_Model->getFlightBookingsOnId($_SESSION['agent']['user_id'],$_SESSION['agent']['user_type']);
            $data['ho_booking_data'] = $this->Home_Model->getHotelBookingsOnId($_SESSION['agent']['user_id'],$_SESSION['agent']['user_type']);
            $this->load->view('home/user/my_bookings', $data);
        } else {
            redirect('home');
        }
    }
    
    ####################### Static Pages ###############################
    public function services(){
        $this->load->view('home/static/services');
    }
    public function aboutus(){
        $this->load->view('home/static/aboutus');
    }
    public function contactus(){
        $this->load->view('home/static/contactus');
    }
    
    public function testimonials(){
        $this->load->view('home/static/testimonials');
    }
    
    public function pricing(){
        $this->load->view('home/static/pricing');
    }
    
    public function training(){
        $this->load->view('home/static/training');
    }
    
    public function events(){
        $this->load->view('home/static/events');
    }
    
    public function blog(){
        $this->load->view('home/static/blog');
    }
    
    public function terms(){
        $this->load->view('home/static/terms');
    }
    
    public function privacy(){
        $this->load->view('home/static/privacy');
    }
    
    public function cancellation(){
        $this->load->view('home/static/cancellation');
    }
    
    public function send_contact(){
        if($_POST){
            $data = $_POST;
            
            if($data['name'] != '' && $data['email'] != '' && $data['phone'] != '' && $data['subject'] != '' && $data['msg'] != ''){
            $to = 'info@redtagtravels.com';
            $subject = 'Query From Redtag Agent Portal';
            $headers = "From: 'Redtag Agent<".trim($data['email']).">'\r\n";
            $headers .= "Reply-To: noreply@redtagtravels.com\r\n";
            $headers .= "CC: pm.ajtravellabs@gmail.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $headers .= "X-Priority: 1\r\n"; 
            $headers .= "\r\n";
            $message = '<table style="width:700px;">
                        <tr>
                            <td colspan="3">Hello, Redtag Travels</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">New enquiry has been made on our website. Below are the details of the enquiry done :</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Name</td><td>:</td><td>'.$data['name'].'</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Email Id</td><td>:</td><td>'.$data['email'].'</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="width:100px;">Contact No.</td><td>:</td><td>'.$data['phone'].'</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Subject</td><td>:</td><td>'.$data['subject'].'</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Message</td><td>:</td><td>'.$data['msg'].'</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        
                       </table>';
                    mail($to, $subject, $message, $headers);
                    echo json_encode(array('err'=>1));
                } else {
                    echo json_encode(array('err'=>0));
                }
            }
    }
    ####################################################################

}
