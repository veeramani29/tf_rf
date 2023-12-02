<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listings extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        $this->load->model('Listings_Model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
        
        $b2c_id = $this->session->userdata('b2c_id');
        $b2b_id = $this->session->userdata('b2b_id');
        
        if(!empty($b2c_id)){
			$resposne = $this->Listings_Model->check_b2c_onwer_creation();
			if($resposne->property_owner_created == 0){
				redirect(WEB_URL.'/dashboard/listing');
		    }
		}
        elseif(!empty($b2b_id)){
            $resposne = $this->Listings_Model->check_b2b_onwer_creation();

            if($resposne->property_owner_created == 0){
                redirect(WEB_URL.'/dashboard/listing');
            }
        }
		else
		{
			redirect(WEB_URL.'/users/listings_login');
		}
		
        $this->load->model('Help_Model');
		$this->load->model('account_model');
		$this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
    }

	public function add_new_listings(){
		$data['property_types'] = $this->Listings_Model->get_property_types();
		$this->load->view('listings/add_new_listings',$data);
	}
	
	public function insert_new_listings(){
		$list_id = $this->Listings_Model->insert_new_listings($_POST);		
		redirect('listings/edit_listings/'.$list_id.'/1');
	}
	
	function edit_listings($list_id, $first_v = ''){
		if(empty($list_id)){
			redirect('listings/add_new_listings');
		}
		
		$data['listings'] = $this->Listings_Model->get_property_listings($list_id);		
		if(empty($data['listings'])){
			redirect('listings/add_new_listings');
		}
		
		$data['listings_models_general_status'] = $this->Listings_Model->get_property_listings_models($list_id,'listings_general');
		$data['listings_models_photos_status'] = $this->Listings_Model->get_property_listings_models($list_id,'listings_photos');
		$data['listings_models_rent_calculations_status'] = $this->Listings_Model->get_property_listings_models($list_id,'listings_rent_calculations');
		$data['listings_models_location_status'] = $this->Listings_Model->get_property_listings_models($list_id,'listings_pinmap');		
		
		$data['property_types'] = $this->Listings_Model->get_property_types();		
		$data['time_slot'] = $this->Listings_Model->time_slot();		
		$data['currency'] = $this->Listings_Model->get_currency();
		$data['countries'] = $this->Listings_Model->get_countries();
		$data['first_vis_status'] = $first_v;
		
		$data['special_discounts'] = $this->Listings_Model->get_property_special_discounts($list_id);	
		$data['lastminute_discounts'] = $this->Listings_Model->get_property_lastminute_discounts($list_id);
		$data['fees_types'] = $this->Listings_Model->get_fees_types();
		$data['property_fees_types'] = $this->Listings_Model->property_fees_types($list_id);	
		$data['property_pricing_info'] = $this->Listings_Model->get_property_pricing_by_id($list_id);		
		$data['property_bed_types'] = $this->Listings_Model->kigo_properties_pdtp();		
		$amenties = $this->Listings_Model->get_amenities();

        $arraychunk = array();
        foreach ($amenties as $key => $value) {
            $arraychunk[$value->AMENITY_CATEGORY_LABEL][] = $value;
        }
        $data['amenties'] = $arraychunk;
        

        $activites = $this->Listings_Model->get_activities();

        $arraychunk = array();
        foreach ($activites as $key => $value) {
            $arraychunk[$value->ACTIVITY_CATEGORY_LABEL][] = $value;
        }
        $data['activities'] = $arraychunk;
        
        
        $data['property_udpa'] = $this->Listings_Model->get_property_udpa();
        $property_udpa_values = $this->Listings_Model->property_udpa_values($list_id);
        
        $data['property_photos'] = $this->Listings_Model->get_property_photos($list_id);        
        $data['map_lat_long'] = $this->Listings_Model->getStaticMap($data['listings']->PROP_LATITUDE,$data['listings']->PROP_LONGITUDE);
        
        $property_udpa_custom_values = array();
        
        if(!empty($property_udpa_values)){
        foreach($property_udpa_values as $key => $value){
			$property_udpa_custom_values[$value->UDPA_ID] = $value->UDPA_TEXT;
		}
		}
	
		$data['property_udpa_custom_values'] = $property_udpa_custom_values;

		$data['cancellation_types'] = $this->Listings_Model->get_cancellation_types();
		
		$comp_cnt = $this->Listings_Model->get_completed_status($list_id);
		if(empty($comp_cnt)){
			$data['completed_status'] = 0;	
		}
		else{
			
			$data['completed_status'] = count($comp_cnt);
		}
		
		//echo '<pre/>';
		//print_r($data);exit;
		$this->load->view('listings/edit_listings',$data);	
	}	
	
	public function get_map_static_image(){	
		$lat = $this->input->post('latitude');
		$long = $this->input->post('longitude');
		$edit_listings_pinmap = $this->input->post('edit_listings_pinmap');		

		$map_lat_long = $this->Listings_Model->getStaticMap($lat,$long);
		$get_map_static_image = $this->Listings_Model->get_map_static_image($edit_listings_pinmap);			

		/*$this->db->select('completed_status');
		
		$this->db->from('property_listings_model');
		$this->db->where('listings_id',$edit_listings_pinmap);
		$this->db->where('model_name','listings_pinmap');	

		//$query = $this->db->last_query();		
		$query = $this->db->get();
		$result = $query->row();		
		$previous_completed_status = $result->completed_status;

		$this->db->select('completed_status');
		$this->db->from('property_listings_model');
		$this->db->where('listings_id',$edit_listings_pinmap);
		$this->db->where('completed_status',1);

		$query = $this->db->get();
		$previous_status = $query->row();

		$this->db->where('listings_id',$edit_listings_pinmap);
		$this->db->where('model_name','listings_general');
		$this->db->update('property_listings_model',array('completed_status' => 1));*/

		//print_r(array( 'map_lat_long' => $map_lat_long, 'status' => 1, 'property_list_id' => $edit_listings_pinmap ,'previous_completed_status' => $get_map_static_image['previous_completed_status'], 'count_result' => $get_map_static_image['count_result']));die;	
		echo json_encode(array( 'map_lat_long' => $map_lat_long, 'status' => 1, 'property_list_id' => $edit_listings_pinmap ,'previous_completed_status' => $get_map_static_image['previous_completed_status'], 'count_result' => $get_map_static_image['count_result']));
		//echo json_encode(array( 'edit_listings_pinmap' => $map_lat_long, 'status' => 1, 'property_list_id' => $edit_listings_pinmap ,'previous_completed_status' => 0, 'count_result' => 4));
	}
	
	public function get_lmd() {
        $value = $this->input->post('value');
		$uniqid = uniqid();
		
        $sHtml  = '<div id="lmd_' . $value . '" style="clear: both;float: left;padding-top: 20px;" class="lmd_disc" data-id="'.$uniqid.'">';
        $sHtml .= '<p style="float: left;font-size: 14px;padding-right: 11px;">If reservation created</p>';
        $sHtml .= '<select required="required" name="lastminute_discounts_days[]" class="select2 form-control lastminute_discounts_days_'.$uniqid.'" style="float: left;margin-right: 10px;margin-top: -7px;width: 65px;">';

        for ($i = 1; $i <= 99; $i++) {
            $sHtml .= '<option value="' . $i . '">' . $i . '</option>';
        }

        $sHtml .= '</select>';
        $sHtml .= '<p style="float: left;font-size: 14px;padding-right: 11px;">days or more before check-in</p>';
        $sHtml .= '<input class="form-control lastminute_discounts_'.$uniqid.'" type="text" required="required" style="float: left;margin-right: 10px;margin-top: -7px;width: 55px;" name="lastminute_discounts[]" placeholder="Discount in %">';
        $sHtml .= '<p style="float: left;font-size: 14px;padding-right: 11px;">% Discount</p>';
        $sHtml .= '<a class="btn btn-danger btn-xs has-tooltip" data-placement="top" title="Delete Discount" onclick="delete_lmd(' . $value . ')" href="javascript:void(0)"><i class="icon-remove"></i></a>';
        $sHtml .= '<div style="clear: both;"></div>';

        echo json_encode(array('result' => $sHtml));
        exit;
    }
    
    function get_spd() {
        $value = $this->input->post('value');
		$uniqid = uniqid();
		                   
        $sHtml  =  '<div id="spd_' . $value . '" style="padding-top: 45px; padding-left: 38px;" class="spd_prop" data-id="'.$uniqid.'">';
        $sHtml .=  '<label class="control-label" style="float: left; padding-right: 6px; font-weight: normal; clear: both; padding-top: 6px; width: 15%;">Check-in</label><div class="datepicker-input input-group" style="float: left; padding-right: 6px; width: 15%;"><input class="form-control datepicker mySelectCalenda calinput" name="psd_checkin[]" data-format="YYYY-MM-DD" placeholder="Check-in" style="width: 155px;" type="text" required="required" id="check_in_'.$uniqid.'"></div><label class="control-label" style="float: left; padding-right: 6px; padding-top: 6px; width: 15%; font-weight: normal;">Check-out</label><div class="datepicker-input input-group" style="float: left; padding-right: 6px; width: 15%;"><input class="datepicker mySelectCalenda calinput form-control"  name="psd_checkout[]" data-format="YYYY-MM-DD" placeholder="Check-out" style="width: 155px;" type="text" required="required" id="check_out_'.$uniqid.'"></div><label class="control-label" style="float: left; padding-right: 6px; clear: both; font-weight: normal; width: 15%; margin-top: 20px;">Valid From</label><div class="datepicker-input input-group" style="float: left; padding-right: 6px; width: 15%; margin-top: 14px;"><input name="psd_validfrom[]" class="datepicker mySelectCalenda calinput form-control" data-format="YYYY-MM-DD" placeholder="Valid from" style="width: 155px;" type="text" required="required" id="valid_from_'.$uniqid.'"></div><label class="control-label" style="float: left; padding-right: 11px; padding-top: 6px; width: 15%; font-weight: normal; margin-top: 18px;">Valid To</label><div class="datepicker-input input-group" style="float: left; padding-right: 6px; margin-top: 15px;"><input name="psd_validto[]" class="datepicker mySelectCalenda calinput form-control" data-format="YYYY-MM-DD" placeholder="Valid To" style="width: 155px;" type="text" required="required" id="valid_to_'.$uniqid.'"></div><label class="control-label" style="float: left; padding-right: 39px; clear: both; font-weight: normal; width: 15%; padding-top: 10px;">Name</label><div class="input-group" style="float: left; padding-right: 6px; margin-top: 10px;"><input name="psd_discount_name[]" class="form-control"  placeholder="Discount Name" style="width: 155px;" type="text" required="required" id="discount_name_'.$uniqid.'"></div><label class="control-label" style="float: left; padding-right: 1px; padding-top: 6px; font-weight: normal; width: 15%; margin-top: 15px;">Discount %</label><div class="input-group" style="float: left; padding-right: 6px; margin-top: 15px;"><input name="psd_discount_per[]" class="form-control" required="required" placeholder="Discount %" style="width: 155px;" type="text" required="required" id="discount_per_'.$uniqid.'"></div><a style="" class="btn btn-danger btn-xs has-tooltip" data-placement="top" title="Delete Discount" onclick="delete_spd(' . $value . ')" href="javascript:void(0)"><i class="icon-remove"></i></a><div style="clear: both; padding-bottom: 20px;"></div>';
        $sHtml .=  '</div>';

        echo json_encode(array('result' => $sHtml));
        exit;
    }
    
    function updateCompletedStatus(){
            $completed_status = $this->Listings_Model->get_property_listings_completed_modules($_REQUEST['prop_id']);   
	
            $completed_status_count = 4;
            
            if(!empty($completed_status))
            {
                foreach($completed_status as $skey => $svalue){
                    if($svalue->completed_status == 1){
                        $completed_status_count--; 
                    }
                }
            }

            echo json_encode(array('status' => 1, 'result' => $completed_status_count));            
        }

    function update_listing_property_step1(){
		$data = $_POST;
		$previous_status = $this->Listings_Model->update_listing_property_step1($data);
		//print_r($previous_status);die;
		echo json_encode(array('status' => 1, 'property_list_id' => $data['list_id'], 'previous_completed_status' => $previous_status['previous_completed_status'], 'count_result' => $previous_status['count_result']));
	}
	
	function update_listing_property_step2(){
		$data = $_POST;
		$this->Listings_Model->update_listing_property_step2($data);
		echo json_encode(array('status' => 1));
	}
	
	function update_listing_property_step3(){
		$data = $_POST;
		$previous_status = $this->Listings_Model->update_listing_property_step3($data);						
		echo json_encode(array('status' => 1, 'property_list_id' => $data['property_id'],'previous_completed_status' => $previous_status['previous_completed_status'], 'count_result' => $previous_status['count_result']));
	}
	
	function update_listing_property_step4(){	
		$data = $_POST;
		$this->Listings_Model->update_listing_property_step4($data);
		echo json_encode(array('status' => 1));
	}
	
	function update_listing_property_step5(){
		$data = $_POST;
		$this->Listings_Model->update_listing_property_step5($data);
		echo json_encode(array('status' => 1));
	}
	
	function update_listing_property_step6(){
		$data = $_POST;	
		parse_str($data['all_items'],$output);

		array_merge($data,$output);
		$previous_status =  $this->Listings_Model->update_listing_property_step6($output);
		echo json_encode(array('status' => 1, 'property_list_id' => $data['edit_listings_discounts'] ,'previous_completed_status' => $previous_status['previous_completed_status'], 'count_result' => $previous_status['count_result']));
	}
	
	function update_listing_property_step7(){
		$data = $_POST;
		$this->Listings_Model->update_listing_property_step7($data);
		echo json_encode(array('status' => 1));
	}
	
	function update_listing_property_step8(){	
		$data = $_POST;
		$previous_status = $this->Listings_Model->update_listing_property_step8($data);				
		//print_r($previous_status);die;
		echo json_encode(array('status' => 1, 'property_list_id' => $data['edit_listings_pinmap'] ,'previous_completed_status' => $previous_status['previous_completed_status'], 'count_result' => $previous_status['count_result']));
	}
	
	public function upload_property_photo() {
        $ext = end(explode('/', $_FILES["profilePhoto"]["type"]));
        $tmp_name = $_FILES["profilePhoto"]["tmp_name"];
        $unique_id = uniqid();
        $name = $unique_id . '.' . $ext;
        $uploads_dir = "";
        
        move_uploaded_file($tmp_name, APP_BASE_PATH . '/assets/apartment/' . $name);
        $image_link = base_url() . 'assets/apartment/' . $name;
        $base64_image = base64_encode(file_get_contents($image_link));

        $sHtml = '<div id="'.$unique_id.'" class="col-md-4 property_photos_search">
                	<div class="photolist">
                    	<div class="uplodproto">
                        	<img src="data:image/png;base64,'.$base64_image.'">
                            <input type="hidden" id="image_'.$unique_id.'" name="image['.$unique_id.'][]" value="'.$base64_image.'">
                        </div>
                        <div class="photoallcnt">
                        <div class="tichek">
                        	<label class="pikphotoli">
                            	<div class="left">
                            	<div class="icheckbox_flat-blue" style="position: relative;"><input type="checkbox" id="panaromic_'.$unique_id.'" name="panaromic_view['.$unique_id.'][]" class="icheckbox_flat-blue" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;"></ins></div>
                                </div>
                                <span class="chkboxphoto">Panoramic view</span>
                            </label>
                        </div>
                        
                        <div class="rowuplist">
                        	<label class="pikphotoli">Name</label>
                            <input type="text" name="name['.$unique_id.'][]" placeholder="Name" class="form-control inputphoto" id="image_name_'.$unique_id.'">
                        </div>
                        
                        <div class="rowuplist">
                        	<label class="pikphotoli">Comment</label>
                            <textarea id="image_comment_'.$unique_id.'" name="comment['.$unique_id.'][]" placeholder="Comment" class="form-control txtaraphoto"></textarea>
                        </div>
                        </div>
						<a class="removephoto" data-placement="top" title="Delete Photo" onclick="delete_photo(\'' . $unique_id . '\')" href="javascript:void(0)">
							<i class="icon-remove"></i>
						</a>   
					</div>
				</div>';

        //$sHtml =  '<div style="padding-top: 20px;clear:both;" id="' . $unique_id . '" class="property_photos_search">';
        //$sHtml .= '<div style="border: 1px solid #ccc;padding: 20px;min-height: 180px;" class="col-sm-3"><img src="' . $image_link . '"  width="200" height="100" style="clear: both;float: left;"/><input id="image_' . $unique_id . '" type="hidden" name="image[' . $unique_id . '][]"  value="' . $base64_image . '"/><input id="panaromic_' . $unique_id . '"  type="checkbox" name="panaromic_view[' . $unique_id . '][]" style="clear: both;float: left;"/><label class="control-label" style="float: left; padding-left: 6px;">Panoramic view</label></div>';
        //$sHtml .= '<div style="border: 1px solid #ccc;padding: 20px 20px;min-height: 180px;margin-left:20px;" class="col-sm-4"><label class="control-label" style="float: left; padding-left: 6px;">Name</label><input type="text" required="required" name="name[' . $unique_id . '][]" placeholder="Name" class="form-control" id="image_name_' . $unique_id . '"/></div>';
        //$sHtml .= '<div style="border: 1px solid #ccc;padding: 20px 20px;min-height: 180px;margin-left:20px;" class="col-sm-4"><label class="control-label" style="float: left; padding-left: 6px;">Comment</label><textarea id="image_comment_' . $unique_id . '" name="comment[' . $unique_id . '][]" placeholder="Comment" id="validation_comment" class="form-control" style="margin-top: 10px;"></textarea></div>';
        //$sHtml .= '<a class="btn btn-danger btn-xs has-tooltip" data-placement="top" title="Delete Photo" onclick="delete_photo(\'' . $unique_id . '\')" href="javascript:void(0)"><i class="icon-remove"></i></a>';
        //$sHtml .= '</div>';
        
        echo json_encode(array('result'  => $sHtml));
        exit;
    }
    
    function get_property_perguest() {
        $perguest_type = $this->input->post('perguest_type');
        $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        if (empty($perguest_standard_occupancy)) {
            $perguest_standard_occupancy = 1;
        }
        $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        if (empty($perguest_max_occupancy)) {
            $perguest_max_occupancy = $perguest_max_occupancy + 1;
        }
        $perguest_type_options = array('ADULTS' => 'Adults', 'ADULTS_CHILDREN' => 'Adults + Children', 'ADULTS_CHILDREN_BABIES' => 'Adults + Children + Babies');

        $sHmtl = '<div class="modlxet">';
        $sHmtl .= '<h3>Per Guest Charge Settings</h3><div class="clear"></div>';
        $sHmtl .= '<label class="control-label">Applies to</label>';
        $sHmtl .= '<select name="perguest_sel_type" id="perguest_sel_type" class="select2 form-control">';
        foreach ($perguest_type_options as $key => $value) {
            if ($key == $perguest_type) {
                $selected = "selected=selected";
            } else {
                $selected = "";
            }
            $sHmtl .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
        }
        $sHmtl .= '</select><div class="clear"></div>';

        $sHmtl .= '<label class="control-label" >Standard occupancy</label>';
        $sHmtl .= '<select onclick="change_max_occupancy(this.value)" name="perguest_sel_standard_occupancy" class="select2 form-control" id="perguest_sel_standard_occupancy">';
        for ($i = 1; $i <= 29; $i++) {
            if ($perguest_standard_occupancy == $i) {
                $selected = "selected=selected";
            } else {
                $selected = "";
            }
            $sHmtl .= '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
        }
        $sHmtl .= '</select><div class="clear"></div>';

        $sHmtl .= '<label class="control-label">Max. occupancy</label>';
        $sHmtl .= '<div id="max_occu_dyn">';
        $sHmtl .= '<select name="perguest_sel_max_occupancy" id="perguest_sel_max_occupancy" class="select2 form-control">';
        for ($i = $perguest_standard_occupancy + 1; $i <= 30; $i++) {
            if ($perguest_max_occupancy == $i) {
                $selected = "selected=selected";
            } else {
                $selected = "";
            }
            $sHmtl .= '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
        }
        $sHmtl .= '</select></div><div class="clear"></div>';
        $sHmtl .= '<button onclick="change_property_pgc()" type="button" class="btn btn-primary"><i class="icon-save"></i>Save</button>';
        $sHmtl .= '</div>';

        echo json_encode(array('result' => $sHmtl));
        exit;
    }
    
    function get_changed_property_now_epc($period_range_count = '', $enable_now = '', $perguest_standard_occupancy = '', $perguest_max_occupancy = '', $enable_pgc = '', $period_range_json_value = '', $period_total_count = '', $period_id_value = '') {
        $return = 0;
        if ($period_range_count !== "") {
            $return = 1;
        }

        if ($period_range_count === "") {
            $period_range_count = $this->input->post('period_range_count');
        }

        if ($enable_now === "") {
            $enable_now = $this->input->post('enable_now');
        }

        if ($perguest_standard_occupancy === "") {
            $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        }

        if ($perguest_max_occupancy === "") {
            $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        }

        if ($enable_pgc === "") {
            $enable_pgc = $this->input->post('enable_pgc');
        }

        if ($period_range_json_value === "") {
            $period_range_json_value = $this->input->post('period_range_json_value');
        }

        if ($period_total_count === "") {
            $period_total_count = (int) trim(stripslashes($this->input->post('period_total_count')));
        }

        $temp_new = array();
        if (isset($period_range_json_value['NIGHT']) && !empty($period_range_json_value['NIGHT'])) {
            foreach ($period_range_json_value['NIGHT'] as $key => $value) {
                $temp_new[] = $key . '-N';
            }
        }

        if (isset($period_range_json_value['MONTH']) && !empty($period_range_json_value['MONTH'])) {
            foreach ($period_range_json_value['MONTH'] as $key => $value) {
                $temp_new[] = $key . '-M';
            }
        }

        if (isset($period_range_json_value['YEAR']) && !empty($period_range_json_value['YEAR'])) {
            foreach ($period_range_json_value['YEAR'] as $key => $value) {
                $temp_new[] = $key . '-Y';
            }
        }

        if ($enable_now == 1) {
            if ($enable_pgc == 1) {
                $sHtml = array();
                $uniqid = uniqid();
                for ($kk = 0; $kk <= $period_total_count; $kk++) {
                    $ttt = $kk + 1;
                    $week_days = array('1' => 'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thur', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun');
                    $sHtml1 = "";
                    $sHtml1 .= '<tr class="night_after_append">';
                    $sHtml1 .= '<td>';
                    foreach ($week_days as $wk => $wv) {
                        if (!empty($period_id_value)) {
                            $sHtml1 .= '<input type="checkbox" data-id="' . $uniqid . '" value="' . $wk . '" class="kon_' . $period_id_value . '_1" onclick="change_now_selction(' . $period_id_value . ',1,' . $wk . ',this);" />' . $wv;
                        } else {
                            $sHtml1 .= '<input type="checkbox" data-id="' . $uniqid . '" value="' . $wk . '" class="kon_' . $kk . '_1"  onclick="change_now_selction(' . $kk . ',1,' . $wk . ',this);"  />' . $wv;
                        }
                    }
                    $sHtml1 .= '</td>';
                    $sHtml1 .= '<td></td>';
                    for ($j = 0; $j < $period_range_count; $j++) {
                        $sHtml1 .= '<td></td>';
                    }
                    $sHtml1 .= '</tr>';


                    for ($i = $perguest_standard_occupancy; $i <= $perguest_max_occupancy; $i++) {
                        $sHtml1 .= '<tr class="dyna_night_pricing">';
                        $sHtml1 .= '<td></td>';
                        if ($i == $perguest_standard_occupancy) {
                            $sHtml1 .= '<td>' . $i . ' and less than ' . $i . ' guests</td>';
                        } elseif ($i == $perguest_max_occupancy) {
                            $sHtml1 .= '<td>' . $i . ' + guests</td>';
                        } else {
                            $sHtml1 .= '<td>' . $i . '</td>';
                        }

                        for ($j = 0; $j < count($temp_new); $j++) {
                            $temp = explode('-', $temp_new[$j]);
                            if ($temp[1] == 'N') {
                                $placeholder = "NIGHT";
                            } elseif ($temp[1] == 'M') {
                                $placeholder = "MONTH";
                            } elseif ($temp[1] == 'Y') {
                                $placeholder = "YEAR";
                            }

                            if (!empty($period_id_value)) {
                                $sHtml1 .= '<td><input type="text" required="required" class="form-control nightly_amount_' . $period_id_value . '_1" number="true" name="nightly_amount[' . $period_id_value . '][1,2,3,4,5,6,7][' . $i . '][' . $temp[0] . '][' . $placeholder . ']"></td>';
                            } else {
                                $sHtml1 .= '<td><input type="text" required="required" class="form-control nightly_amount_' . $kk . '_1" number="true" name="nightly_amount[' . $kk . '][1,2,3,4,5,6,7][' . $i . '][' . $temp[0] . '][' . $placeholder . ']"></td>';
                            }
                        }
                        $sHtml1 .= '</tr>';
                    }
                    $sHtml[] = $sHtml1;
                }
            } else {
                $sHtml = array();
                $uniqid = uniqid();
                for ($kk = 0; $kk <= $period_total_count; $kk++) {
                    $ttt = $kk + 1;
                    $week_days = array('1' => 'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thur', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun');
                    $sHtml1 = "";
                    $sHtml1 .= '<tr class="night_after_append">';
                    $sHtml1 .= '<td>';
                    foreach ($week_days as $wk => $wv) {
                        if (!empty($period_id_value)) {
                            $sHtml1 .= '<input type="checkbox" value="' . $wk . '" data-id="' . $uniqid . '" class="kon_' . $period_id_value . '_1" onclick="change_now_selction(' . $period_id_value . ',1,' . $wk . ',this);"/>' . $wv;
                        } else {
                            $sHtml1 .= '<input type="checkbox" value="' . $wk . '" data-id="' . $uniqid . '" class="kon_' . $kk . '_1" onclick="change_now_selction(' . $kk . ',1,' . $wk . ',this);"/>' . $wv;
                        }
                    }
                    $sHtml1 .= '</td>';
                    $sHtml1 .= '<td></td>';

                    for ($j = 0; $j < count($temp_new); $j++) {

                        $temp = explode('-', $temp_new[$j]);
                        if ($temp[1] == 'N') {
                            $placeholder = "NIGHT";
                        } elseif ($temp[1] == 'M') {
                            $placeholder = "MONTH";
                        } elseif ($temp[1] == 'Y') {
                            $placeholder = "YEAR";
                        }

                        if (!empty($period_id_value)) {
                            $sHtml1 .= '<td><input type="text" required="required" class="form-control nightly_amount_' . $period_id_value . '_1" number="true" name="nightly_amount[' . $period_id_value . '][1,2,3,4,5,6,7][1][' . $temp[0] . '][' . $placeholder . ']"></td>';
                        } else {
                            $sHtml1 .= '<td><input type="text" required="required" class="form-control nightly_amount_' . $kk . '_1" number="true" name="nightly_amount[' . $kk . '][1,2,3,4,5,6,7][1][' . $temp[0] . '][' . $placeholder . ']"></td>';
                        }
                    }

                    $sHtml1 .= '</tr>';
                    $sHtml[] = $sHtml1;
                }
            }
        } else {
            if ($enable_pgc == 1) {
                $sHtml = array();

                for ($kk = 0; $kk <= $period_total_count; $kk++) {
                    $sHtml1 = "";
                    for ($i = $perguest_standard_occupancy; $i <= $perguest_max_occupancy; $i++) {
                        $sHtml1 .= '<tr class="dyna_night_pricing">';
                        $sHtml1 .= '<td></td>';
                        if ($i == $perguest_standard_occupancy) {
                            $sHtml1 .= '<td>' . $i . ' and less than ' . $i . ' guests</td>';
                        } elseif ($i == $perguest_max_occupancy) {
                            $sHtml1 .= '<td>' . $i . ' + guests</td>';
                        } else {
                            $sHtml1 .= '<td>' . $i . '</td>';
                        }

                        for ($j = 0; $j < count($temp_new); $j++) {
                            $temp = explode('-', $temp_new[$j]);
                            if ($temp[1] == 'N') {
                                $placeholder = "NIGHT";
                            } elseif ($temp[1] == 'M') {
                                $placeholder = "MONTH";
                            } elseif ($temp[1] == 'Y') {
                                $placeholder = "YEAR";
                            }

                            if (!empty($period_id_value)) {
                                $sHtml1 .= '<td><input type="text" required="required" class="form-control" number="true" name="nightly_amount[' . $period_id_value . '][1,2,3,4,5,6,7][' . $i . '][' . $temp[0] . '][' . $placeholder . ']"></td>';
                            } else {
                                $sHtml1 .= '<td><input type="text" required="required" class="form-control" number="true" name="nightly_amount[' . $kk . '][1,2,3,4,5,6,7][' . $i . '][' . $temp[0] . '][' . $placeholder . ']"></td>';
                            }
                        }
                        $sHtml1 .= '</tr>';
                    }
                    $sHtml[] = $sHtml1;
                }
            } else {
                $sHtml = array();

                for ($kk = 0; $kk <= $period_total_count; $kk++) {
                    $sHtml1 = "";
                    $sHtml1 .= '<tr class="dyna_night_pricing">';
                    $sHtml1 .= '<td></td>';
                    $sHtml1 .= '<td></td>';
                    for ($j = 0; $j < count($temp_new); $j++) {

                        $temp = explode('-', $temp_new[$j]);
                        if ($temp[1] == 'N') {
                            $placeholder = "NIGHT";
                        } elseif ($temp[1] == 'M') {
                            $placeholder = "MONTH";
                        } elseif ($temp[1] == 'Y') {
                            $placeholder = "YEAR";
                        }
                        if (!empty($period_id_value)) {
                            $sHtml1 .= '<td><input type="text" required="required" class="form-control" number="true" name="nightly_amount[' . $period_id_value . '][1,2,3,4,5,6,7][1][' . $temp[0] . '][' . $placeholder . ']"></td>';
                        } else {
                            $sHtml1 .= '<td><input type="text" required="required" class="form-control" number="true" name="nightly_amount[' . $kk . '][1,2,3,4,5,6,7][1][' . $temp[0] . '][' . $placeholder . ']"></td>';
                        }
                    }
                    $sHtml1 .= '</tr>';
                    $sHtml[] = $sHtml1;
                }
            }
        }

        if ($return == 1) {
            return $sHtml;
        } else {
            echo json_encode(array('result' => $sHtml));
            exit;
        }
    }
    
    
    function add_new_period() {
        $period_range_count = $this->input->post('period_range_count');
        $enable_now = $this->input->post('enable_now');
        $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        $enable_pgc = $this->input->post('enable_pgc');
        $period_range_value = explode(',', $this->input->post('period_range_value'));
        $period_total_count = $this->input->post('period_total_count');
        $period_range_json_value = $this->input->post('period_range_json_value');

        $period_total_count++;

        $sHTml1 = '<div style="border: 1px solid #CCCCCC;clear: both; margin-bottom: 30px;padding: 20px;" id="main_container_content_' . $period_total_count . '">';
        $sHTml1 .= '<div>';
        $sHTml1 .= '<div style="clear: both;margin-top: 10px;" class="col-sm-3 marginbtm"><label class="control-label" for="validation_name">Check-in:</label><br><div style="float: left;padding-right: 6px;" class="datepicker-input input-group"><input type="text" class="form-control datepickerin mySelectCalenda calinput" required="required" name="price_check_in[]" placeholder="Check-in" data-format="YYYY-MM-DD"></div></div>';
        $sHTml1 .= '<div style="margin-top: 10px;" class="col-sm-3 marginbtm"><label class="control-label" for="validation_name">Check-out:</label><br><div style="float: left;padding-right: 6px;" class="datepicker-input input-group"><input type="text" class="form-control datepickerout mySelectCalenda calinput" required="required" name="price_check_out[]" placeholder="Check-out" data-format="YYYY-MM-DD"></div></div>';
        $sHTml1 .= ' <div style="margin-top: 10px;" class="col-sm-2 marginbtm"><label class="control-label" for="validation_name">Period name:</label><br>  <input type="text" class="form-control" required="required" name="price_period_name[]" placeholder="Period Name"></div>';
        $sHTml1 .= '<div style="margin-top: 10px;" class="col-sm-2 marginbtm"><label class="control-label" for="validation_name">Minimum stay:</label><br> <div id="price_min_stay_' . $period_total_count . '">';
        $sHTml1 .= '<select class="select2 form-control" id="validation_price_min_stay_' . $period_total_count . '" required="required" name="price_min_stay_value[]" class="select2 form-control">';
        for ($i = 1; $i <= 27; $i++) {
            $sHTml1 .= '<option value="' . $i . '">' . $i . '</option>';
        }
        $sHTml1 .= '</select></div>';
        $sHTml1 .= '<select class="select2 form-control" onclick="get_min_price_stay_value(this.value,' . $period_total_count . ');"  name="price_min_stay_unit[]" required="required" id="validation_price_min_stay_unit_' . $period_total_count . '" tabindex="-1"><option value="">Please select</option><option selected="selected" value="NIGHT">Night</option><option value="MONTH">Month</option><option value="YEAR">Year</option></select></div>';
        $sHTml1 .= '<div style="clear: both;float: left;"><label class="control-label">Weekly Rental</label><input type="checkbox"  name="weekly_rental_' . $period_total_count . '" class="weekly_rental" id="toggle_weekly_rental_' . $period_total_count . '" onclick="toggle_weekly_rental(\'' . $period_total_count . '\')" style="clear: both;float: left;margin-bottom: 13px;margin-right: 10px;margin-top: 10px;"/>
                    </div>';
        $sHTml1 .= '</div>';
        $sHTml1 .= '<div style="clear: both;"></div>';

        $response = $this->get_changed_property_now_epc($period_range_count, $enable_now, $perguest_standard_occupancy, $perguest_max_occupancy, $enable_pgc, $period_range_json_value, 0, $period_total_count);

        $sHTml1 .= '<div class="responsive-table">';
        $sHTml1 .= '<div class="scrollable-area">';
        $sHTml1 .= '<table id="property_pricing_display_' . $period_total_count . '" style="margin-bottom:0;" class="table table-bordered table-striped property_pricing_display">';
        $sHTml1 .= '<thead><tr><th>Night of week</th><th>For</th>';
        foreach ($period_range_value as $key => $value) {
            $sHTml1 .= '<th>' . $value . '</th>';
        }
        $sHTml1 .= '<th><a data-toggle="modal" href="#modal-example3">Add</a></th>';
        $sHTml1 .= '</tr></thead>';

        $sHTml1 .= '<tbody>' . implode("", $response) . '</tbody></table>';
        if ($enable_now == 1) {
            $sHTml1 .= '<table class="add_new_now"><thead></thead><tbody><tr><td><a onclick="add_new_now(1, this.id);" id="add_new_now_' . $period_total_count . '" class="add_new_now_class" href="javascript:void(0);">Add a new night-of-week group</a></td></tr></tbody></table>';
        }
        $sHTml1 .= '</div></div>';
        $sHTml1 .= '<a onclick="delete_period(\'main_container_content_' . $period_total_count . '\');" href="javascript:void(0)" style="clear: both;float: right;font-weight: bold;margin-bottom: 25px;margin-top: 40px;text-decoration: underline;width: 10%;">Delete Period</a>';

        echo json_encode(array('result' => $sHTml1));
        exit;
    }
    
    function add_new_night_period() {
        $period_range_count = $this->input->post('period_range_count');
        $enable_now = $this->input->post('enable_now');
        $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        $enable_pgc = $this->input->post('enable_pgc');
        $period_range_value = explode(',', $this->input->post('period_range_value'));
        $period_total_count = $this->input->post('period_total_count');
        $period_range_json_value = $this->input->post('period_range_json_value');
        $period_total_count++;

        $response = $this->get_changed_property_now_epc($period_range_count, $enable_now, $perguest_standard_occupancy, $perguest_max_occupancy, $enable_pgc, $period_range_json_value, $period_total_count);

        $sHtml = array();
        foreach ($response as $mkey => $mvalue) {
            $sHTml1 = '';
            $sHTml1 .= '<thead><tr><th>Night of week</th><th>For</th>';
            foreach ($period_range_value as $key => $value) {
                $sHTml1 .= '<th>' . $value . '</th>';
            }
            $sHTml1 .= '<th><a data-toggle="modal" href="#modal-example3">Add</a></th>';
            $sHTml1 .= '</tr></thead>';
            $sHTml1 .= '<tbody>' . $mvalue . '</tbody>';
            $sHtml[] = $sHTml1;
        }

        echo json_encode(array('result' => $sHtml));
        exit;
    }
    
    function add_new_now() {
        $period_range_count = $this->input->post('period_range_count');
        $enable_now = $this->input->post('enable_now');
        $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        $enable_pgc = $this->input->post('enable_pgc');
        $period_total_count = $this->input->post('period_total_count');
        $period_range_json_value = $this->input->post('period_range_json_value');
        $now_count = $this->input->post('now_count');
        $id = $this->input->post('id');
        $now_count++;

        $temp_new = array();
        if (isset($period_range_json_value['NIGHT']) && !empty($period_range_json_value['NIGHT'])) {
            foreach ($period_range_json_value['NIGHT'] as $key => $value) {
                $temp_new[] = $key . '-N';
            }
        }

        if (isset($period_range_json_value['MONTH']) && !empty($period_range_json_value['MONTH'])) {
            foreach ($period_range_json_value['MONTH'] as $key => $value) {
                $temp_new[] = $key . '-M';
            }
        }

        if (isset($period_range_json_value['YEAR']) && !empty($period_range_json_value['YEAR'])) {
            foreach ($period_range_json_value['YEAR'] as $key => $value) {
                $temp_new[] = $key . '-Y';
            }
        }

        if ($enable_pgc == 1) {
            $week_days = array('1' => 'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thur', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun');
            $uniqid = uniqid();

            $sHtml = '<tr class="night_after_append ' . $uniqid . '">';
            $sHtml .= '<td>';
            foreach ($week_days as $wk => $wv) {
                $sHtml .= '<input type="checkbox" value="' . $wk . '" data-id="' . $uniqid . '" class="kon_' . $period_total_count . '_' . $now_count . '" onclick="change_now_selction(' . $period_total_count . ',' . $now_count . ',' . $wk . ',this);"/>' . $wv;
            }
            $sHtml .= '</td>';
            $sHtml .= '<td></td>';
            for ($j = 0; $j < $period_range_count; $j++) {
                $sHtml .= '<td></td>';
            }
            $sHtml .= '</tr>';

            for ($i = $perguest_standard_occupancy; $i <= $perguest_max_occupancy; $i++) {
                $sHtml .= '<tr class="dyna_night_pricing ' . $uniqid . '" >';
                $sHtml .= '<td></td>';
                if ($i == $perguest_standard_occupancy) {
                    $sHtml .= '<td>' . $i . ' and less than ' . $i . ' guests</td>';
                } elseif ($i == $perguest_max_occupancy) {
                    $sHtml .= '<td>' . $i . ' + guests</td>';
                } else {
                    $sHtml .= '<td>' . $i . '</td>';
                }

                for ($j = 0; $j < $period_range_count; $j++) {
                    $temp = explode('-', $temp_new[$j]);
                    if ($temp[1] == 'N') {
                        $placeholder = "NIGHT";
                    } elseif ($temp[1] == 'M') {
                        $placeholder = "MONTH";
                    } elseif ($temp[1] == 'Y') {
                        $placeholder = "YEAR";
                    }
                    $sHtml .= '<td><input type="text" required="required" class="form-control nightly_amount_' . $period_total_count . '_' . $now_count . '" number="true" name="nightly_amount[' . $period_total_count . '][1,2,3,4,5,6,7][' . $i . '][' . $temp[0] . '][' . $placeholder . ']"></td>';
                }
                $sHtml .= '</tr>';
            }
            $sHtml .= '<tr class="' . $uniqid . '"><td><a href="javascript:void(0);" onclick="delete_now(\'' . $uniqid . '\',\'' . $now_count . '\',\'' . $id . '\')">Delete Week Group</a><td></tr>';

            echo json_encode(array('result' => $sHtml));
            exit;
        } else {
            $uniqid = uniqid();
            $week_days = array('1' => 'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thur', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun');
            $sHtml = "";
            $sHtml .= '<tr class="night_after_append ' . $uniqid . '" >';
            $sHtml .= '<td>';
            foreach ($week_days as $wk => $wv) {
                $sHtml .= '<input type="checkbox" data-id="' . $uniqid . '" value="' . $wk . '" class="kon_' . $period_total_count . '_' . $now_count . '" onclick="change_now_selction(' . $period_total_count . ',' . $now_count . ',' . $wk . ',this);"/>' . $wv;
            }
            $sHtml .= '</td>';
            $sHtml .= '<td></td>';
            for ($j = 0; $j < $period_range_count; $j++) {
                $temp = explode('-', $temp_new[$j]);
                if ($temp[1] == 'N') {
                    $placeholder = "NIGHT";
                } elseif ($temp[1] == 'M') {
                    $placeholder = "MONTH";
                } elseif ($temp[1] == 'Y') {
                    $placeholder = "YEAR";
                }

                $sHtml .= '<td><input type="text" required="required" class="form-control nightly_amount_' . $period_total_count . '_' . $now_count . '" number="true" name="nightly_amount[' . $period_total_count . '][1,2,3,4,5,6,7][1][' . $temp[0] . '][' . $placeholder . ']"></td>';
            }
            $sHtml .= '</tr>';
            $sHtml .= '<tr class="' . $uniqid . '"><td><a href="javascript:void(0);" onclick="delete_now(\'' . $uniqid . '\',\'' . $now_count . '\',\'' . $id . '\')">Delete Week Group</a><td></tr>';
            echo json_encode(array('result' => $sHtml));
            exit;
        }
    }
    
    public function get_price_min_stay_value() {
        $value = $this->input->post('value');
        $select_id = $this->input->post('select_id');

        $sHtml = '<select id="' . $select_id . '" required="required" name="price_min_stay_value[]" class="select2 form-control custom_class">';

        if (!empty($value)) {
            if ($value == "NIGHT") {
                $unit_value = 27;
            } elseif ($value == "MONTH") {
                $unit_value = 12;
            } elseif ($value == "YEAR") {
                $unit_value = 5;
            }

            for ($i = 1; $i <= $unit_value; $i++) {
                $sHtml .= "<option value='" . $i . "'>" . $i . "</option>";
            }
        }
        $sHtml .= "</select>";

        echo json_encode(array('result' => $sHtml));
        exit;
    }
    
    function ed_week_rental() {

        $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        $c_period_count = $this->input->post('c_period_count');

        $sHtml = '';

        if (!empty($perguest_standard_occupancy)) {
            for ($i = $perguest_standard_occupancy; $i <= $perguest_max_occupancy; $i++) {

                if ($i == $perguest_standard_occupancy) {
                    $sHtml .= '<tr><td></td><td><p style="float: left;width: 100%;">' . $i . ' and less than ' . $i . ' guests </p>';
                } elseif ($i == $perguest_max_occupancy) {
                    $sHtml .= '<tr><td></td><td><p style="float: left;width: 100%;">' . $i . ' + guests </p>';
                } else {
                    $sHtml .= '<tr><td></td><td><p style="float: left;width: 100%;">' . $i . '</p>';
                }

                $sHtml .= '<input type="text" required="required" name="weekly_amount[' . $c_period_count . '][' . $i . ']" style="width: 100%;"  class="form-control"></td></tr>';
            }
        } else {
            $sHtml .= '<tr><td></td><td><input type="text"  required="required" name="weekly_amount[0][1]" style="width: 100%;" name="" class="form-control"></td></tr>';
        }
        echo json_encode(array('result' => $sHtml));
    }
    
    public function get_min_stay_value() {
        $value = $this->input->post('value');
        $select_id = $this->input->post('select_id');

        $sHtml = '<div class="controls"><select id="' . $select_id . '" required="required" name="min_stay_value" class="select2 form-control custom_class" style="width: 60%;">';

        if (!empty($value)) {
            if ($value == "NIGHT") {
                $unit_value = 27;
            } elseif ($value == "MONTH") {
                $unit_value = 12;
            } elseif ($value == "YEAR") {
                $unit_value = 5;
            }

            for ($i = 1; $i <= $unit_value; $i++) {
                $sHtml .= "<option value='" . $i . "'>" . $i . "</option>";
            }
        }
        $sHtml .= "</select></div>";

        echo json_encode(array('result' => $sHtml));
        exit;
    }
    
    public function get_country_code(){
		$country = $_POST['country'];
		$result = $this->Listings_Model->get_country_code($country);
		echo json_encode(array('country_code' => $result->COUNTRY_CODE));
	}
	
	public function change_listings_status(){
		$prop_id = $this->input->post('prop_id');
		$status = $this->input->post('status');
		$this->db->where('PROPERTY_ID',$prop_id);
		$this->db->update('kigo_properties',array('PROPERTY_STATUS' => $status));
	}
	
	public function get_bed_types(){		
		$bed_id = $this->input->post('beds');		
		$sHTml = "";
		
		$property_bed_types = $this->Listings_Model->get_property_bed_types();
		
		if(!empty($property_bed_types)){
			for($i=0;$i<$bed_id;$i++){
				$sHTml .= '<select class="myselect fulwidsel property_bed_types" name="prop_beds_types[]" >';
				foreach($property_bed_types as $key => $value){					
					$sHTml .= '<option value="'.$value->PROPERTY_TYPE_ID.'">'.$value->PROP_TYPE_LABEL.'</option>';					
				}
				$sHTml .= '</select><div style="clear:both;height:10px;"></div>';					
			}
		}
		
		echo json_encode(array('result' => $sHTml));
		die;
	}


	
    
}

/* End of file listings.php */
/* Location: ./application/controllers/listings.php */
