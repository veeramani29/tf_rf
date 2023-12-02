<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
class Crs_Model extends CI_Model {
	
	/**
	 * Home_Model Constructor
	 *
	 * The constructor runs the Home_Model routines automatically
	 * whenever the class is instantiated.
	 */
	public function __construct()
    {	
      parent::__construct();
	  
    }
    //geting all hotellist
     public function get_all_hotel_list()
   	{   
		$query = $this->db->select('*')
				->from('sup_hotels')
		        ->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}
		
      	return false;
   }
	//to get th_hotel_details
   public function get_th_hotel_details()
   {   
		$this->db->select('Country,CityName,HotelName')
				->from('th_hotel_details')
				->order_by('Country','ASC');				
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
			
      	}
      	return false;
   }

   //to ad hotel
   function add_hotel_ad($hotel)          
	{
		 $data = array('sup_id' => $hotel['sup_id'],
	   				 'hotel_name' => $hotel['hotel_name'],	   				 
					 'city' => $hotel['city_id'],
					 'main_last_name' => $hotel['last_name'],
					 'main_first_name' => $hotel['first_name'],
					 'main_email' => $hotel['email_id'],
	   				 'address' => $hotel['hotel_address'],	   				 
					 'res_phone' => $hotel['phone'],
					 'res_fax' => $hotel['fax'],
					 'descrip' => $hotel['hotel_description'],
					 'nearby_airport' => $hotel['near_by_airport'],
	   				 'latitude' => $hotel['latitude'],	   				 
					 'longitude' => $hotel['longitude'],
					 'status' => 1,
					 'city_country_name' => $hotel['searchid']
					 );
					 
	   if($this->db->insert('sup_hotels', $data)) 
	   {
		  return true;
	   } 
	   else 
	   {
		  return false;
	   }
	}
     // to get all detail location
	function detail_location($sup_hotel_id)
	{		
		$select = "SELECT * FROM sup_hotels where sup_hotel_id = '$sup_hotel_id'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}

   //to update contact info
	public function update_contact_info($id,$sup_id,$hotel_chain_name,$city, 
            	          $main_first_name, $main_last_name,
                          $main_email, $hotel_address, 
                          $main_phone,$main_fax,$hotel_desc,
                          $nearby_airport, $latitude, $longitude,$city_name)
                         
	{
		$sql="UPDATE sup_hotels SET city = '$city', hotel_name = '$hotel_chain_name', main_first_name='$main_first_name',
		 main_last_name='$main_last_name',main_email='$main_email',res_phone='$main_phone', res_fax='$main_fax',address='$hotel_address', descrip='$hotel_desc',nearby_airport='$nearby_airport', latitude='$latitude',longitude='$longitude',city_country_name='$city_name'
		 WHERE sup_id='$sup_id' AND sup_hotel_id='$id'";
		$rs=$this->db->query($sql);
		
		if($rs)	{
			$flg=true;
		}
		else	{
			$flg=false;
		}
		return $flg;
	}

	//showing the all hotels for the supplier
	function view_all_hotels()
	{
		$select ="SELECT * FROM sup_hotels where status=1 order by sup_hotel_id desc";
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

    //to edit room type details
	function edit_room_type_details($room_data)
	{
		$str = serialize($room_data['facility_name']);
		$sql="UPDATE sup_hotel_room_type SET hotel_id='".$room_data['hotel_name']."',hotel_room_type='".$room_data['promo_code']."',hotel_room_services='".$str."',room_desc='".$room_data['discount']."'";
		$sql.=" WHERE sup_hotel_room_type_id='".$room_data['sup_hotel_room_type_id']."'";
		$res=$this->db->query($sql);
		if ($res) {
			return true;
		}else{
			return false;
		}
	}

     //to room type list
	 function room_type_list()
	{
		$select = "SELECT A.sup_hotel_room_type_id, A.hotel_id, A.hotel_room_type, A.hotel_room_services, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_hotel_room_type A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE B.sup_id = 'admin' AND B.status = '1'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}

    //to view room type
	function view_room_type($sup_hotel_room_type_id)
	{
		$select = "SELECT sup_hotel_room_type_id, hotel_id, hotel_room_type, hotel_room_services,room_desc
                        FROM sup_hotel_room_type 
                        WHERE sup_hotel_room_type_id = '".$sup_hotel_room_type_id."'"; 
		$query=$this->db->query($select);
			
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->row();
		}
	}

	//delete room category
	function delete_room_type($id){
		$sql="Delete from sup_hotel_room_type where sup_hotel_room_type_id='".$id."'";
		$res=$this->db->query($sql);
		if ($res) {
			echo 'dele';
			return true;
		}else{
			return false;
		}
	}
    
    //for capacity list
	function capacity_list()
	{

		$select = "SELECT A.capacity_id, A.hotel_id, A.capacity_title, A.capacity, A.child_capacity, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_hotel_capacity A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE B.sup_id = 'admin' AND B.status = '1'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}

	//adding room category
	function add_room_type_details($room_data)
	{
		$sql="INSERT INTO `sup_hotel_room_type` (`hotel_id`,`sup_id`, `hotel_room_type`, `hotel_room_services`,`room_desc`) VALUES ('".$room_data['hotel_name']."','".$room_data['supplier_id']."', '".$room_data['promo_code']."','".serialize($room_data['facility_name'])."','".$room_data['discount']."')";
		$res=$this->db->query($sql);
		if ($res) {
			return true;
		} else {
			return false;
		}
	}
	//admin get hotel room
	public function edit_rooms_list($sup_inv_id){
		$sel = "select * from sup_inv_cate_type where sup_id='".$this->session->userdata('admin_id')."' and sup_inv_cate_type_id='".$sup_inv_id."'";
		$result = $this->db->query($sel);
		if($result->num_rows()>0){
			return $result->result();
		}else{
		return false;
		}
	}

	//admin edit room capacity
	function edit_room_capacity_details($capacity)
	{
		$sql="UPDATE sup_hotel_capacity SET hotel_id='".$capacity['hotel_name']."',capacity_title='".$capacity['promo_code']."',capacity='".$capacity['discount']."',child_capacity='".$capacity['Child']."'";
		$sql.=" WHERE capacity_id='".$capacity['capacity_id']."'";
		$res=$this->db->query($sql);
		if ($res) {
			return true;
		} else {
			return false;
		}
	}

	//admin edit capacity room
	function view_room_capacity($capacity_id)
	{
		$select = "SELECT capacity_id, hotel_id, capacity_title, capacity, child_capacity  FROM sup_hotel_capacity WHERE capacity_id = '".$capacity_id."'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->row();
		}
	}

	//admin delete rrom capacity
	function delete_capacity($capacity_id)
	{
		$where = "capacity_id = $capacity_id";
		if ($this->db->delete('sup_hotel_capacity', $where)) {
			return true;
		} else {
			return false;
		}
	}
    
    //  to add room capacity details
	function add_room_capacity_details($hotel_name, $capacity_title, $capacity, $child_capacity,$fileimage='')
	{	
		$data = array('hotel_id'=>$hotel_name,'capacity_title'=>$capacity_title,'capacity'=>$capacity,'child_capacity'=>$child_capacity);
		
		$this->db->insert('sup_hotel_capacity',$data);
		 $this->db->last_query();
		$id = $this->db->insert_id();
		if (!empty($id)) {
			return true;
		} else {
			return false;
		}
	}
 
    //to add capacity details
	function add_capacity_details($hotel_name, $capacity_title, $capacity, $child_capacity)
	{	
		$data = array('hotel_id'=>$hotel_name,'capacity_title'=>$capacity_title,'capacity'=>$capacity,'child_capacity'=>$child_capacity);
		
		$data=$this->db->insert('sup_hotel_capacity',$data);
		if ($data) {
			return true;
		} else {
			return false;
		}
	}
    
    //to all hotel room list
	function all_hotel_room_list()
	{		
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_inv_cate_type A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
                        WHERE B.status = '1' and B.sup_id = 'admin' and A.sup_id = 'admin' order by sup_inv_cate_type_id desc"; 
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
    
    //admin delete room
	function delete_room($sup_inv_cate_type_id)
	{
		$where = "sup_inv_cate_type_id = $sup_inv_cate_type_id";
		if ($this->db->delete('sup_inv_cate_type', $where)) {
			return true;
		} else {
			return false;
		}
	}
	//admin adding  hotel room
	public function add_rooms_list($room_data){
		$data = array('sup_id'=>'admin',
						'hotel_id'=>$room_data['hotel_name'],
						'room_type'=>$room_data['room_type'],
						'no_of_rooms'=>$room_data['rooms'],
						'max_person'=>$room_data['capacity_type'],
						'status'=>'1'
				);
		$this->db->insert('sup_inv_cate_type',$data);
		$id = $this->db->insert_id();
		if (!empty($id)) {
			return true;
		} else {
			return false;
		}
	}
    
    //to house rules list
	function house_rules_list()
	{
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_apart_houserules A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
			WHERE B.sup_id = 'admin' AND B.status = '1'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
  
   //to get house rules list
	function get_house_rules($supplier_id,$prop_id)
	{	
		 $select = "SELECT * FROM sup_apart_houserules where sup_id = '$supplier_id' AND hotel_id = '$prop_id'";
		
		$query=$this->db->query($select);

		if ($query->num_rows() > 0)
		{
			return $query;
		} else {
			return false;	
		}
	}
    
    //edit hous rules
	function edit_house_rules($id,$data)
   	{
		$arrival_time=$data['arrivaltime_from'];
		$departure_time=$data['departtime_before'];
		$checkin_time1=$data['checkin_time1werwe'];
		$checkout_time1=$data['checkout_time1'];	
		$check_in_extra_cost_from=$data['check_in_extra_cost_from'];
		$check_out_extra_cost_from=$data['check_out_extra_cost_from'];
		$payment_mode=$data['payment_mode'];
		$policy = $data['policy'];
		
		$query = $this->db->query("UPDATE sup_apart_houserules SET 
		 arrivaltime_from='$arrival_time', 
		 departtime_before='$departure_time',
		 checkin_time1='$checkin_time1',
		 checkout_time1='$checkout_time1', 
		 checkin_extracost1='$check_in_extra_cost_from',
		 checkout_extracost1='$check_out_extra_cost_from', 
		 payment_mode='$payment_mode',
		 policy='$policy' WHERE sup_apart_houserules_id='$id'"); //exit;
		
		if(!empty($id)) {
			return true;
		} else {
			return false;
		}
	}
    
    //to get all get global_amenities
	public function getglobal_amenities()
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
        
        //update amenity al list
	     public function update_amenity_list($id,$status)
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

       // get all amenity details
	   function get_amenity_details($id){
		$this->db->select('*');
		$this->db->from('global_amenity_list');
		$this->db->where('amenity_list_id',$id);
		$query = $this->db->get();
			
		 if($query->num_rows() ==''){
				return '';			
			}else{
			 
			return $query->result();				
			}
	   }

    // update amenity details
	public function update_amenity_name($id, $amenity_name)
	{
     $data = array('amenity_name' => $amenity_name);
     $query=$this->db->where('amenity_list_id', $id)
                     ->update('global_amenity_list', $data);
     if(!empty($id)) {
			return true;
		} else {
			return false;
		}

	}
	//admin add amenity
	public function add_hotel_amenities($amenity_name)
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
		}else{
			return false;
		}
	}
     //to get price list
	  function price_list()
	{		
		$select = "SELECT A.*, B.status, B.hotel_name, B.hotel_chain_name, B.city
                        FROM sup_rate_tactics A 
                        INNER JOIN sup_hotels B ON B.sup_hotel_id = A.hotel_id 
						
                        WHERE B.status = '1' GROUP BY A.sup_id, A.hotel_id, A.category_type, A.room_type,A.allocation_validity_from, A.allocation_validity_to"; 
						
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	
	}

	//admin update hotel price
 	function update_rate_tactics_details($price_data)
 	{
		if (false === stripos($price_data['raFrom'], '-')) {
			$rafromda = explode("/",$price_data['raFrom']);
			$avail_date_from = $rafromda[2].'-'.$rafromda[0].'-'.$rafromda[1];
		}else{
			$avail_date_from=$price_data['raFrom'];
		}
		
		if (false === stripos($price_data['raTo'], '-')) {
			$ratoda = explode("/",$price_data['raTo']);
			$avail_date_to = $ratoda[2].'-'.$ratoda[0].'-'.$ratoda[1];
		}else{
			$avail_date_to=$price_data['raTo'];
		}
		
		if (false === stripos($price_data['cancel_policy_from'], '-')) {
			$allocationda = explode("/",$price_data['cancel_policy_from']);
			$avail_date_from1 = $allocationda[2].'-'.$allocationda[0].'-'.$allocationda[1];
		}else{
			$avail_date_from1=$price_data['cancel_policy_from'];
		}
		
		if (false === stripos($price_data['cancel_policy_to'], '-')) {
			$cancel_policy_to = explode("/",$price_data['cancel_policy_to']);
			$cancel_policy_to1 = $cancel_policy_to[2].'-'.$cancel_policy_to[0].'-'.$cancel_policy_to[1];
		}else{
			$cancel_policy_to1=$price_data['cancel_policy_to'];
		}
		$s='';
		if($price_data['sup_id']!=''){
			$s .= "sup_id='".$price_data['sup_id']."',";
		}
		if($price_data['hotel_name']!=''){
			$s .= "hotel_id='".$price_data['hotel_name']."',";
		}
		if($price_data['promo_code']!=''){
			$s .= "category_type='".$price_data['promo_code']."',";
		}
		if($price_data['roomtype']!=''){
			$s .= "room_type='".$price_data['roomtype']."',";
		}
		if($price_data['roomimage']!=''){
			$s .= "main_image='".$price_data['roomimage']."',";
		}
		if($price_data['image1']!=''){
			$s .= "image1='".$price_data['image1']."',";
		}
		if($price_data['image2']!=''){
			$s .= "image2='".$price_data['image2']."',";
		}
		if($price_data['image3']!=''){
			$s .= "image3='".$price_data['image3']."',";
		}
		if($price_data['discount']!=''){
			$s .= "child_policy='".$price_data['discount']."',";
		}
		if($price_data['cancel_policy_from']!=''){
			$s .= "allocation_validity_from='".$avail_date_from1."',";
		}
		if($price_data['cancel_policy_to']!=''){
			$s .= "allocation_validity_to='".$cancel_policy_to1."',";
		}
		if($price_data['roomsrates']!=''){
			$s .= "supplement_rate='".$price_data['roomsrates']."',";
		}
		if($price_data['raFrom']!=''){
			$s .= "room_avail_date_from='".$avail_date_from."',";
		}
		if($price_data['raTo']!=''){
			$s .= "room_avail_date_to='".$avail_date_to."',";
		}
		$s=rtrim($s,',');
		$sqldata = "update sup_rate_tactics set ".$s." where sup_rate_tactics_id ='".$price_data['sup_rate_tactics_id']."' and status=1";
		$query = $this->db->query($sqldata);
		
		if(!empty($query)) 
		{
			return true;
		}else{
			return false;
		}
	}

	 //home get hotel price
	function view_rate_tactics_details($id)
	{		
		$select = "SELECT a.*,b.* FROM sup_rate_tactics a join sup_rate_cancel_policy b ON a.sup_rate_tactics_id=b.rate_tactics_id where a.sup_rate_tactics_id = '$id'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}


	//admin delete hotel price
	function delete_price($sup_rate_tactics_id)
	{
		$where = "sup_rate_tactics_id = $sup_rate_tactics_id";
		if ($this->db->delete('sup_rate_tactics', $where)) {
			return true;
		} else {
			return false;
		}
	}
    
 	//admin getting all supplier lsit
	function supplier_list(){
		$select = "SELECT * FROM admin_info WHERE role_id = '3'";
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}

	//admin deactivate supplier
	function supplier_inactive($id){
			$data1 = array('status' => 0);
			$this->db->where('admin_id',$id);
			$this->db->update('admin_info', $data1);			
			return true;
	}

	//admin activate the supplier
	function supplier_active($id){
			$data1 = array('status' => 1);
			$this->db->where('admin_id',$id);
			$this->db->update('admin_info', $data1);			
			return true;
	}

	//admin delete the supplier
	function supplier_delete($id){
			$this->db->where('admin_id',$id);
			$this->db->delete('admin_info');			
			return true;
	}

	//admn getting all active users
	function active_supplierlist(){
		$select = "SELECT * FROM admin_info WHERE role_id='3' and status = '1'"; 
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}

	//admin adding supplier
    public function add_supplier($supplier_data)
    {
		$data = array(
			'role_id'=>3,
			'login_email' => $supplier_data['user_email'],
			'login_password' => $supplier_data['user_password'],
			'title' =>  $supplier_data['title'],
			'first_name' =>  $supplier_data['first_name'],
			'middle_name' =>  $supplier_data['middle_name'],
			'last_name' =>  $supplier_data['last_name'],
			'mobile_no' =>  $supplier_data['mobile_no'],		
			'address' =>  $supplier_data['address'],
			'pin_code' =>  $supplier_data['pin_code'],
			'city' =>  $supplier_data['city'],
			'state' =>  $supplier_data['state'],
			'country' => $supplier_data['country'],
			'status' => 1,		
		);
		$this->db->set('register_date', 'NOW()', FALSE); 
		$this->db->insert('admin_info', $data);
		$id = $this->db->insert_id();
		if(!empty($id))
		{	
			$user_no = 'VGU'.$id.rand(1000,9999);		
			$data1 = array('user_no' => $user_no);
			$this->db->where('admin_id',$id);
			$this->db->update('admin_info', $data1);			
			return true;
		}else{
			return false;
		}
	}

	//admin checking if supplier email id already exit or not
	public function check_email_availability($email)
   	{   		
		$this->db->select('*')
				->from('admin_info')
				->where('login_email',$email)
				->limit('1');
		$query = $this->db->get();

      	if($query->num_rows > 0) 
		{      
         	return $query->result();
		}else{
			return '0';
		}
	}
    
    //get all dates
	function getDates()
	{
		$sds = $_REQUEST['mmsd'];
		$eds = $_REQUEST['mmed'];
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
					}else{
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
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('dates'=>$dates)));
		}else{
				$sds = explode("-",$_REQUEST['mmsd']);
				$fromDate = $sds[2].'/'.$sds[1].'/'.$sds[0];
				$eds = explode("-",$_REQUEST['mmed']);
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
					}else{
						$currentDateStr = date("d-m-Y D",$currentDateTS);
						$dateMonthYearArr[] = $currentDateStr;
					}
				}
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('dates'=>$dateMonthYearArr)));
			}
	}
	
    //to get room type
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
			$this->output->set_output(json_encode(array('roomTypes'=>$roomTypes,'roomTypesCapacity'=>$roomTypesCapacity)));
		}
		else{
			return array();
		}
	}	
    //to add rate plan
	function add_rate_plans($supplier_id,$board_type,$prop_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3)
	{
		$counter = count($room_avail_date_from);
		for($k=0;$k < $counter;$k++)
		{
			if(is_array($room_avail_date_from))
			{
				$sdate = $room_avail_date_from[$k];
				$fromda = explode("-",$sdate);
				$avail_date_from = $fromda[2].'-'.$fromda[1].'-'.$fromda[0];
			}else{
				$sdate = $room_avail_date_from;
				$fromda = explode("-",$sdate);
				$avail_date_from = $fromda[2].'-'.$fromda[1].'-'.$fromda[0];
			}
			
			if(is_array($room_avail_date_to))
			{
				$edate = $room_avail_date_to[$k];
				$toda = explode("-",$edate);
				$avail_date_to = $toda[2].'-'.$toda[1].'-'.$toda[0];
			}else{
				$edate = $room_avail_date_to;
				$toda = explode("-",$edate);
				$avail_date_to = $toda[2].'-'.$toda[1].'-'.$toda[0];
			}
			$data = array(
				'sup_id' => $supplier_id,
				'hotel_id' => $prop_id,
				'category_type' => $room_cate,
				'room_type' => $room_type,
				'main_image'=>$fileimage,
				'image1'=>$fileimage1,
				'image2'=>$fileimage2,
				'image3'=>$fileimage3,
				'infant' => $infant[0],
				'child_policy' => $child_policy,
				'room_avail_date_from' => $avail_date_from,
				'room_avail_date_to' => $avail_date_to,
				'InclBoardTypeDesc' => $board_type,
				'status' => 1
				);
			$this->db->set('created_date', 'NOW()', FALSE); 
			$this->db->insert('sup_rate_tactics', $data);
			$id = $this->db->insert_id();
			
			
			if(isset($cancel_policy_percent[0]) && $cancel_policy_percent[0] != "")
			{
				$ins = "INSERT INTO `sup_rate_cancel_policy` (`rate_tactics_id` ,`cancel_policy_nights` ,`cancel_policy_percent` ,`cancel_policy_charge` ,`cancel_policy_from` ,`cancel_policy_to`)
					VALUES ('".$id."', '".$cancel_policy_nights[0]."', '".$cancel_policy_percent[0]."', '".$cancel_policy_charge[0]."', '".$cancel_policy_from."', '".$cancel_policy_to."')";
				$exe = $this->db->query($ins);
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
						`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`extra_bed_price` ,`available_rooms` ,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
						VALUES ( '$supplier_id', '".$id."', '".$prop_id."', '".$date."', '".$weekday[$i]."', '".$day[0]."', '".$day[1]."', '".$day[2]."', '".$price[$i]."', '".$extra_bed_price[$i]."','".$avail[$i]."', '', '".$aadult[$i]."', '".$achild[$i]."', '".$child_price[$i]."', '".$infant[$i]."', '1')";
							$query=$this->db->query($qry);
					}
				}
			}
		}
		$sql="SELECT no_of_rooms FROM sup_inv_cate_type 
				WHERE room_type='".$room_cate."' 
				AND max_person='".$room_type."'";
		$res=mysql_query($sql);
		$val=mysql_fetch_array($res);
		$count=$val['no_of_rooms']-$avail[0];

		$upd="UPDATE sup_inv_cate_type SET no_of_rooms='".$count."'
				WHERE room_type='".$room_cate."' 
				AND max_person='".$room_type."'";
				$this->db->query($upd);

		if(!empty($id)) 
		{
			return true;
		}else{
			return false;
		}
 	}
	
	//for get avail dates
	function getAvailDates()
	{
		if(isset($_REQUEST['da']) && $_REQUEST['da'] != '')
		{
			echo 'hi';exit;
			$sds = $_REQUEST['mmsd'];
			$eds = $_REQUEST['mmed'];
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
							}else{
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
					$this->output->set_content_type('application/json');
					$this->output->set_output(json_encode(array('dates'=>$dates)));
			}else{
				$sds = explode("-",$_REQUEST['mmsd']);
				$fromDate = $sds[2].'/'.$sds[1].'/'.$sds[0];
				$eds = explode("-",$_REQUEST['mmed']);
				$toDate = $eds[1].'/'.$eds[0].'/'.$eds[2];
				$dateMonthYearArr = array();
				$fromDateTS = strtotime($fromDate);
				$toDateTS = strtotime($toDate);
				for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (60 * 60 * 24)){
					if($_REQUEST['selectedDays'] != 'All'){
						$checkDays = date("D",$currentDateTS);
						if(in_array($checkDays, $_REQUEST['selectedDays'])) {
							$currentDateStr = date("d-m-Y D",$currentDateTS);
							$dateMonthYearArr[] = $currentDateStr;
						}
					}else{
							$currentDateStr = date("d-m-Y D",$currentDateTS);
							$dateMonthYearArr[] = $currentDateStr;
					}
				}
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('dates'=>$dateMonthYearArr)));
			}			
		}else{
			$select = "SELECT * FROM sup_apart_maintain_month where sup_rate_tactics_id = ".$_REQUEST['rate_id']." ORDER BY date ASC"; 
			$query	= $this->db->query($select); 
			if ($query->num_rows() > 0){
				$avail_dates = $query->result();
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('avail_dates'=>$avail_dates)));
			}
		}
	}

    //for edit rate plan
	function edit_rate_plan($fileimage,$fileimage1,$fileimage2,$fileimage3,$supplier_id, $cancellation_policy, $prop_id, $id, $room_cate, $room_type,$allocation_release_days,$room_avail_date_from, $room_avail_date_to, $avail_dates, $avail_weekday, $avail_price,$extra_bed_price, $avail_rooms, $avail_adult, $avail_child, $avail_child_price, $avail_infant,$child_policy)
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
			$child_policy = addslashes($child_policy);
			if($k==0) 
			  {
				  $select="UPDATE sup_rate_tactics 
								SET category_type='$room_cate',
									room_type='$room_type',
									child_policy='$child_policy', 
									cancel_policy_desc='$cancellation_policy',
									room_avail_date_from='$avail_date_from', 
									room_avail_date_to='$avail_date_to'";
									

									if($fileimage!='' && $fileimage1!='' && $fileimage2!='' && $fileimage3!=''){
					$select.=", main_image='".$fileimage."',image1='".$fileimage1."',image2='".$fileimage2."',image3='".$fileimage3."'";
				}
								$select.=" WHERE sup_rate_tactics_id='$id'";
				$this->db->query($select);
				if($k==0){
					
					$sqldata = "update sup_rate_cancel_policy set ".$s." where rate_tactics_id ='".$price_data['sup_rate_tactics_id']."' and status=1";
					$query = $this->db->query($sqldata);	
					
				}
				$delqrys = "DELETE FROM sup_rate_cancel_policy WHERE rate_tactics_id = ".$id.""; 
				$exequery= $this->db->query($delqrys);	
				 
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
					for($i=0; $i<sizeof($dates); $i++)
					{
						if(strtotime($dates[$i]) >= strtotime($sdate) && strtotime($dates[$i]) <= strtotime($edate))
						{
							$day  = explode("-",$dates[$i]);
							$date = $day[2].'-'.$day[1].'-'.$day[0];
				
							$qry = "INSERT INTO `sup_apart_maintain_month` ( 
						`sup_id` ,`sup_rate_tactics_id` ,`hotel_id` ,`date` ,`week_day` ,`day` ,`month` ,`year` ,`rate` ,`extra_bed_price` ,`available_rooms` ,`capacity` ,`adult` ,`child` ,`child_charge` ,`infant` ,`status`)
						VALUES ( '$supplier_id', '".$id."', '".$prop_id."', '".$dates[$i]."', '".$weekday[$i]."', '".$day[2]."', '".$day[1]."', '".$day[0]."', '".$price[$i]."', '".$extra_bed_price[$i]."','".$avail[$i]."', '', '".$adults[$i]."', '".$childs[$i]."', '".$avail_child_price[$i]."', '".$avail_infant[$i]."', '1')";
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
			}else{		   
			  $data = array(
				'sup_id' => $supplier_id,
				'hotel_id' => $prop_id,
				'category_type' => $category_name,
				'adult' => $adult,
				'child' => $child,
				'infant' => $no_of_infants,
				'child_policy' => $child_policy,
				'remarks' => $remarks,
				'room_avail_date_from' => $avail_date_from,
				'room_avail_date_to' => $avail_date_to,
				'supplement_rate' => $supplement_rate,
				'status' => 1
				);
				$this->db->set('created_date', 'NOW()', FALSE); 
				$this->db->insert('sup_rate_tactics', $data);
				$id = $this->db->insert_id();
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

    //to get all city list
	public function get_all_city_list()
   	{   
		$this->db->select('*')
				->from('th_cities');
		$query = $this->db->get();
        $cities['Select'] = 'Select';
      	foreach ($query->result() as $rows) {
      		$cities[$rows->city_name.',' .$rows->country_name] = $rows->city_name.',' .$rows->country_name;
      	}
      	return $cities;
   }
   //get all cities
   function all_cites($id){
	$select="SELECT * FROM `th_cities` WHERE city_name LIKE '%".$id."%' limit 5";
	$query=$this->db->query($select);
	if($query->num_rows() ==''){
		return '';
	}else{
		return $query->result();
	}
   }
   
   //update hotel status
   function update_hotel_status($id,$status)
	{
		if($status == 2)
		{
			$where2 = "sup_hotel_id = $id";
			if ($this->db->delete('sup_hotels', $where2)) {
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
			if ($this->db->update('sup_hotels', $data, $where)) {
				return true;
			} else {
				return false;
			}
		}
	}
    
    //to get global amenities
	public function get_global_amenities()
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

	   public function get_country_list()
   	{   
		$this->db->select('*')
				->from('country');
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}
		
      	return false;
   }
}

/* End of file home_model.php */
/* Location: ./admin/models/home_model.php */
