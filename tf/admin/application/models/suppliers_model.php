<?php

class Suppliers_model extends CI_Model {
	
	public function __construct()
    {
		parent::__construct();
    }

function add_contact_inf($supplier_id,$star, $city, $pro_name, $main_first_name, $main_last_name, $main_email, $hotel_chain_name,$hotel_address,$main_phone,$main_fax,$hotel_desc,$nearby_attraction,$nearby_airport,$latitude,$longitude)
	{
		
		$sql="INSERT INTO crs_hotels (sup_id,star, hotel_name, city, main_first_name, main_last_name, main_email, hotel_chain_name, address, res_phone, res_fax, descrip, nearby_placeinterest, nearby_airport, latitude, longitude, status)VALUES('$supplier_id','$star', '$pro_name', '$city', '$main_first_name', '$main_last_name', '$main_email', '$hotel_chain_name','	$hotel_address','$main_phone','$main_fax','$hotel_desc',' $nearby_attraction','$nearby_airport','$latitude','$longitude', '0')"; 
																																									
		$this->db->set('created_date', 'NOW()', FALSE); 
		$rs=$this->db->query($sql);
		

		$last_ins_id = $this->db->insert_id();
		$wheres = "sup_hotel_id  = $last_ins_id";
		$datas = array(
		'crs_id' => 'CRS'.$last_ins_id
		);
		if ($this->db->update('crs_hotels', $datas, $wheres)) {
		
		return $last_ins_id;
		} else {
		return false;
		}
		return $last_ins_id;
	}
	
	//ok...................................
	function view_all_hotels_admin($id='')
	{

		$select ="SELECT * FROM crs_hotels";
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	
	function view_all_hotels($id='')
	{

		$select ="SELECT * FROM crs_hotels where sup_id = '$id'";
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	function update_hotel_status($id,$status)
	{
		if($status == 2)
		{
			$where2 = "sup_hotel_id = $id";
			if ($this->db->delete('crs_hotels', $where2)) {
				return true;
			} else {
				return false;
			}
		}
		else
		{
			$where = "sup_hotel_id = $id";
			$data = array(
				'status' => $status
			);
			if ($this->db->update('crs_hotels', $data, $where)) {
				return true;
			} else {
				return false;
			}
		}
	}

	function get_global_amenities()
    {		
	 	$this->db->select('*');
	  	$this->db->from('global_amenity_list');
		$this->db->order_by("amenity_list_id", "desc");
	    $query = $this->db->get();
		
	 if($query->num_rows() ==''){
			return '';			
		}else{
		 
		return $query->result();				
		}
    }

   function add_hotel_amenities($amenity_name)
   {
	   $data =array(
			'amenity_name' 	=> $amenity_name,
			'status' => '1'
			);
		$this->db->insert('global_amenity_list',$data);
		$id=$this->db->insert_id();
		if(!empty($id))
	  	{
		 	return true;
		 }
		else {
			  
			  return false;
		  }
   }

   function update_amenity_list($id,$status)
   {
		if($status == 2)
		{
			$where2 = "amenity_list_id  = $id";
			if ($this->db->delete('global_amenity_list', $where2)) {
				return true;
			} else {
				return false;
			}
		}
		else
		{
			$where = "amenity_list_id  = $id";
			$data = array(
				'status' => $status
			);
			if ($this->db->update('global_amenity_list', $data, $where)) {
				return true;
			} else {
				return false;
			}
		}
   }

   function price_list()
	{		
		$suppl_id = $this->session->userdata('supplier_id');
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_rate_tactics A 
                        INNER JOIN crs_hotels B ON B.sup_hotel_id = A.hotel_id 
						
                        WHERE  A.sup_id = '$suppl_id'"; 
						
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	
	}
	
	 function room_type_list()
	{
		$suppl_id = $this->session->userdata('supplier_id');

		$select = "SELECT A.sup_hotel_room_type_id, A.hotel_id, A.hotel_room_type, A.hotel_room_services, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_hotel_room_type A 
                        INNER JOIN crs_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE A.user_type='supplier' AND A.user_id='$suppl_id'"; 

		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	
	public function get_all_hotel_facility()
	 {		
		 	$this->db->select('*');
		  	$this->db->from('global_amenity_list');
			$this->db->where('status',1);
		    $query = $this->db->get();
			
		 if($query->num_rows() ==''){
				return '';			
			}else{
			 
			return $query->result();				
			}
	  }
	  
	function add_room_type_details($hotel_name, $room_type, $facility_name,$room_desc,$spl_id)
	{		
		$a=serialize($facility_name);
		$sql="INSERT INTO `sup_hotel_room_type` (`hotel_id`, `hotel_room_type`, `hotel_room_services`,`room_desc`,`user_type`,`user_id`,`sup_id`) VALUES ('".$hotel_name."', '".$room_type."','".$a."','".$room_desc."','supplier','$spl_id','$spl_id')";
		$res=$this->db->query($sql);
		if ($res) {
			return true;
		} else {
			return false;
		}
	} 
	
	function capacity_list($id)
	{
		$select = "SELECT A.capacity_id, A.hotel_id, A.capacity_title, A.capacity, A.child_capacity, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_hotel_capacity A 
                        INNER JOIN crs_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE A.user_type='supplier' AND A.user_id='$id'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}  
	
	function add_room_capacity_details($hotel_name, $capacity_title, $capacity, $child_capacity,$spl_id)
	{	
		$data = array('hotel_id'=>$hotel_name,'capacity_title'=>$capacity_title,'capacity'=>$capacity,'child_capacity'=>$child_capacity,'user_type'=>'supplier','user_id'=>$spl_id);
		
		$this->db->insert('sup_hotel_capacity',$data);
		 $this->db->last_query();
		$id = $this->db->insert_id();
		if (!empty($id)) {
			return true;
		} else {
			return false;
		}
	}
	
	function view_room_type($sup_hotel_room_type_id)
	{
		$select = "SELECT sup_hotel_room_type_id, hotel_id, hotel_room_type, hotel_room_services,room_desc
                        FROM sup_hotel_room_type 
                        WHERE sup_hotel_room_type_id = '".$sup_hotel_room_type_id."'"; 
		$query=$this->db->query($select);
			
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->row();
		}
	}
	
	 function delete_room_type($sup_hotel_room_type_id)
	{
		$where = "sup_hotel_room_type_id = $sup_hotel_room_type_id";
		if ($this->db->delete('sup_hotel_room_type', $where)) {
			return true;
		} else {
			return false;
		}
	}
	
	function view_room_capacity($capacity_id)
	{
		$select = "SELECT capacity_id, hotel_id, capacity_title, capacity, child_capacity
                        FROM sup_hotel_capacity 
                        WHERE capacity_id = '".$capacity_id."'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->row();
		}
	}
	
	function edit_room_capacity_details($capacity_id, $hotel_name, $capacity_title, $capacity, $child_capacity)
	{
		$sql="UPDATE sup_hotel_capacity SET hotel_id='".$hotel_name."',capacity_title='".$capacity_title."',capacity='".$capacity."',child_capacity='".$child_capacity."'";
			$sql.=" WHERE capacity_id='".$capacity_id."'";
			$res=$this->db->query($sql);

		if ($res) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete_capacity($capacity_id)
	{
		$where = "capacity_id = $capacity_id";
		if ($this->db->delete('sup_hotel_capacity', $where)) {
			return true;
		} else {
			return false;
		}
	}
	
	function all_hotel_room_list($id='')
	{		
		$suppl_id = $this->session->userdata('supplier_id');
		if($id==''){
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_inv_cate_type A 
                        INNER JOIN crs_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE B.status = '1' and  A.sup_id = '".$suppl_id."' order by sup_inv_cate_type_id desc";
                         }else{
        $select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_inv_cate_type A 
                        INNER JOIN crs_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE B.status = '1' and A.sup_id = '".$suppl_id."' and sup_inv_cate_type_id='".$id."' order by sup_inv_cate_type_id desc"; 
                         }
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	
	function delete_room($sup_inv_cate_type_id)
	{
		$where = "sup_inv_cate_type_id = $sup_inv_cate_type_id";
		if ($this->db->delete('sup_inv_cate_type', $where)) {
			return true;
		} else {
			return false;
		}
	}
	
	function getRoomType($hotel_id)
	{
		$select = "SELECT sup_hotel_room_type_id, hotel_id, hotel_room_type FROM sup_hotel_room_type where hotel_id = '".$hotel_id."' order by sup_hotel_room_type_id desc";
		$query=$this->db->query($select);
		
		$select1 = "SELECT capacity_id, hotel_id, capacity_title, capacity, child_capacity FROM sup_hotel_capacity where hotel_id = '".$hotel_id."' order by capacity_id desc";
		$query1=$this->db->query($select1);
		if($query->result()){
			$roomTypes 		= $query->result();
			$roomTypesCapacity 		= $query1->result();
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('roomTypes'=>$roomTypes,'roomTypesCapacity'=>$roomTypesCapacity, 'status' => 1)));
		}
		else{
			$this->output->set_output(json_encode(array('status' => 0)));
		}
	}

	function add_rate_plans($supplier_id, $prop_id, $room_cate, $room_type, $season, $allocation_rooms, $allocation_release_days, $allocation_release_period, $allocation_validity_from, $allocation_validity_to, $child_below_age, $child_above_age, $child_above_age_charge, $child_extra_bed_charge, $no_of_infants, $breakfast, $breakfast_type, $meal_plan, $lunch, $dinner, $adult_breakfast_rate, $adult_lunch_rate, $adult_dinner_rate, $child_breakfast_rate, $child_lunch_rate,$child_dinner_rate, $child_policy, $remarks, $cancel_policy_nights, $cancel_policy_percent, $cancel_policy_charge, $cancel_policy_from, $cancel_policy_to, $cancel_policy_desc, $room_avail_date_from, $room_avail_date_to, $dates, $weekday, $price, $extra_bed_price, $avail, $aadult, $achild, $child_price, $infant, $sup_charge, $supplement_rate, $main_image,$image1,$image2,$image3)
	{

		$counter = count($room_avail_date_from);
		for($k=0;$k < $counter;$k++)
		{
			//$k=1;
			if(is_array($room_avail_date_from))
			{
				$sdate = $room_avail_date_from[$k];
				$sdate = date('d-m-Y',strtotime($sdate));
				$fromda = explode("-",$sdate);
				$avail_date_from = $fromda[2].'-'.$fromda[1].'-'.$fromda[0];
			}
			else
			{
				$sdate = $room_avail_date_from;
				$sdate = date('d-m-Y',strtotime($sdate));
				
				$fromda = explode("-",$sdate);
				$avail_date_from = $fromda[2].'-'.$fromda[1].'-'.$fromda[0];
			}
			
			if(is_array($room_avail_date_to))
			{
				$edate = $room_avail_date_to[$k];
				$edate = date('d-m-Y',strtotime($edate));
				
				$toda = explode("-",$edate);
				$avail_date_to = $toda[2].'-'.$toda[1].'-'.$toda[0];
			}
			else
			{
				$edate = $room_avail_date_to;
				$edate = date('d-m-Y',strtotime($edate));
				
				$toda = explode("-",$edate);
				$edate = date('d-m-Y',strtotime($edate));
				$avail_date_to = $toda[2].'-'.$toda[1].'-'.$toda[0];
			}
						
			$child_policy = addslashes($child_policy);
			$remarks = addslashes($remarks);
			$cancel_policy_desc = addslashes($cancel_policy_desc);
		
			$data = array(
				'sup_id' => $supplier_id,
				'hotel_id' => $prop_id,
				'season_id' => $season,
				'category_type' => $room_cate,
				'room_type' => $room_type,
				'child_below_age' => $child_below_age,
				'child_above_age' => $child_above_age,
				'child_above_age_charge' => $child_above_age_charge,
				'child_extra_bed_charge' => $child_extra_bed_charge,
				'infant' => $no_of_infants,
				'breakfast' => $breakfast,
				'breakfast_type' => $breakfast_type,
				'meal_plan' => $meal_plan,
				'meal_plan_lunch' => $lunch,
				'meal_plan_dinner' => $dinner,
				'adult_meal_plan_breakfast_rate' => $adult_breakfast_rate,
				'adult_meal_plan_lunch_rate' => $adult_lunch_rate,
				'adult_meal_plan_dinner_rate' => $adult_dinner_rate,
				'child_meal_plan_breakfast_rate' => $child_breakfast_rate,
				'child_meal_plan_lunch_rate' => $child_lunch_rate,
				'child_meal_plan_dinner_rate' => $child_dinner_rate,
				'child_policy' => $child_policy,
				'remarks' => $remarks,
				'cancel_policy_desc' => $cancel_policy_desc,
				'room_avail_date_from' => $avail_date_from,
				'room_avail_date_to' => $avail_date_to,
				'supplement_rate' => $supplement_rate,
				'main_image' => $main_image,
				'image1' => $image1,
				'image2' => $image2,
				'image3' => $image2,
				'status' => 1
				);
			//print_r($data); exit;
			$this->db->set('created_date', 'NOW()', FALSE); 
		
			$this->db->insert('sup_rate_tactics', $data);
			//echo $this->db->last_query();
			$id = $this->db->insert_id();
		//$id=1111;
			if(isset($cancel_policy_percent) && $cancel_policy_percent != "")
			{
				for($i=0; $i<count($cancel_policy_percent); $i++)
				{
					//if(strtotime($cancel_policy_from[$i]) >= strtotime($sdate) && strtotime($cancel_policy_to[$i]) <= strtotime($edate))
					//{
						$ins = "INSERT INTO `sup_rate_cancel_policy` (`rate_tactics_id` ,`cancel_policy_nights` ,`cancel_policy_percent` ,`cancel_policy_charge` ,`cancel_policy_from` ,`cancel_policy_to`)
					VALUES ('".$id."', '".$cancel_policy_nights[$i]."', '".$cancel_policy_percent[$i]."', '".$cancel_policy_charge[$i]."', '".$cancel_policy_from[$i]."', '".$cancel_policy_to[$i]."')";
						$exe = $this->db->query($ins);
					//}
				}
			}
			
			if(isset($price) && $price != "")
			{
				for($i=0; $i<count($dates); $i++)
				{
					if(strtotime($dates[$i]) >= strtotime($sdate) && strtotime($dates[$i]) <= strtotime($edate))
					{
						$day  = explode("-",$dates[$i]);
						$date = $day[2].'-'.$day[1].'-'.$day[0]; 
			
						$qry = "INSERT INTO `sup_apart_maintain_month` ( 
					`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`extra_bed_price` ,`supplementary_charge_rate` ,`available_rooms` ,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
					VALUES ( '$supplier_id', '".$id."', '".$prop_id."', '".$date."', '".$weekday[$i]."', '".$day[0]."', '".$day[1]."', '".$day[2]."', '".$price[$i]."', '".$extra_bed_price[$i]."', '".$sup_charge[$i]."', '".$avail[$i]."', '', '".$aadult[$i]."', '".$achild[$i]."', '".$child_price[$i]."', '".$infant[$i]."', '1')";
						$query=$this->db->query($qry);
					}
				}
			}
		
		}
//exit();
		if(!empty($id)) 
		{
			return true;
		} 
		else
		{
			return false;
		}
 	}
	
	function view_rate_tactics_details($id)
	{		
		$select = "SELECT * FROM sup_rate_tactics where sup_rate_tactics_id = '$id'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}

	function fetch_maintain_month_details($id)
	{
		$select = "SELECT * FROM sup_apart_maintain_month where sup_rate_tactics_id = '$id' ORDER BY date";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}

	}

	function delete_price($sup_rate_tactics_id)
	{
		$where = "sup_rate_tactics_id = $sup_rate_tactics_id";
		if ($this->db->delete('sup_rate_tactics', $where)) {
			return true;
		} else {
			return false;
		}
	}
	
	function get_child_policy($hotel_id)
	{	
            
		$select = "SELECT child_policy,cancel_policy_desc FROM sup_rate_tactics where hotel_id = '$hotel_id'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}

	function add_room_details($hotel_name, $room_type, $no_of_rooms, $capacity, $no_of_children)
	{
		$suppl_id = $this->session->userdata('supplier_id');
		$data = array('sup_id'=>$suppl_id,'hotel_id'=>$hotel_name,'room_type'=>$room_type,'no_of_rooms'=>$no_of_rooms,'max_person'=>$capacity,'childs'=>$no_of_children,'status'=>'1');
		$this->db->insert('sup_inv_cate_type',$data);
		$id = $this->db->insert_id();
		if (!empty($id)) {
			return true;
		} else {
			return false;
		}
	}
	
	function house_rules_list()
	{
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_apart_houserules A 
                        INNER JOIN crs_hotels B ON B.sup_hotel_id = A.hotel_id 
			WHERE B.sup_id = 'admin' AND B.status = '1'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}

	function edit_house_rules($id, $arrival_time, $departure_time, $check_in_time_from, $check_in_extra_cost_from, $check_in_time_to, $check_in_extra_cost_to, $check_out_time_from, $check_out_extra_cost_from, $check_out_time_to, $check_out_extra_cost_to, $manimum_stay, $maximum_stay, $rent_amt_percent, $rent_amt_days, $payment_mode, $cleaning, $supplies, $policy)
	{
		$policy = addslashes($policy);
		$query = $this->db->query("UPDATE sup_apart_houserules SET arrivaltime_from='$arrival_time', departtime_before='$departure_time', checkin_time1='$check_in_time_from', checkin_time2='$check_in_time_to', checkout_time1='$check_out_time_from', checkout_time2='$check_out_time_to', checkin_extracost1='$check_in_extra_cost_from', checkin_extracost2='$check_in_extra_cost_to', checkout_extracost2='$check_out_extra_cost_from', checkout_extracost1='$check_out_extra_cost_to', mini_stay='$manimum_stay', max_stay='$maximum_stay', rent_amount='$rent_amt_percent', rent_amount_days='$rent_amt_days', payment_mode='$payment_mode', cleaning='$cleaning', supplies='$supplies', policy='$policy' WHERE sup_apart_houserules_id='$id'"); //exit;
		if(!empty($id)) {
			return true;
		} else {
			return false;
		}
	}
	
	function get_house_rules($supplier_id,$prop_id)
	{		
		 $select = "SELECT * FROM sup_apart_houserules where sup_id = '$supplier_id' AND hotel_id = '$prop_id'";
		
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	
	function view_all_hotels_by_id($id){
		$select = "SELECT hotel_name,city,sup_hotel_id FROM crs_hotels WHERE sup_id='".$id."'";
		
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}

	function edit_room_type_details($sup_hotel_room_type_id, $hotel_name, $room_type, $facility_name ,$room_desc)
	{
			

			$sql="UPDATE sup_hotel_room_type SET hotel_id='".$hotel_name."',hotel_room_type='".$room_type."',hotel_room_services='".$facility_name."',room_desc='".$room_desc."'";
			
			$sql.=" WHERE sup_hotel_room_type_id='".$sup_hotel_room_type_id."'";
			$res=$this->db->query($sql);
			
			if ($res) {
			return true;
		} else {
			return false;
		}


	}

	function edit_rate_plan($fileimage='',$fileimage1='',$fileimage2='',$fileimage3='',$supplier_id, $prop_id, $id, $room_cate, $room_type, $season, $allocation_rooms, $allocation_release_days, $allocation_release_period, $allocation_validity_from, $allocation_validity_to, $child_below_age, $child_above_age, $child_above_age_charge,$child_extra_bed_charge, $no_of_infants, $breakfast, $breakfast_type, $adult_breakfast_rate, $adult_lunch_rate,$adult_dinner_rate,$child_breakfast_rate,$child_lunch_rate,$child_dinner_rate, $meal_plan, $lunch, $dinner, $child_policy, $remarks, $cancel_policy_nights, $cancel_policy_percent, $cancel_policy_charge, $cancel_policy_from, $cancel_policy_to, $cancel_policy_desc, $room_avail_date_from, $room_avail_date_to, $avail_dates, $avail_weekday, $avail_price, $extra_bed_price, $avail_rooms, $avail_adult, $avail_child, $avail_child_price, $avail_infant, $avail_sup_charge, $avail_datess, $supplement_rate)
	{
		
		
		$counter = count($room_avail_date_from);
		for($k=0;$k < $counter;$k++)
		{
			if(is_array($room_avail_date_from))
			{
				$sdate = $room_avail_date_from[$k];
				$fromda = explode("-",$sdate);
			    $avail_date_from = $fromda[2].'-'.$fromda[1].'-'.$fromda[0];
			}
			else
			{
				$sdate = $room_avail_date_from;
				$fromda = explode("-",$sdate);
			    $avail_date_from = $fromda[2].'-'.$fromda[1].'-'.$fromda[0];
			}
			
			if(is_array($room_avail_date_to))
			{
				$edate = $room_avail_date_to[$k];
				$toda = explode("-",$edate);
				$avail_date_to = $toda[2].'-'.$toda[1].'-'.$toda[0];
			}
			else
			{
				$edate = $room_avail_date_to;
				$toda = explode("-",$edate);
				$avail_date_to = $toda[2].'-'.$toda[1].'-'.$toda[0];
			}
			
			//print'<pre>';print_r($avail_adult);exit;
			
			$child_policy = addslashes($child_policy);
			$remarks = addslashes($remarks);
			$cancel_policy_desc = addslashes($cancel_policy_desc);
			
		
		  if($k==0) 
		  {
			  $select="UPDATE sup_rate_tactics 
							SET category_type='$room_cate',
								room_type='$room_type',
								season_id='$season',
								child_below_age='$child_below_age',
								child_above_age='$child_above_age',
								child_above_age_charge='$child_above_age_charge',
								child_extra_bed_charge='$child_extra_bed_charge',
								infant='$no_of_infants', 
								breakfast='$breakfast', 
								breakfast_type='$breakfast_type', 
								meal_plan='$meal_plan', 
								meal_plan_lunch='$lunch', 
								meal_plan_dinner='$dinner',
							    adult_meal_plan_breakfast_rate='$adult_breakfast_rate',
								adult_meal_plan_lunch_rate='$adult_lunch_rate',
				                adult_meal_plan_dinner_rate='$adult_dinner_rate',
                                child_meal_plan_breakfast_rate='$child_breakfast_rate',
				                child_meal_plan_lunch_rate='$child_lunch_rate',
				                child_meal_plan_dinner_rate='$child_dinner_rate',
								child_policy='$child_policy', 
								remarks='$remarks', 
								cancel_policy_desc='$cancel_policy_desc', 
								room_avail_date_from='$avail_date_from', 
								room_avail_date_to='$avail_date_to',
								supplement_rate =$supplement_rate";

								if($fileimage!='' && $fileimage1!='' && $fileimage2!='' && $fileimage3!=''){
				$select.=", main_image='".$fileimage."',image1='".$fileimage1."',image2='".$fileimage2."',image3='".$fileimage3."'";
			}
							$select.=" WHERE sup_rate_tactics_id='$id'";
							//echo  $select ;exit;
			 $this->db->query($select);
							
			 $delqrys = "DELETE FROM sup_rate_cancel_policy WHERE rate_tactics_id = ".$id.""; 
			 $exequery= $this->db->query($delqrys);	
		
			 if(isset($cancel_policy_percent) && $cancel_policy_percent != "")
			 {
				for($i=0; $i<sizeof($cancel_policy_percent); $i++)
				{
					if(strtotime($cancel_policy_from[$i]) >= strtotime($sdate) && strtotime($cancel_policy_to[$i]) <= strtotime($edate))
					{
						$ins = "INSERT INTO `sup_rate_cancel_policy` (`rate_tactics_id` ,`cancel_policy_nights` ,`cancel_policy_percent` ,`cancel_policy_charge` ,`cancel_policy_from` ,`cancel_policy_to`)
					VALUES ('".$id."', '".$cancel_policy_nights[$i]."', '".$cancel_policy_percent[$i]."', '".$cancel_policy_charge[$i]."', '".$cancel_policy_from[$i]."', '".$cancel_policy_to[$i]."')";
						$exe = $this->db->query($ins);
					}
				}
			 }	
			 
			 $delqry = "DELETE FROM sup_apart_maintain_month WHERE sup_rate_tactics_id = ".$id.""; 
			 $query=$this->db->query($delqry);
							
			 if(isset($avail_dates) && $avail_dates != "")
			 {
				$dates = $avail_dates;
				$weekday = $avail_weekday;
				$price = $avail_price;
				$extra_bed_price = $extra_bed_price;
				$avail = $avail_rooms;
				$adults = $avail_adult;
				$childs = $avail_child;
				$avail_child_price = $avail_child_price;
				$avail_infant = $avail_infant;
				$avail_sup_charge = $avail_sup_charge;
				
				for($i=0; $i<sizeof($dates); $i++)
				{
					if(strtotime($dates[$i]) >= strtotime($sdate) && strtotime($dates[$i]) <= strtotime($edate))
					{
						$day  = explode("-",$dates[$i]);
						$date = $day[2].'-'.$day[1].'-'.$day[0];
			
						$qry = "INSERT INTO `sup_apart_maintain_month` ( 
					`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`extra_bed_price` ,`supplementary_charge_rate` ,`available_rooms` ,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
					VALUES ( '$supplier_id', '".$id."', '".$prop_id."', '".$dates[$i]."', '".$weekday[$i]."', '".$day[2]."', '".$day[1]."', '".$day[0]."', '".$price[$i]."', '".$extra_bed_price[$i]."', '".$avail_sup_charge[$i]."', '".$avail[$i]."', '', '".$adults[$i]."', '".$childs[$i]."', '".$avail_child_price[$i]."', '".$avail_infant[$i]."', '1')";
						$query=$this->db->query($qry);
					}
				 }
			 }
		
			 if(isset($avail_datess) && $avail_datess != "")
			 {
				$dates = $avail_datess;
				$weekday = $avail_weekday;
				$price = $avail_price;
				$extra_bed_price = $extra_bed_price;
				$avail = $avail_rooms;
				$adults = $avail_adult;
				$childs = $avail_child;
				$avail_child_price = $avail_child_price;
				$avail_infant = $avail_infant;
				$avail_sup_charge = $avail_sup_charge;
				
				for($i=0; $i<sizeof($dates); $i++)
				{
					if(strtotime($dates[$i]) >= strtotime($sdate) && strtotime($dates[$i]) <= strtotime($edate))
					{
						$day  = explode("-",$dates[$i]);
						$date = $day[2].'-'.$day[1].'-'.$day[0];
			
						$qry = "INSERT INTO `sup_apart_maintain_month` ( 
					`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`extra_bed_price` ,`supplementary_charge_rate` ,`available_rooms` ,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
					VALUES ( '$supplier_id', '".$id."', '".$prop_id."', '".$date."', '".$weekday[$i]."', '".$day[0]."', '".$day[1]."', '".$day[2]."', '".$price[$i]."', '".$extra_bed_price[$i]."', '".$avail_sup_charge[$i]."', '".$avail[$i]."', '', '".$adults[$i]."', '".$childs[$i]."', '".$avail_child_price[$i]."', '".$avail_infant[$i]."', '1')";
						$query=$this->db->query($qry);
				    }
				 }
			 }
			
			
		   }
		   else
		   {		   
			  $data = array(
				'sup_id' => $supplier_id,
				'hotel_id' => $prop_id,
				'season_id' => $season,
				'market_id' => $market_id,
				'category_type' => $category_name,
				'occupancy' => $occupancy,
				'adult' => $adult,
				'child' => $child,
				'child_below_age' => $child_below_age,
				'child_above_age' => $child_above_age,
				'child_above_age_charge' => $child_above_age_charge,
				'child_extra_bed_charge' => $child_extra_bed_charge,
				'infant' => $no_of_infants,
				'breakfast' => $breakfast,
				'breakfast_type' => $breakfast_type,
				'meal_plan' => $meal_plan,
				'meal_plan_lunch' => $lunch,
				'meal_plan_dinner' => $dinner,
				'adult_meal_plan_breakfast_rate' => $adult_breakfast_rate,
				'adult_meal_plan_lunch_rate' => $adult_lunch_rate,
				'adult_meal_plan_dinner_rate' => $adult_dinner_rate,
				'child_meal_plan_breakfast_rate' => $child_breakfast_rate,
				'child_meal_plan_lunch_rate' => $child_lunch_rate,
				'child_meal_plan_dinner_rate' => $child_dinner_rate,
				'child_policy' => $child_policy,
				'remarks' => $remarks,
				'cancel_policy_desc' => $cancel_policy_desc,
				'room_avail_date_from' => $avail_date_from,
				'room_avail_date_to' => $avail_date_to,
				'supplement_rate' => $supplement_rate,
				'status' => 1
				);
			
			$this->db->set('created_date', 'NOW()', FALSE); 
		
			$this->db->insert('sup_rate_tactics', $data);
			$id = $this->db->insert_id();
		
			if(isset($cancel_policy_percent) && $cancel_policy_percent != "")
			{
				for($i=0; $i<sizeof($cancel_policy_percent); $i++)
				{
					if(strtotime($cancel_policy_from[$i]) >= strtotime($sdate) && strtotime($cancel_policy_to[$i]) <= strtotime($edate))
					{
						$ins = "INSERT INTO `sup_rate_cancel_policy` (`rate_tactics_id` ,`cancel_policy_nights` ,`cancel_policy_percent` ,`cancel_policy_charge` ,`cancel_policy_from` ,`cancel_policy_to`)
					VALUES ('".$id."', '".$cancel_policy_nights[$i]."', '".$cancel_policy_percent[$i]."', '".$cancel_policy_charge[$i]."', '".$cancel_policy_from[$i]."', '".$cancel_policy_to[$i]."')";
						$exe = $this->db->query($ins);
					}
				}
			}
			
			if(isset($minimum_stay_nights) && $minimum_stay_nights != "")
			 {
				for($i=0; $i<sizeof($minimum_stay_nights); $i++)
				{
					if(strtotime($minimum_stay_from[$i]) >= strtotime($sdate) && strtotime($minimum_stay_to[$i]) <= strtotime($edate))
					{
						$inser = "INSERT INTO `sup_rate_minimum_stay` (`rate_tactics_id` ,`minimum_stay_nights` ,`minimum_stay_from` ,`minimum_stay_to`)
					VALUES ('".$id."', '".$minimum_stay_nights[$i]."','".$minimum_stay_from[$i]."', '".$minimum_stay_to[$i]."')";
						$exestay = $this->db->query($inser);
					}
				}
			 }	
		
			if(isset($price) && $price != "")
			{
				
				for($i=0; $i<sizeof($dates); $i++)
				{
					if(strtotime($dates[$i]) >= strtotime($sdate) && strtotime($dates[$i]) <= strtotime($edate))
					{
						$day  = explode("-",$dates[$i]);
						$date = $day[2].'-'.$day[1].'-'.$day[0]; 
			
						$qry = "INSERT INTO `sup_apart_maintain_month` ( 
					`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`extra_bed_price` ,`supplementary_charge_rate` ,`available_rooms` ,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
					VALUES ( '$supplier_id', '".$id."', '".$prop_id."', '".$date."', '".$weekday[$i]."', '".$day[0]."', '".$day[1]."', '".$day[2]."', '".$price[$i]."', '".$extra_bed_price[$i]."', '".$avail_sup_charge[$i]."', '".$avail[$i]."', '', '".$avail_adult[$i]."', '".$avail_child[$i]."', '".$avail_child_price[$i]."', '".$avail_infant[$i]."', '1')";
						$query=$this->db->query($qry);
					}
				}
			}
			  
		   }
		  
		
		
		if(!empty($id)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
		
	}
}

function getDates($data)
{		echo "hello"; exit;
	
		$sds = $_REQUEST['mmsd'];
		
		$eds = $_REQUEST['mmed'];
		
		$sds = date('d-m-Y',strtotime($sds));
		$eds = date('d-m-Y',strtotime($eds));
		
		if(is_array($sds)) 
		{
		$k=0;
		for($i=0;$i<count($sds);$i++)
		{
			$sdate = explode("-",$sds[$i]);
		
		    $fromDate[$i] = $sdate[2].'/'.$sdate[1].'/'.$sdate[0];
		
		$edate = explode("-",$eds[$i]);
		
		$toDate[$i] = $edate[1].'/'.$edate[0].'/'.$edate[2];
		
		$dateMonthYearArr = array();
		$fromDateTS = strtotime($fromDate[$i]);
		$toDateTS = strtotime($toDate[$i]);
		
		
		for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (60 * 60 * 24)) 
		{
			if($_REQUEST['selectedDays'] != 'All'){
				$checkDays = date("D",$currentDateTS);
				if(in_array($checkDays, $_REQUEST['selectedDays'])) {
					$currentDateStr = date("d-m-Y D",$currentDateTS);
					$dateMonthYearArr[] = $currentDateStr;
				}
				}
			else{
				$currentDateStr = date("d-m-Y D",$currentDateTS);
				$dateMonthYearArr[] = $currentDateStr;
			}
			
		}
		$result[] = $dateMonthYearArr;
	}
	
	$counter = count($result);
	if($counter==1)  
	{
		$dates = array_merge($result[0]);
	}
	if($counter==2)  
	{
		$dates = array_merge($result[0], $result[1]);
	}
	if($counter==3)  
	{
		$dates = array_merge($result[0], $result[1], $result[2]);
	}
	if($counter==4)  
	{
		$dates = array_merge($result[0], $result[1], $result[2], $result[3]);
	}
	if($counter==5)  
	{
		$dates = array_merge($result[0], $result[1], $result[2], $result[3], $result[4]);
	}
	//print_r($dates);
	    $this->output->set_content_type('application/json');
		$this->output->set_output(json_encode(array('dates'=>$dates)));
}
else
{
			$t = date('d-m-Y',strtotime($_REQUEST['mmsd']));
	        $sds = explode("-",$t);
	        $fromDate = $sds[2].'/'.$sds[1].'/'.$sds[0];
			
	        $t1 = date('d-m-Y',strtotime($_REQUEST['mmed']));
			$eds = explode("-",$t1);
			$toDate = $eds[1].'/'.$eds[0].'/'.$eds[2];
			
			$dateMonthYearArr = array();
			$fromDateTS = strtotime($fromDate);
			$toDateTS = strtotime($toDate);
			
			for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (60 * 60 * 24))           {
			if($_REQUEST['selectedDays'] != 'All'){
				$checkDays = date("D",$currentDateTS);
				if(in_array($checkDays, $_REQUEST['selectedDays'])) {
					$currentDateStr = date("d-m-Y D",$currentDateTS);
					$dateMonthYearArr[] = $currentDateStr;
				}
				}
			else{
				$currentDateStr = date("d-m-Y D",$currentDateTS);
				$dateMonthYearArr[] = $currentDateStr;
			}
			} echo "hello"; 
			print_r($dateMonthYearArr); die;

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('dates'=>$dateMonthYearArr)));
	}
}

function getSuppliers($id='')
{		if($id==''){
		$select = "SELECT * FROM supplier";
	}else{
		$select = "SELECT * FROM supplier where supplier_id='".$id."'";
	}

		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
}

public function delete_supplier($id)	
{
	$this->db->delete('supplier', array('supplier_id' => $id)); 
	return true;
}

public function insert_supplier($data)
{
	$this->db->insert('supplier',$data);
	return true;
}

	public function get_supplier_login()
   	{
   
		$this->db->select('*')
		->from('supplier')
		->where('supplier_id',$this->session->userdata('supplier_id'))
		->where('status', 1)
		->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }	

   function update_supplier_profile( $firstname,  $email, $contact_no, $address)
	{
		
		$suppl_id = $this->session->userdata('supplier_id');	

		$data = array(
			'firstname' => $firstname,
		
			'email' => $email,
			'contact_no' => $contact_no,
			'address' => $address
			);
		
			//echo $this->db->last_query();
			
			$where = "supplier_id = '".$suppl_id."'";
		if ($this->db->update('supplier', $data, $where)) {
			return true;
		} else {
			return false;
		}

	}

	function update_supplier_password(  $password='')
	{
	
		$suppl_id = $this->session->userdata('supplier_id');

		if (!empty($password)) {
			$data['password'] = $password;	
			$where = "supplier_id = '".$suppl_id."'";
		if ($this->db->update('supplier', $data, $where)) {
			return true;
		} else {
			return false;
		}		
		}
			
		else {
			return false;
		}

	}	


//ok.....................................

	public function updateSupplier($data,$id){	
		//$country = implode(',',$data['country']);	
		//$city = implode(',',$data['city']);	
		//$hotel = implode(',',$data['hotel']);	
		
		$up = "update supplier set email = '".$data['emailid']."',password='".$data['password']."',firstname='".$data['fname']."',lastname ='".$data['lname']."',address='".$data['address']."',contact_no='".$data['mobile']."',postal_code='".$data['post_code']."',hotel_id ='".$data['hotel']."' where  supplier_id='".$id."'";
		$this->db->query($up);
	}

	public function update_room_details($data){
	$up = "update sup_inv_cate_type set no_of_rooms='".$data['no_of_rooms']."' where sup_inv_cate_type_id='".$data['sup_inv_id']."'";
	$result = $this->db->query($up);
	if($result==true){
		return true;
	}else{
		return false;
	}
}

public function get_b2b_reports_list()
{
	$suppl_id = $this->session->userdata('supplier_id');
	$this->db->select('*,booking.city as hotel_city,booking.markup as admin_markup');
	$this->db->from('booking');
	$this->db->join('b2b','b2b.agent_id = booking.user_id');
	$this->db->join('crs_hotels','crs_hotels.sup_hotel_id = booking.hotel_code');
	$this->db->where('booking.api','hotelcrs');
	$this->db->where('crs_hotels.sup_id',$suppl_id);
	$query = $this->db->get();
	if ( $query->num_rows > 0 ) {
		return $query->result();
	}
return '';
}

function get_reservation_details_id($id)
{
	$this->db->select('b.*,p.*');
	$this->db->from('booking as b');
	$this->db->join('api_permanent as p','p.hotel_code=b.hotel_code','left');
	$this->db->where('b.pnr_no',$id);
	$query = $this->db->get();	
	
	return $query->row();
}

public function get_reservation_details_crs($id)
{
	$this->db->select('b.*,crs.hotel_name as hotel_name,crs.descrip as description,crs.address as address,crs.city as city,crs.res_phone as phone,crs.res_fax as fax');
	$this->db->from('booking as b');
	$this->db->join('crs_hotels as crs','crs.sup_hotel_id=b.hotel_code','left');
	$this->db->where('b.pnr_no',$id);
	$query = $this->db->get();	
	
	return $query->row();
}

function get_agent_detail($agentid)
{
		$this->db->select('*');
		$this->db->from('b2b');
		$this->db->where('agent_id',$agentid);
		$query = $this->db->get();
		
		if($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		}
}

//ok...................................
public function fetch_country_list()
{
	$this->db->select('distinct(country_name)');
	$this->db->from('api_hotels_city');
	$this->db->order_by("country_name", "asc"); 
	$query = $this->db->get();
	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return '';
	}
}

public function fetch_city_list_by_country($country)
{
	$this->db->select('city_name');
	$this->db->from('api_hotels_city');
	$this->db->where('country_name',$country);
	$query = $this->db->get();
	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return '';
	}
}

public function fetch_suppliers_city_list_by_country($country)
{
	$this->db->select('city_name');
	$this->db->from('api_hotels_city');
	$this->db->where_in('country_name',$country);
	$query = $this->db->get();
	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return '';
	}
}

public function fetch_hotels($city)
{
	$this->db->select('hotel_name');	
	$this->db->from('hotelbeds_hotels');
	$this->db->where('city',$city);
	
	$query = $this->db->get();
	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return '';
	}
}

public function fetch_cities_hotels($city)
{
	$this->db->select('hotel_name');	
	$this->db->from('hotelbeds_hotels');
	$this->db->where_in('city',$city);
	
	$query = $this->db->get();
	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return '';
	}
}


//ok..........................

public function fetch_hotelcrs()
{
	$this->db->select('*');	
	$this->db->from('crs_hotels');
 
 	$query = $this->db->get();
	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return '';
	}
	
	}
	
	
	
public function fetch_cities_hotelcrs($city)
{
	$this->db->select('hotel_name');	
	$this->db->from('crs_hotels');
	foreach($city as $key => $value)	
	{
		$this->db->like('city',$value);
	}	
	
	$query = $this->db->get();
	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return '';
	}
}


public function add_hotel_city($city,$country)
{
	$data['city_name'] = $city;
	$data['country_name'] = $country;
	$data['city'] = $city.', '.$country;
	
	$this->db->insert('api_hotels_city', $data); 
}

public function get_city_country($city,$country)
{
	$this->db->select('city');	
	$this->db->from('api_hotels_city');
	$this->db->where('country_name',$country);
	$this->db->where('city_name',$city);
	
	$query = $this->db->get();
	
	if($query->num_rows() > 0)
	{		
		return $query->row();
	}
	else
	{
		return '';
	}
}

function add_hotel_inf($supplier_id,$star, $city, $pro_name, $main_first_name, $main_last_name, $main_email, $hotel_chain_name,$hotel_address,$main_phone,$main_fax,$hotel_desc,$nearby_attraction,$nearby_airport,$latitude,$longitude)
	{
		
		$sql="INSERT INTO crs_hotels (sup_id,star, hotel_name, city, main_first_name, main_last_name, main_email, hotel_chain_name, address, res_phone, res_fax, descrip, nearby_placeinterest, nearby_airport, latitude, longitude, status)VALUES('$supplier_id','$star', '$pro_name', '$city', '$main_first_name', '$main_last_name', '$main_email', '$hotel_chain_name','	$hotel_address','$main_phone','$main_fax','$hotel_desc',' $nearby_attraction','$nearby_airport','$latitude','$longitude', '1')"; 
	
		$this->db->set('created_date', 'NOW()', FALSE); 
		$rs=$this->db->query($sql);
		

		$last_ins_id = $this->db->insert_id();
		$wheres = "sup_hotel_id  = $last_ins_id";
		$datas = array(
		'crs_id' => 'CRS'.$last_ins_id
		);
		if ($this->db->update('crs_hotels', $datas, $wheres)) {
		
		return $last_ins_id;
		} else {
		return false;
		}
		return $last_ins_id;
	}

function view_all_hotels_suppliers()
{
	$supplier_id = $this->session->userdata('supplier_id');
	$select ="SELECT * FROM crs_hotels WHERE sup_id = '".$supplier_id."' order by sup_hotel_id desc";
	$query=$this->db->query($select);
	if($query->num_rows() ==''){
		return '';
	}
	else{
		return $query->result();
	}
}

function fetch_time_zone()
	{
		$sql="SELECT * FROM sup_apart_timezone_list";
		$rs=$this->db->query($sql);
		
		if($rs->num_rows() ==''){
			return '';
		}
		else
		{
			return $rs->result();
		}
	}

	function fetch_currency_val()
	{
		$sql="SELECT country,cur_id FROM currency_converter";
		$rs=$this->db->query($sql);
		
		if($rs->num_rows() ==''){
			return '';
		}
		else
		{
			return $rs->result();
		}
	}

	function contact_inform_edit($supplier_id,$property_id)
	{
		$sql="SELECT *
		 		FROM crs_hotels  
			  	WHERE sup_id='$supplier_id' AND sup_hotel_id='$property_id'";
		$rs=$this->db->query($sql);
		return $rs->row();
		
	}

	function contact_prop_edit($supplier_id, $property_id)
	{
		
		$sql="SELECT sup_hotel_id, sup_id, class_type_id, sup_type_apart, sup_type_hotel, group_val, latitude, longitude, address, descrip, timezone_id, star, currency_id , website, book_type, fax_confirm, email_confirm, confirm_faxno, confirm_email FROM crs_hotels WHERE sup_id= '$supplier_id' AND sup_hotel_id = '$property_id'";
		
		
		$rs=$this->db->query($sql);
		
		
		return $rs->row();
	}

	function fetch_country()
	{
		$sql="SELECT * FROM api_hotels_city";
		$rs=$this->db->query($sql);
		if($rs->num_rows() ==''){
			return '';
		}
		else
		{
			return $rs->result();
		}
		
	}

	function fetch_city_list()
	{
		$this->db->select('city,city_id');
		$this->db->from('api_hotels_city');
		$query = $this->db->get();
		
		if($query->num_rows() == '')
			return '';
		else
			return $query->result();

	}
	
	function fetch_suppliers_city_list($city,$country)
	{
		$this->db->select('city,city_id');
		$this->db->from('api_hotels_city');
		$this->db->where_in('city_name',$city);
		$this->db->where_in('country_name',$country);
		
		$query = $this->db->get();
		
		if($query->num_rows() == '')
			return '';
		else
			return $query->result();

	}

	function fetch_language()
	{
		$sql="SELECT * FROM language";
		$rs=$this->db->query($sql);
		if($rs->num_rows() ==''){
			return '';
		}
		else
		{
			return $rs->result();
		}
	}

	function fetch_home_facility($sup_prop_id)
	{
		$sql="SELECT * FROM  sup_hotel_room_facility WHERE hotel_room = '1'"; 
		$rs=$this->db->query($sql);
		if($rs->num_rows() > 0){
			return $rs->result();
		}
		else{
			return false;
		}
	}

	function fetch_room_facility($sup_prop_id)
	{
		$sql="SELECT * FROM  sup_hotel_room_facility WHERE hotel_room = '0'";
		$rs=$this->db->query($sql);
		
		if($rs->num_rows() ==''){
			return '';
		}
		else
		{
			return $rs->result();
		}
	}
	
	function get_settings_val($property_id)
	{
		$select="SELECT sup_hotel_id ,checkinfrom, checkoutfrom , checkinto, checkoutto, checkin_guest_after, checkout_guest_after, key_collection, key_collection_desc, grp_reservation, state_tax, state_totalstay_flag, state_totalstay_percent, state_fixedprice_flag, state_per_person, state_fixedprice, city_tax, city_totalstay_flag, city_totalstay_percent, city_fixedprice_flag, city_per_person, city_fixedprice, room_tax, room_totalstay_flag, room_totalstay_percent, room_fixedprice_flag, room_per_person, room_fixedprice, vat_tax, vat_totalstay_flag, vat_totalstay_percent,vat_fixedprice_flag, vat_per_person, vat_fixedprice, service_tax, service_totalstay_flag, service_totalstay_percent, service_fixedprice_flag, service_per_person, service_fixedprice, tax, service_charge FROM crs_hotels WHERE sup_hotel_id = '$property_id'";
			$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}

	function detail_location($prop_id)
	{		
		$select = "SELECT * FROM crs_hotels where sup_hotel_id = '$prop_id'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}

	function update_contact_info($data,$supplier_id,$id)
	{
		$where = "sup_id = '".$supplier_id."' AND sup_hotel_id='".$id."'";

		$rs = $this->db->update('crs_hotels',$data,$where);

		//$sql="UPDATE crs_hotels SET city = '$city', hotel_name = '$pro_name', main_first_name='$main_first_name', main_last_name='$main_last_name',main_email='$main_email',hotel_chain_name='$hotel_chain_name' WHERE sup_id='$supplier_id' AND sup_hotel_id='$id'";
		//$rs=$this->db->query($sql); 
		
		if($rs)	{
			$flg=true;
		}
		else	{
			$flg=false;
		}
		return $flg;
	}

	function delete_hotel($supplier_id,$id)
	{
		$where = "sup_hotel_id =".$id;
		$res = $this->db->delete('crs_hotels',$where);

		$where = "hotel_id = '".$id."'";
		$res = $this->db->delete('sup_apart_maintain_month',$where);
		$res = $this->db->delete('sup_hotel_capacity',$where);
		$res = $this->db->delete('sup_hotel_room_type',$where);
		$res = $this->db->delete('sup_inv_cate_type',$where);
		$res = $this->db->delete('sup_rate_tactics',$where);
		$res = $this->db->delete('sup_apart_houserules',$where);
	}	
   
   function check_supplier_exist($email)
   {
	   $this->db->select('*');
	   $this->db->from('supplier');
	   $this->db->where('email',$email);
	   $query = $this->db->get();	   
	   
	   if($query->num_rows() > 0)
	   {
		   return 1;
	   }
	   else
	   {
		   return 0;
	   }
   }
   
   function hotel_room_categories($hotel_id)
	{
		$select = "SELECT sup_hotel_room_type_id, hotel_id, hotel_room_type FROM sup_hotel_room_type where hotel_id = '".$hotel_id."' order by sup_hotel_room_type_id desc";
		$query=$this->db->query($select);
		if($query->num_rows() > 0){
			return $query->result();
		}
	}
	
	function hotel_room_types($hotel_id)
	{
		$select1 = "SELECT capacity_id, hotel_id, capacity_title, capacity, child_capacity FROM sup_hotel_capacity where hotel_id = '".$hotel_id."' order by capacity_id desc";
		$query1=$this->db->query($select1);
		if($query1->num_rows() > 0){
			return $query1->result();
		}

	}
	
}  
?>    
