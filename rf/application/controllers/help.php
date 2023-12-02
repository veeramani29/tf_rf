<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Help extends CI_Controller {
	
    public $cobmine_array;
    public $popularKeyword;
    public $helpMenuLink;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_Model');
        $this->load->model('Help_Model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);

        $this->popularKeyword = $this->getPopularSearchKeyword();
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
        
    }

	public function index(){
        $masterMenu = $this->Help_Model->getAllMenu();
        $menuArray = array();
        foreach($masterMenu as $menu) {
            $subMenu_array = $this->Help_Model->getSubMenu($menu->menu_id);    
            $masterCreate[] = array('menu_id'=>$menu->menu_id, 'menu_option'=>$menu->menu_option, 'submenu_exist'=>$menu->submenu_exist);
            
            for ($i=0; $i < count($subMenu_array); $i++) { 
                $subCreate[] = $subMenu_array[$i];
            }
            
            if(empty($subCreate)) {
                $subCreate = array();
            }

            $this->combine_array = array('master'=>$masterCreate, 'sub'=>$subCreate);
        }
        
        if(empty($this->combine_array)) {
            $this->combine_array = array();
        }    

        $returnData['combine_array'] = $this->combine_array; 
        // $this->load->view('how', $returnData);
       // echo 'dslkj';die;

        $this->load->view('help/how', $returnData);
    }

    public function menuCreate($returnMenuArray=null){
        $masterMenu = $this->Help_Model->getAllMenu();
        $menuArray = array();
        foreach($masterMenu as $menu) {
            $subMenu_array = $this->Help_Model->getSubMenu($menu->menu_id);    

            $masterCreate[] = array('menu_id'=>$menu->menu_id, 'menu_option'=>$menu->menu_option, 'submenu_exist'=>$menu->submenu_exist);
            
            for ($i=0; $i < count($subMenu_array); $i++) { 
                $subCreate[] = $subMenu_array[$i];
            }
            
            if(empty($subCreate)) {
                $subCreate = array();
            }

            $this->combine_array = array('master'=>$masterCreate, 'sub'=>$subCreate);
        }
        
        if(empty($this->combine_array)) {
            $this->combine_array = array();
        }    

        $returnData['combine_array'] = $this->combine_array; 

        if($returnMenuArray == 1) {
            //do nothing
        } else {
            $this->load->view('how', $returnData);      
        }
        
    }

/*
* Loads the help article..
*/
    public function article($menuMasterId=null, $subMenuId=null, $ajaxRequest=null){
        $this->menuCreate(1);
        $data['combine_array'] = $this->combine_array;
        $data['contentObject'] = $this->Help_Model->fetchContent($menuMasterId, $subMenuId);  

        if($subMenuId == 0) {
            $contentTitle = $this->Help_Model->fetchContentTitle($menuMasterId, $subMenuId); 
            if(isset($contentTitle[0]->menu_option)) {
                $data['contentTitle'] = $contentTitle[0]->menu_option;
            }  
        } else {
            $contentTitle = $this->Help_Model->fetchContentTitle($menuMasterId, $subMenuId); 
            if(!empty($contentTitle)) {
                $data['contentTitle'] =  $contentTitle[0]->sub_menu_title;
            }
        }
    
        if($ajaxRequest == 1) { 
            echo json_encode($data);
        } else {
            $data['contentObject'] = $this->Help_Model->fetchContent($menuMasterId, $subMenuId);
            $this->load->view('help/help_content', $data);
        }
    }

    /*
*@Vikas Arora, vikasprovab@gmail.com
*/
    public function checkUserReview($menu_id=NULL, $submenu_id=NULL, $cont_id=NULL, $user_ip=NULL) {
        if($this->Help_Model->checkUserReview($menu_id, $submenu_id, $cont_id, $user_ip)) {
            return true;
        } else {
            return false;
        }
    }

    /*Add feedback to db*/
    public function addFeedback() {
        $menu_id=$this->input->post('menu_id'); 
        $submenu_id=$this->input->post('submenu_id');
        $cont_id=$this->input->post('cont_id');
        $feedback=$this->input->post('feedback');


        $user_ip = $this->input->ip_address();
        if($cont_id == 0) {
            $cont_id = 0;
        }
        $data = array('menu_id'=>$menu_id,'submenu_id'=>$submenu_id,'cont_id'=>$cont_id,'feedback'=>$feedback,'user_ip'=>$user_ip);

        if($this->checkUserReview($menu_id,$submenu_id,$cont_id, $user_ip)) {
            if($this->Help_Model->addFeedback($data)) {
                echo json_encode(1);
            }    
        } 
        
    }

    public function articlelink($menuMasterId=null, $subMenuId=null, $cont_id=null, $ajaxRequest=null) 
    {
        $this->menuCreate(1);
        $data['combine_array'] = $this->combine_array;
        $data['contentObject'] = $contentObject = $this->Help_Model->fetchLinkContent($menuMasterId, $subMenuId, $cont_id);  
        //echo '<pre>';print_r($contentObject);
        
       
        if($ajaxRequest == 1) { 
            echo json_encode($data);
        } else {
            //echo '<pre>';print_r($contentObject);
            $this->load->view('help/help_content_link', $data);
        }
    }

    /*Search module for help center starts here
**@author: Vikas Arora
**@Notes: Doing Full text search on the crs content table
*/

    public function search($ajaxRequest = null) {
        $this->menuCreate(1);
        $data['combine_array'] = $this->combine_array;
        $searchString = $this->input->get('q');
        if(strlen(trim($searchString)) <= 0) {
            redirect("help/");
        }
        $searchResult = $this->Help_Model->searchHelpArticle($searchString);
        $data['searchResult'] = $searchResult['searchResult'];
        $searchCount = $this->Help_Model->searchHelpArticle($searchString);
        $data['searchCount'] = $searchCount['searchCount'];
        
        // $this->Help_Model->updatePopularSearchCounter()

        if(isset($ajaxRequest) && !empty($ajaxRequest) && $ajaxRequest == 1 ) {
            echo json_encode($data);
        }
        else {
            $this->load->view('help/help_center_search', $data);
        }
    }

    public function get_quick_results($searchString)
    {
        $searchResult = $this->Help_Model->get_quick_results($searchString);
        $data['searchResult'] = $searchResult['searchResult'];
        
        $data['quickLink'] = array();
        foreach($data['searchResult'] as $search_key) {
            if($search_key->content_type == 3) {
                array_push($data['quickLink'], $search_key->hedding);
            } else {
                array_push($data['quickLink'], $search_key->con_title);
            }
        }
        echo json_encode($data);
    }

    public function getPopularSearchKeyword() 
    {
        return $this->Help_Model->getPopularSearchKeyword();
    }
}

?>