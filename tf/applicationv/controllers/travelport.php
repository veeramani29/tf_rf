<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APP_BASE_PATH.'/application/controllers/flights.php';

class Travelport extends MX_Controller {
	
	//Universal API Credentials
	private $sess_id;
	private $username;
	private $password;	
	private $api;
	private $post_url;	
	private $mode;
	private $targetBranch;	
	
	//Universal API Variables
	private $fromCity;
	private $toCity;
	private $fromCityCode;
	private $toCityCode;
	private $tripType;
	private $departDate;
	private $departTime;
	private $returnDate;
	private $returnTime;
	private $adults;
	private $childs;
	private $infants;
	private $cabinClass;
    	
	//Markup Variables
	private $adminMarkup;
	private $agentMarkup;
	private $paymentCharge;
	
	
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Travelport_Model');
		$this->load->model('Account_Model');
		$this->load->model('Agent_Account_Model');
	
		if($this->session->userdata('session_id') == '') 		           
                    redirect('home/index', 'refresh');      
		
		$this->sess_id = $this->session->userdata('session_id');
		
		
		$this->set_credentials();	
		
	}
	
	public function index()
	{
		$this->load->view('home/index');
	}
		
	public function set_credentials()
	{
		$this->api 			= 'travelport';
		$this->targetBranch	 	= 'P7025462';
		$this->username 		= 'Universal API/uAPI3089026605-ee9b355b';
		$this->password 		= '7Fz{}j5Kn9';
		$this->mode 			= 0;
		if($this->mode == 0)
			$this->post_url = 'https://apac.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/AirService';
		else
			$this->post_url = 'https://apac.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/AirService';			
		
	}
	
	public function set_variables()
	{
		//echo '<pre/>';print_r($this->session->userdata('flight_search_data'));exit;
		$session_data = $this->session->userdata('flight_search_data');		
	
		$this->tripType 	= $session_data['tripType'];
		$this->fromCity 	= $session_data['fromCity'];
		$this->toCity 		= $session_data['toCity'];
		$this->fromCityCode = $this->getAirportCode($session_data['fromCity']);
		$this->toCityCode 	= $this->getAirportCode($session_data['toCity']);
		$this->departDate 	= date('Y-m-d',strtotime($session_data['departDate']));
		$this->departTime 	= '00:00:00';
		$this->returnDate 	= date('Y-m-d',strtotime($session_data['returnDate']));
		$this->returnTime 	= '00:00:00';
		$this->adults 		= $session_data['adults'];
		$this->childs 		= $session_data['childs'];
		$this->infants 		= $session_data['infants'];
		$this->cabinClass 	= $session_data['cabinClass'];         
						
	}
	
	public function set_multisearch_variables()
	{
		$session_data = $this->session->userdata('flight_search_data');		
                
		$this->tripType 	= $session_data['tripType'];
		$this->fromCity 	= $session_data['fromCity'];
		$this->toCity 		= $session_data['toCity'];		
		$this->departDate 	= $session_data['departDate'];
		$this->departTime 	= '00:00:00';
				
		$this->adults 		= $session_data['adults'];
		$this->childs 		= $session_data['childs'];
		$this->infants 		= $session_data['infants'];
		$this->cabinClass 	= $session_data['cabinClass'];
		
		
						
	}
		
	public function setup_markup()
	{	
		$session_data = $this->session->userdata('flight_search_data');
		if($session_data['fromCity']) {
			if(count($session_data['fromCity'])>1){
				list($airport,$countryn) = explode('-',$session_data['fromCity'][0]);
			}else{
				list($airport,$countryn) = explode('-',$session_data['fromCity']);
			}
			
			if($countryn){
				list($country,$airport_code) = explode(',', $countryn);
			}
			
		}
		$b2b_id = $this->session->userdata('b2b_id');
		if(!$b2b_id){
			
			$result = $this->Account_Model->getMarkupB2c($country,'travelport');
			if($result){
				 if($result->markup){ 			
					$this->adminMarkup	= $result->markup;
				}
			}else{
				$this->adminMarkup	= 0;
			}
			$this->agentMarkup 	= 0;
			$this->paymentCharge = 0;	
		}else{
			$result = $this->Account_Model->getMarkupB2b($country,'travelport',$b2b_id);
			$agent_markup = $this->Agent_Account_Model->getUserInfo($b2b_id)->row();
			if($result){
				if($result->markup){			
					$this->adminMarkup	= $result->markup;
				}
			}else{
				$this->adminMarkup	= 0;
			}
			if($agent_markup){
				if($agent_markup->my_markup){
					$this->agentMarkup 	= $agent_markup->my_markup;
				}
			}else{
				$this->agentMarkup = 0;
			}
			
			$this->paymentCharge = 0;
		}
	}
	
	public function flights_searchRQ()
	{		
		$this->set_variables();	
		$this->setup_markup();	
		
		// Getting Flight Search Results from database
		if($this->session->userdata('flight_search_activate') == 1)
		{
			$this->fetch_flight_search_results();
		}
		else
		{		 
			$this->load->library('xml_to_array');	
								
			$AirLowFareSearchRS = $this->AirLowFareSearchRQ();
			//echo '<pre/>';print_r($AirLowFareSearchRS);exit;
			$AirLowFareSearchRS_arr = $this->xml_to_array->XmlToArray($AirLowFareSearchRS);		
			//echo '<pre/>';print_r($AirLowFareSearchRS_arr);exit;			
			
			if(isset($AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['air:FlightDetailsList']))
			{
				$CurrencyType = $AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['@attributes']['CurrencyType'];

				//$Route = $AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['air:RouteList']['air:Route'];
				
				$FlightDetails = $AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['air:FlightDetailsList']['air:FlightDetails'];
				$AirSegment = $AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['air:AirSegmentList']['air:AirSegment'];
								
				$AirPricingSolution = $AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['air:AirPricingSolution'];
				
				$lp = 0;$insertFlightsData = array();
				for($i=0;$i< count($AirPricingSolution);$i++)
				{			
					$AirPricingSolution_attr = $AirPricingSolution[$i]['@attributes'];
					$AirPricingSolution_Key = $AirPricingSolution_attr['Key'];
					
					$TotalPrice = $AirPricingSolution_attr['TotalPrice'];
					
					$TotalPriceMarkup = (float)substr($TotalPrice,3);
					
					if($this->adminMarkup){
					  	$TotalPriceAdminMarkup = $TotalPriceMarkup+($TotalPriceMarkup*$this->adminMarkup/100);
					}else{
						$TotalPriceAdminMarkup = $TotalPriceMarkup;
					} 
					if($this->agentMarkup){
					  	$TotalPriceAdminAgentMarkup = $TotalPriceAdminMarkup+($TotalPriceAdminMarkup*$this->agentMarkup/100);
					}else{
					  	$TotalPriceAdminAgentMarkup = $TotalPriceAdminMarkup;
					}	

					
					if(isset($AirPricingSolution_attr['EquivalentBasePrice']))
						$BasePrice = $AirPricingSolution_attr['EquivalentBasePrice'];
					else
					    $BasePrice = $AirPricingSolution_attr['ApproximateBasePrice'];
					    
					$Taxes = $AirPricingSolution_attr['Taxes'];
					
					$Journey = $AirPricingSolution[$i]['air:Journey'];	
					
					$AirPricingInfo = $AirPricingSolution[$i]['air:AirPricingInfo'];
					
					if(isset($AirPricingInfo[0])) 
					{
						$AirPricingInfo_attr = $AirPricingInfo[0]['@attributes'];
						if(isset($AirPricingInfo_attr['PlatingCarrier']))
							$PlatingCarrier = $AirPricingInfo_attr['PlatingCarrier'];
						else
							$PlatingCarrier = '';
						
						if(isset($AirPricingInfo_attr['Refundable']))
							$Refundable = $AirPricingInfo_attr['Refundable'];
						else
							$Refundable = 'false';
						
						$Pass_BasePrice_arr = $Pass_Taxes_arr = array();	
						for($p=0;$p<count($AirPricingInfo);$p++)
						{
							//$Pass_BasePrice_arr[] = $AirPricingInfo[$p]['@attributes']['EquivalentBasePrice'];
							if(isset($AirPricingInfo[$p]['@attributes']['EquivalentBasePrice']))
								$Pass_BasePrice_arr[] = $AirPricingInfo[$p]['@attributes']['EquivalentBasePrice'];
							else
								$Pass_BasePrice_arr[] = $AirPricingInfo[$p]['@attributes']['ApproximateBasePrice'];
								
							$Pass_Taxes_arr[] = $AirPricingInfo[$p]['@attributes']['Taxes'];
						}
						
						$Pass_BasePrice = implode(',',$Pass_BasePrice_arr);
						$Pass_Taxes = implode(',',$Pass_Taxes_arr);
						
						$BookingInfo = $AirPricingInfo[0]['air:BookingInfo'];	
					}
					else
					{
						$AirPricingInfo_attr = $AirPricingInfo['@attributes'];
						if(isset($AirPricingInfo_attr['PlatingCarrier']))
							$PlatingCarrier = $AirPricingInfo_attr['PlatingCarrier'];
						else 
							$PlatingCarrier = '';
							
						if(isset($AirPricingInfo_attr['Refundable']))
							$Refundable = $AirPricingInfo_attr['Refundable'];
						else
							$Refundable = 'false';						
						
						//$Pass_BasePrice = $AirPricingInfo_attr['BasePrice'];
						if(isset($AirPricingInfo_attr['EquivalentBasePrice']))
							$Pass_BasePrice = $AirPricingInfo_attr['EquivalentBasePrice'];
						else
							$Pass_BasePrice = $AirPricingInfo_attr['ApproximateBasePrice'];
							
						$Pass_Taxes = $AirPricingInfo_attr['Taxes'];
						
						$BookingInfo = $AirPricingInfo['air:BookingInfo'];	
					}
					
					if($Refundable == 'true')
						$FareType = 'Refundable';
					else
						$FareType = 'Non Refundable';
					
					if(isset($Journey[0])) 
					{
						echo 'hi';
                        $bin = 0;
						for($b=0;$b<count($Journey);$b++)
						{ 
							if($b == 0)
								$mode = 'onward';
							else
								$mode = 'return';
                                                        
							$Journey_attr = $Journey[$b]['@attributes'];
							$Total_Duration = $Journey_attr['TravelTime'];
							
							$Stops = 0;
							$AirSegmentRef = $Journey[$b]['air:AirSegmentRef'];
							if(isset($AirSegmentRef[0]))
							{								
								for($j=0;$j< count($AirSegmentRef);$j++)
								{
									$AirSegmentRef_attr = $AirSegmentRef[$j]['@attributes'];									
									$AirSegmentRef_Key = $AirSegmentRef_attr['Key'];
									
									for($k=0;$k< count($AirSegment);$k++)
									{
										$AirSegment_attr =  $AirSegment[$k]['@attributes'];										
										$AirSegment_Key = $AirSegment_attr['Key'];
										
										if($AirSegment_Key == $AirSegmentRef_Key)	
										{
											$Group = $AirSegment_attr['Group'];									
											$Carrier = $AirSegment_attr['Carrier'];
											$FlightNumber = $AirSegment_attr['FlightNumber'];
											$Origin = $AirSegment_attr['Origin'];
											$Destination = $AirSegment_attr['Destination'];
											$DepartureTime = $AirSegment_attr['DepartureTime'];
											$ArrivalTime = $AirSegment_attr['ArrivalTime'];
											$FlightTime = $AirSegment_attr['FlightTime'];
											$Distance = $AirSegment_attr['Distance'];
											$ETicketability = $AirSegment_attr['ETicketability'];
											$Equipment = $AirSegment_attr['Equipment'];
											$ChangeOfPlane = $AirSegment_attr['ChangeOfPlane'];
											$ParticipantLevel = $AirSegment_attr['ParticipantLevel'];
											
											$LinkAvailability = '';
											if(isset($AirSegment_attr['LinkAvailability']))
												$LinkAvailability = $AirSegment_attr['LinkAvailability'];
												
											$PolledAvailabilityOption = $AirSegment_attr['PolledAvailabilityOption'];
											$OptionalServicesIndicator = $AirSegment_attr['OptionalServicesIndicator'];		
											
											$AvailabilitySource = '';
											if(isset( $AirSegment_attr['AvailabilitySource']))	
												$AvailabilitySource = $AirSegment_attr['AvailabilitySource'];
											
											if(isset($AirSegment[$k]['air:CodeshareInfo']) && is_array($AirSegment[$k]['air:CodeshareInfo'])) 
											{
												$CodeshareInfo_attr =  $AirSegment[$k]['air:CodeshareInfo']['@attributes'];	
												$OperatingCarrier = $CodeshareInfo_attr['OperatingCarrier'];	
																							
												$OperatingFlightNumber = '';
												if(isset($CodeshareInfo_attr['OperatingFlightNumber']))	
													$OperatingFlightNumber = $CodeshareInfo_attr['OperatingFlightNumber'];		
											}
											else if(isset($AirSegment[$k]['air:CodeshareInfo']))
											{
												$OperatingCarrier = $AirSegment[$k]['air:CodeshareInfo'];
												$OperatingFlightNumber = '';
											}
											else
											{
												$OperatingCarrier = '';
												$OperatingFlightNumber = '';
											}
											
											$ProviderCode = '';$BookingCounts = '';
											if(isset($AirSegment[$k]['air:AirAvailInfo'])) 
											{
												$ProviderCode = $AirSegment[$k]['air:AirAvailInfo']['@attributes']['ProviderCode'];
												$BookingCodeInfo_attr =  $AirSegment[$k]['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
												$BookingCounts = $BookingCodeInfo_attr['BookingCounts'];											
											}
											  if(isset($AirSegment[$k]['air:FlightDetailsRef']['@attributes'])){
											$FlightDetailsRef_Key =  $AirSegment[$k]['air:FlightDetailsRef']['@attributes']['Key'];	
											} else {
                                                                                            $FlightDetailsRef_Key='';
                                                                                         }
											for($l=0;$l< count($FlightDetails);$l++)
											{
												$FlightDetails_attr =  $FlightDetails[$l]['@attributes'];										
												$FlightDetails_Key = $FlightDetails_attr['Key'];
												
												if($FlightDetails_Key == $FlightDetailsRef_Key)	
												{
													//$Equipment = $FlightDetails_attr['Equipment'];													
													$OriginTerminal = '';$DestinationTerminal = '';
													if(isset($FlightDetails_attr['OriginTerminal']))
														$OriginTerminal = $FlightDetails_attr['OriginTerminal'];
													if(isset($FlightDetails_attr['DestinationTerminal']))
														$DestinationTerminal = $FlightDetails_attr['DestinationTerminal'];	
																										
													break;
												}
												
											}
											
											break;
											
										}
										
									}
									
									$BookingInfo_attr = $BookingInfo[$bin]['@attributes'];	
									
									$BookingCode = $BookingInfo_attr['BookingCode'];
									$CabinClass = $BookingInfo_attr['CabinClass'];
									$FareInfoRef = $BookingInfo_attr['FareInfoRef'];
																	
									$insertFlightsData[$lp] = array('session_id' => $this->sess_id, 
															  'AirPricingSolution_Key' => $AirPricingSolution_Key, 
															  'api' => $this->api,					  
															  'CurrencyType' => $CurrencyType, 
															  'TotalPrice' => $TotalPrice, 
															  'TotalPriceMarkup' => $TotalPriceAdminAgentMarkup,
															  'TotalPriceAdminMarkup' => $TotalPriceAdminMarkup,
															  'BasePrice' => $BasePrice, 
															  'TaxPrice' => $Taxes, 
															  'Adults' => $this->adults, 
															  'Childs' => $this->childs, 
															  'Infants' => $this->infants,
															  'BasePrice_Breakdown' => $Pass_BasePrice, 
															  'TaxPrice_Breakdown' => $Pass_Taxes, 
															  'FareType' => $FareType, 
															  'Total_Duration' => $Total_Duration, 
															  'AirSegment_Key' => $AirSegment_Key,						  
															  'Group' => $Group, 
															  'Carrier' => $Carrier,
															  'FlightNumber' => $FlightNumber,
															  'DepartureCode' => $Origin,
															  'ArrivalCode' => $Destination,
															  'DepartureDateTime' => $DepartureTime,					   
															  'ArrivalDateTime' => $ArrivalTime, 
															  'FlightTime' => $FlightTime,					 
															  'Distance' => $Distance,			  
															  'ETicketability' => $ETicketability, 				 
															  'Equipment' => $Equipment, 
															  'ChangeOfPlane' => $ChangeOfPlane, 
															  'ParticipantLevel' => $ParticipantLevel, 
															  'Stops' => $Stops, 
															  'LinkAvailability' => $LinkAvailability,
															  'PolledAvailabilityOption' => $PolledAvailabilityOption,
															  'OptionalServicesIndicator' => $OptionalServicesIndicator,
															  'AvailabilitySource' => $AvailabilitySource, 
															  'OperatingCarrier' => $OperatingCarrier, 
															  'OperatingFlightNumber' => $OperatingFlightNumber,	
															  'ProviderCode' => $ProviderCode, 
															  'BookingCounts' => $BookingCounts,					  
															  'FlightDetails_Key' => $FlightDetails_Key,					 
															  'OriginTerminal' => $OriginTerminal, 
															  'DestinationTerminal' => $DestinationTerminal,
															  'BookingCode' => $BookingCode,					 
															  'CabinClass' => $CabinClass, 
															  'FareInfoRef' => $FareInfoRef,
															  'PlatingCarrier' => $PlatingCarrier,
															  'Trip_Type' => $this->tripType,	
                                                               'Mode' => $mode,
															  'Admin_Markup' => $this->adminMarkup,
															   'Agent_Markup' => $this->agentMarkup,
															  'Payment_Charge' => ''
															);	
											
											$lp++;
									
									
									$Stops++;
                                                                        
                                    $bin++;
									
								}		
								
							}
							else
							{
								$AirSegmentRef_attr 	= $AirSegmentRef['@attributes'];
								$AirSegmentRef_Key 		= $AirSegmentRef_attr['Key'];	
								
								for($k=0;$k< count($AirSegment);$k++)
								{
									$AirSegment_attr =  $AirSegment[$k]['@attributes'];										
									$AirSegment_Key = $AirSegment_attr['Key'];
									
									if($AirSegment_Key == $AirSegmentRef_Key)	
									{
										$Group = $AirSegment_attr['Group'];									
										$Carrier = $AirSegment_attr['Carrier'];
										$FlightNumber = $AirSegment_attr['FlightNumber'];
										$Origin = $AirSegment_attr['Origin'];
										$Destination = $AirSegment_attr['Destination'];
										$DepartureTime = $AirSegment_attr['DepartureTime'];
										$ArrivalTime = $AirSegment_attr['ArrivalTime'];
										$FlightTime = $AirSegment_attr['FlightTime'];
										$Distance = $AirSegment_attr['Distance'];
										$ETicketability = $AirSegment_attr['ETicketability'];
										$Equipment = $AirSegment_attr['Equipment'];
										$ChangeOfPlane = $AirSegment_attr['ChangeOfPlane'];
										$ParticipantLevel = $AirSegment_attr['ParticipantLevel'];
										
										$LinkAvailability = '';
										if(isset($AirSegment_attr['LinkAvailability']))
											$LinkAvailability = $AirSegment_attr['LinkAvailability'];
												
										$PolledAvailabilityOption = $AirSegment_attr['PolledAvailabilityOption'];
										$OptionalServicesIndicator = $AirSegment_attr['OptionalServicesIndicator'];		
										
										$AvailabilitySource = '';
										if(isset( $AirSegment_attr['AvailabilitySource']))	
											$AvailabilitySource = $AirSegment_attr['AvailabilitySource'];
										                                                                               
										if(isset($AirSegment[$k]['air:CodeshareInfo']) && is_array($AirSegment[$k]['air:CodeshareInfo'])) 
										{
												$CodeshareInfo_attr =  $AirSegment[$k]['air:CodeshareInfo']['@attributes'];	
												$OperatingCarrier = $CodeshareInfo_attr['OperatingCarrier'];	

												$OperatingFlightNumber = '';
												if(isset($CodeshareInfo_attr['OperatingFlightNumber']))	
														$OperatingFlightNumber = $CodeshareInfo_attr['OperatingFlightNumber'];		
										}
										else if(isset($AirSegment[$k]['air:CodeshareInfo']))
										{
												$OperatingCarrier = $AirSegment[$k]['air:CodeshareInfo'];
												$OperatingFlightNumber = '';
										}
										else
										{
											$OperatingCarrier = '';
											$OperatingFlightNumber = '';
										}
										
										$ProviderCode = '';$BookingCounts = '';
										if(isset($AirSegment[$k]['air:AirAvailInfo'])) 
										{
											$ProviderCode = $AirSegment[$k]['air:AirAvailInfo']['@attributes']['ProviderCode'];
											$BookingCodeInfo_attr =  $AirSegment[$k]['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
											$BookingCounts = $BookingCodeInfo_attr['BookingCounts'];											
										}
										
                                                                                 if(isset($AirSegment[$k]['air:FlightDetailsRef']['@attributes'])){
										$FlightDetailsRef_Key =  $AirSegment[$k]['air:FlightDetailsRef']['@attributes']['Key'];	
										}else{
                                                                                      $FlightDetailsRef_Key ='';
                                                                                       }
										for($l=0;$l< count($FlightDetails);$l++)
										{
											$FlightDetails_attr =  $FlightDetails[$l]['@attributes'];										
											$FlightDetails_Key = $FlightDetails_attr['Key'];
											
											if($FlightDetails_Key == $FlightDetailsRef_Key)	
											{
												//$Equipment = $FlightDetails_attr['Equipment'];													
												$OriginTerminal = '';$DestinationTerminal = '';
												if(isset($FlightDetails_attr['OriginTerminal']))
													$OriginTerminal = $FlightDetails_attr['OriginTerminal'];
												if(isset($FlightDetails_attr['DestinationTerminal']))
													$DestinationTerminal = $FlightDetails_attr['DestinationTerminal'];	
																									
												break;
											}
											
										}
										
										break;
										
									}
									
								}	
								
                                                                if(isset($BookingInfo[$bin]))
                                                                    $BookingInfo_attr = $BookingInfo[$bin]['@attributes'];
                                                                else
                                                                    $BookingInfo_attr = $BookingInfo['@attributes'];
									
								$BookingCode = $BookingInfo_attr['BookingCode'];
								$CabinClass = $BookingInfo_attr['CabinClass'];
								$FareInfoRef = $BookingInfo_attr['FareInfoRef'];
								
								$insertFlightsData[$lp] = array('session_id' => $this->sess_id, 
															  'AirPricingSolution_Key' => $AirPricingSolution_Key, 
															  'api' => $this->api,					  
															  'CurrencyType' => $CurrencyType, 
															  'TotalPrice' => $TotalPrice,
															  'TotalPriceMarkup' => $TotalPriceAdminAgentMarkup,
															  'TotalPriceAdminMarkup' => $TotalPriceAdminMarkup,
															  'BasePrice' => $BasePrice, 
															  'TaxPrice' => $Taxes, 
															  'Adults' => $this->adults, 
															  'Childs' => $this->childs, 
															  'Infants' => $this->infants,
															  'BasePrice_Breakdown' => $Pass_BasePrice, 
															  'TaxPrice_Breakdown' => $Pass_Taxes, 
															  'FareType' => $FareType,
															  'Total_Duration' => $Total_Duration, 
															  'AirSegment_Key' => $AirSegment_Key,						  
															  'Group' => $Group, 
															  'Carrier' => $Carrier,
															  'FlightNumber' => $FlightNumber,
															  'DepartureCode' => $Origin,
															  'ArrivalCode' => $Destination,
															  'DepartureDateTime' => $DepartureTime,					   
															  'ArrivalDateTime' => $ArrivalTime, 
															  'FlightTime' => $FlightTime,					 
															  'Distance' => $Distance,			  
															  'ETicketability' => $ETicketability, 				 
															  'Equipment' => $Equipment, 
															  'ChangeOfPlane' => $ChangeOfPlane, 
															  'ParticipantLevel' => $ParticipantLevel, 
															  'Stops' => $Stops, 
															  'LinkAvailability' => $LinkAvailability,
															  'PolledAvailabilityOption' => $PolledAvailabilityOption,
															  'OptionalServicesIndicator' => $OptionalServicesIndicator,
															  'AvailabilitySource' => $AvailabilitySource, 
															  'OperatingCarrier' => $OperatingCarrier, 
															  'OperatingFlightNumber' => $OperatingFlightNumber,
															  'ProviderCode' => $ProviderCode, 
															  'BookingCounts' => $BookingCounts,					  
															  'FlightDetails_Key' => $FlightDetails_Key,					 
															  'OriginTerminal' => $OriginTerminal, 
															  'DestinationTerminal' => $DestinationTerminal,
															  'BookingCode' => $BookingCode,					 
															  'CabinClass' => $CabinClass, 
															  'FareInfoRef' => $FareInfoRef,
															  'PlatingCarrier' => $PlatingCarrier,
															  'Trip_Type' => $this->tripType,	
                                                              'Mode' => $mode,
															  'Admin_Markup' => $this->adminMarkup,
															  'Agent_Markup' => $this->agentMarkup,
															  'Payment_Charge' => ''
															);	
											
											$lp++;	
                                                                                        
                                                               $bin++;
								
							}
					
						}								
						
					}
					else
					{								
						$Journey_attr = $Journey['@attributes'];
						$Total_Duration = $Journey_attr['TravelTime'];
						
						$Stops = 0;
						$AirSegmentRef = $Journey['air:AirSegmentRef'];
						if(isset($AirSegmentRef[0]))
						{								
							for($j=0;$j< count($AirSegmentRef);$j++)
							{
								$AirSegmentRef_attr = $AirSegmentRef[$j]['@attributes'];									
								$AirSegmentRef_Key = $AirSegmentRef_attr['Key'];
								
								for($k=0;$k< count($AirSegment);$k++)
								{
									$AirSegment_attr =  $AirSegment[$k]['@attributes'];										
									$AirSegment_Key = $AirSegment_attr['Key'];
									
									if($AirSegment_Key == $AirSegmentRef_Key)	
									{
										$Group = $AirSegment_attr['Group'];									
										$Carrier = $AirSegment_attr['Carrier'];
										$FlightNumber = $AirSegment_attr['FlightNumber'];
										$Origin = $AirSegment_attr['Origin'];
										$Destination = $AirSegment_attr['Destination'];
										$DepartureTime = $AirSegment_attr['DepartureTime'];
										$ArrivalTime = $AirSegment_attr['ArrivalTime'];
										$FlightTime = $AirSegment_attr['FlightTime'];
										$Distance = $AirSegment_attr['Distance'];
										$ETicketability = $AirSegment_attr['ETicketability'];
										$Equipment = $AirSegment_attr['Equipment'];
										$ChangeOfPlane = $AirSegment_attr['ChangeOfPlane'];
										$ParticipantLevel = $AirSegment_attr['ParticipantLevel'];
										
										$LinkAvailability = '';
										if(isset($AirSegment_attr['LinkAvailability']))
											$LinkAvailability = $AirSegment_attr['LinkAvailability'];
											
										$PolledAvailabilityOption = $AirSegment_attr['PolledAvailabilityOption'];
										$OptionalServicesIndicator = $AirSegment_attr['OptionalServicesIndicator'];	
										
										$AvailabilitySource = '';
										if(isset( $AirSegment_attr['AvailabilitySource']))	
											$AvailabilitySource = $AirSegment_attr['AvailabilitySource'];
										
										if(isset($AirSegment[$k]['air:CodeshareInfo']) && is_array($AirSegment[$k]['air:CodeshareInfo'])) 
										{
												$CodeshareInfo_attr =  $AirSegment[$k]['air:CodeshareInfo']['@attributes'];	
												$OperatingCarrier = $CodeshareInfo_attr['OperatingCarrier'];	

												$OperatingFlightNumber = '';
												if(isset($CodeshareInfo_attr['OperatingFlightNumber']))	
														$OperatingFlightNumber = $CodeshareInfo_attr['OperatingFlightNumber'];		
										}
										else if(isset($AirSegment[$k]['air:CodeshareInfo']))
										{
												$OperatingCarrier = $AirSegment[$k]['air:CodeshareInfo'];
												$OperatingFlightNumber = '';
										}
										else
										{
											$OperatingCarrier = '';
											$OperatingFlightNumber = '';
										}
										
										$ProviderCode = '';$BookingCounts = '';
										if(isset($AirSegment[$k]['air:AirAvailInfo'])) 
										{
											$ProviderCode = $AirSegment[$k]['air:AirAvailInfo']['@attributes']['ProviderCode'];
											$BookingCodeInfo_attr =  $AirSegment[$k]['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
											$BookingCounts = $BookingCodeInfo_attr['BookingCounts'];											
										}
										 if(isset($AirSegment[$k]['air:FlightDetailsRef']['@attributes'])){
										$FlightDetailsRef_Key =  $AirSegment[$k]['air:FlightDetailsRef']['@attributes']['Key'];	
										}else{
                                                                                  $FlightDetailsRef_Key ='';
                                                                                  }
										for($l=0;$l< count($FlightDetails);$l++)
										{
											$FlightDetails_attr =  $FlightDetails[$l]['@attributes'];										
											$FlightDetails_Key = $FlightDetails_attr['Key'];
											
											if($FlightDetails_Key == $FlightDetailsRef_Key)	
											{
												//$Equipment = $FlightDetails_attr['Equipment'];													
												$OriginTerminal = '';$DestinationTerminal = '';
												if(isset($FlightDetails_attr['OriginTerminal']))
													$OriginTerminal = $FlightDetails_attr['OriginTerminal'];
												if(isset($FlightDetails_attr['DestinationTerminal']))
													$DestinationTerminal = $FlightDetails_attr['DestinationTerminal'];	
																									
												break;
											}
											
										}
										
										break;
										
									}
									
								}
								
								$BookingInfo_attr = $BookingInfo[$j]['@attributes'];	
									
								$BookingCode = $BookingInfo_attr['BookingCode'];
								$CabinClass = $BookingInfo_attr['CabinClass'];
								$FareInfoRef = $BookingInfo_attr['FareInfoRef'];
								
								$insertFlightsData[$lp] = array('session_id' => $this->sess_id, 
															  'AirPricingSolution_Key' => $AirPricingSolution_Key, 
															  'api' => $this->api,					  
															  'CurrencyType' => $CurrencyType, 
															  'TotalPrice' => $TotalPrice, 
															  'TotalPriceMarkup' => $TotalPriceAdminAgentMarkup,
															  'TotalPriceAdminMarkup' => $TotalPriceAdminMarkup,
															  'BasePrice' => $BasePrice, 
															  'TaxPrice' => $Taxes, 
															  'Adults' => $this->adults, 
															  'Childs' => $this->childs, 
															  'Infants' => $this->infants,
															  'BasePrice_Breakdown' => $Pass_BasePrice, 
															  'TaxPrice_Breakdown' => $Pass_Taxes, 
															  'FareType' => $FareType, 
															  'Total_Duration' => $Total_Duration, 
															  'AirSegment_Key' => $AirSegment_Key,						  
															  'Group' => $Group, 
															  'Carrier' => $Carrier,
															  'FlightNumber' => $FlightNumber,
															  'DepartureCode' => $Origin,
															  'ArrivalCode' => $Destination,
															  'DepartureDateTime' => $DepartureTime,					   
															  'ArrivalDateTime' => $ArrivalTime, 
															  'FlightTime' => $FlightTime,					 
															  'Distance' => $Distance,			  
															  'ETicketability' => $ETicketability, 				 
															  'Equipment' => $Equipment, 
															  'ChangeOfPlane' => $ChangeOfPlane, 
															  'ParticipantLevel' => $ParticipantLevel, 
															  'Stops' => $Stops, 
															  'LinkAvailability' => $LinkAvailability,
															  'PolledAvailabilityOption' => $PolledAvailabilityOption,
															  'OptionalServicesIndicator' => $OptionalServicesIndicator,
															  'AvailabilitySource' => $AvailabilitySource, 
															  'OperatingCarrier' => $OperatingCarrier, 
															  'OperatingFlightNumber' => $OperatingFlightNumber,	
															  'ProviderCode' => $ProviderCode, 
															  'BookingCounts' => $BookingCounts,				  
															  'FlightDetails_Key' => $FlightDetails_Key,					 
															  'OriginTerminal' => $OriginTerminal, 
															  'DestinationTerminal' => $DestinationTerminal,
															  'BookingCode' => $BookingCode,					 
															  'CabinClass' => $CabinClass, 
															  'FareInfoRef' => $FareInfoRef,
															  'PlatingCarrier' => $PlatingCarrier,
															  'Trip_Type' => $this->tripType,
                                                              'Mode' => 'onward',
															  'Admin_Markup' => $this->adminMarkup,
															   'Agent_Markup' => $this->agentMarkup,
															  'Payment_Charge' => ''
															);	
											
											$lp++;
								
								$Stops++;
								
							}		
							
						}
						else
						{
							$AirSegmentRef_attr 	= $AirSegmentRef['@attributes'];
							$AirSegmentRef_Key 		= $AirSegmentRef_attr['Key'];	
							
							for($k=0;$k< count($AirSegment);$k++)
							{
								$AirSegment_attr =  $AirSegment[$k]['@attributes'];										
								$AirSegment_Key = $AirSegment_attr['Key'];
								
								if($AirSegment_Key == $AirSegmentRef_Key)	
								{
									$Group = $AirSegment_attr['Group'];									
									$Carrier = $AirSegment_attr['Carrier'];
									$FlightNumber = $AirSegment_attr['FlightNumber'];
									$Origin = $AirSegment_attr['Origin'];
									$Destination = $AirSegment_attr['Destination'];
									$DepartureTime = $AirSegment_attr['DepartureTime'];
									$ArrivalTime = $AirSegment_attr['ArrivalTime'];
									$FlightTime = $AirSegment_attr['FlightTime'];
									$Distance = $AirSegment_attr['Distance'];
									$ETicketability = $AirSegment_attr['ETicketability'];
									$Equipment = $AirSegment_attr['Equipment'];
									$ChangeOfPlane = $AirSegment_attr['ChangeOfPlane'];
									$ParticipantLevel = $AirSegment_attr['ParticipantLevel'];
									
									$LinkAvailability = '';
									if(isset($AirSegment_attr['LinkAvailability']))
										$LinkAvailability = $AirSegment_attr['LinkAvailability'];
											
									$PolledAvailabilityOption = $AirSegment_attr['PolledAvailabilityOption'];
									$OptionalServicesIndicator = $AirSegment_attr['OptionalServicesIndicator'];		
									
									$AvailabilitySource = '';
									if(isset( $AirSegment_attr['AvailabilitySource']))	
										$AvailabilitySource = $AirSegment_attr['AvailabilitySource'];
										
									
									if(isset($AirSegment[$k]['air:CodeshareInfo']) && is_array($AirSegment[$k]['air:CodeshareInfo'])) 
									{
											$CodeshareInfo_attr =  $AirSegment[$k]['air:CodeshareInfo']['@attributes'];	
											$OperatingCarrier = $CodeshareInfo_attr['OperatingCarrier'];	

											$OperatingFlightNumber = '';
											if(isset($CodeshareInfo_attr['OperatingFlightNumber']))	
													$OperatingFlightNumber = $CodeshareInfo_attr['OperatingFlightNumber'];		
									}
									else if(isset($AirSegment[$k]['air:CodeshareInfo']))
									{
											$OperatingCarrier = $AirSegment[$k]['air:CodeshareInfo'];
											$OperatingFlightNumber = '';
									}
									else
									{
										$OperatingCarrier = '';
										$OperatingFlightNumber = '';
									}
									
									$ProviderCode = '';$BookingCounts = '';
									if(isset($AirSegment[$k]['air:AirAvailInfo'])) 
									{
										$ProviderCode = $AirSegment[$k]['air:AirAvailInfo']['@attributes']['ProviderCode'];
										$BookingCodeInfo_attr =  $AirSegment[$k]['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
										$BookingCounts = $BookingCodeInfo_attr['BookingCounts'];											
									}
									if(isset($AirSegment[$k]['air:FlightDetailsRef']['@attributes'])){
									$FlightDetailsRef_Key =  $AirSegment[$k]['air:FlightDetailsRef']['@attributes']['Key'];	
									}else{
                                                                         $FlightDetailsRef_Key ='';
                                                                         }
									for($l=0;$l< count($FlightDetails);$l++)
									{
										$FlightDetails_attr =  $FlightDetails[$l]['@attributes'];										
										$FlightDetails_Key = $FlightDetails_attr['Key'];
										
										if($FlightDetails_Key == $FlightDetailsRef_Key)	
										{
											//$Equipment = $FlightDetails_attr['Equipment'];													
											$OriginTerminal = '';$DestinationTerminal = '';
											if(isset($FlightDetails_attr['OriginTerminal']))
												$OriginTerminal = $FlightDetails_attr['OriginTerminal'];
											if(isset($FlightDetails_attr['DestinationTerminal']))
												$DestinationTerminal = $FlightDetails_attr['DestinationTerminal'];	
																								
											break;
										}
										
									}
									
									break;
									
								}
								
							}	
							
							$BookingInfo_attr = $BookingInfo['@attributes'];	
									
							$BookingCode = $BookingInfo_attr['BookingCode'];
							$CabinClass = $BookingInfo_attr['CabinClass'];
							$FareInfoRef = $BookingInfo_attr['FareInfoRef'];
							
							$insertFlightsData[$lp] = array('session_id' => $this->sess_id, 
															  'AirPricingSolution_Key' => $AirPricingSolution_Key, 
															  'api' => $this->api,					  
															  'CurrencyType' => $CurrencyType, 
															  'TotalPrice' => $TotalPrice,
															  'TotalPriceMarkup' => $TotalPriceAdminAgentMarkup,
															  'TotalPriceAdminMarkup' => $TotalPriceAdminMarkup,
															  'BasePrice' => $BasePrice, 
															  'TaxPrice' => $Taxes, 
															  'Adults' => $this->adults, 
															  'Childs' => $this->childs, 
															  'Infants' => $this->infants,
															  'BasePrice_Breakdown' => $Pass_BasePrice, 
															  'TaxPrice_Breakdown' => $Pass_Taxes, 
															  'FareType' => $FareType, 
															  'Total_Duration' => $Total_Duration, 
															  'AirSegment_Key' => $AirSegment_Key,						  
															  'Group' => $Group, 
															  'Carrier' => $Carrier,
															  'FlightNumber' => $FlightNumber,
															  'DepartureCode' => $Origin,
															  'ArrivalCode' => $Destination,
															  'DepartureDateTime' => $DepartureTime,					   
															  'ArrivalDateTime' => $ArrivalTime, 
															  'FlightTime' => $FlightTime,					 
															  'Distance' => $Distance,			  
															  'ETicketability' => $ETicketability, 				 
															  'Equipment' => $Equipment, 
															  'ChangeOfPlane' => $ChangeOfPlane, 
															  'ParticipantLevel' => $ParticipantLevel, 
															  'Stops' => $Stops, 
															  'LinkAvailability' => $LinkAvailability,
															  'PolledAvailabilityOption' => $PolledAvailabilityOption,
															  'OptionalServicesIndicator' => $OptionalServicesIndicator,
															  'AvailabilitySource' => $AvailabilitySource, 
															  'OperatingCarrier' => $OperatingCarrier, 
															  'OperatingFlightNumber' => $OperatingFlightNumber,
															  'ProviderCode' => $ProviderCode, 
															  'BookingCounts' => $BookingCounts,					  
															  'FlightDetails_Key' => $FlightDetails_Key,					 
															  'OriginTerminal' => $OriginTerminal, 
															  'DestinationTerminal' => $DestinationTerminal,
															  'BookingCode' => $BookingCode,					 
															  'CabinClass' => $CabinClass, 
															  'FareInfoRef' => $FareInfoRef,
															  'PlatingCarrier' => $PlatingCarrier,
															  'Trip_Type' => $this->tripType,
                                                              'Mode' => 'onward',
															  'Admin_Markup' => $this->adminMarkup,
															   'Agent_Markup' => $this->agentMarkup,
															  'Payment_Charge' => ''
															);	
											
											$lp++;					
							
						}							
						
					}
					
				}
								
				//Delete temp search data
				$this->Travelport_Model->delete_flight_temp_result($this->sess_id);
				
				
				//Insert New flight search results
				$this->Travelport_Model->insert_flight_temp_results($insertFlightsData);
				
				//Fetch and display flight results
				$this->fetch_flight_search_results();
			
			}
			else
			{				
                		$this->fetch_flight_search_results();
			}
		}		
	}
	
	public function fetch_flight_search_results()
	{		
		$flight_result = $this->Travelport_Model->fetch_search_result($this->sess_id);
		if(empty($flight_result))
		{				
			$this->session->unset_userdata('flight_search_activate');
		}
        //echo '<pre/>';print_r($flight_result);exit;
		$data['result'] = $flight_result;        
		
		if($flight_result[0]->Trip_Type == 'R')
		{               
			$flight_search_result = $this->load->view('flight/search_result_ajax_round', $data, TRUE);		
		}
		else
		{
			$flight_search_result = $this->load->view('flight/search_result_ajax1', $data, TRUE);	
		}
        
        echo json_encode(array("flight_search_result" => $flight_search_result));
        
	}
	
	
	public function AirLowFareSearchRQ()
	{           
		$SearchAirLegReturn = '';
		if ($this->tripType == 'R') 
		{            
            $SearchAirLegReturn .= '<SearchAirLeg>
				<SearchOrigin>
				  <CityOrAirport Code="'.$this->toCityCode.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
				</SearchOrigin>
				<SearchDestination>
				  <CityOrAirport Code="'.$this->fromCityCode.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
				</SearchDestination>
				<SearchDepTime PreferredTime="'.$this->returnDate.'T'.$this->returnTime.'" ></SearchDepTime>
				<AirLegModifiers>
				  <PreferredCabins>
					<CabinClass Type="'.$this->cabinClass.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CabinClass>
				  </PreferredCabins>
				</AirLegModifiers>
			</SearchAirLeg>';           
        }
		
		$adults = '';
		if($this->adults != 0)
		{
			for($a=0;$a < $this->adults;$a++)
			{
				$adults .= '<SearchPassenger Code="ADT" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
			}
		}
		
		$childs = '';
		if($this->childs != 0)
		{
			for($c=0;$c < $this->childs;$c++)
			{
				$childs .= '<SearchPassenger Code="CNN" Age="10" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
			}
		}
		
		$infants = '';
		if($this->infants != 0)
		{
			for($in=0;$in < $this->infants;$in++)
			{
				$infants .= '<SearchPassenger Code="INF" Age="1" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
			}
		}
		
		$LowFareSearchReqXML = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
			  <s:Header>
				<Action s:mustUnderstand="1" xmlns="http://schemas.microsoft.com/ws/2005/05/addressing/none">http://localhost:8080/kestrel/AirService</Action>
			  </s:Header>
			  <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
				<LowFareSearchReq TargetBranch="'.$this->targetBranch.'" xmlns="http://www.travelport.com/schema/air_v28_0">
				 <BillingPointOfSaleInfo OriginApplication="UAPI" xmlns="http://www.travelport.com/schema/common_v28_0" ></BillingPointOfSaleInfo>
				  <SearchAirLeg>
					<SearchOrigin>
					  <CityOrAirport Code="'.$this->fromCityCode.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
					</SearchOrigin>
					<SearchDestination>
					  <CityOrAirport Code="'.$this->toCityCode.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
					</SearchDestination>
					<SearchDepTime PreferredTime="'.$this->departDate.'T'.$this->departTime.'" ></SearchDepTime>
					<AirLegModifiers>
					  <PreferredCabins>
						<CabinClass Type="'.$this->cabinClass.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CabinClass>
					  </PreferredCabins>
					</AirLegModifiers>
				</SearchAirLeg>
				  '.$SearchAirLegReturn.'
				  <AirSearchModifiers>
					<PreferredProviders>
					  <Provider Code="1G" xmlns="http://www.travelport.com/schema/common_v28_0" ></Provider>
					</PreferredProviders>
				  </AirSearchModifiers>
				  '.$adults.'
				  '.$childs.'
				  '.$infants.'
				</LowFareSearchReq>
			  </s:Body>
			</s:Envelope>';
		
		//echo $LowFareSearchReqXML;
		
		$LowFareSearchRes = $this->processRequest($LowFareSearchReqXML);
		//echo $LowFareSearchRes;exit;
              
       		 return $LowFareSearchRes;
		
	}
	
	// Multicity Airlow Faresearch RQ
	public function multicity_flights_searchRQ()
	{		
		$this->set_multisearch_variables();
		$this->setup_markup();	
		
		// Getting Flight Search Results from database
		if($this->session->userdata('flight_search_activate') == 1)
		{			
			$this->fetch_multicity_flight_search_results();
		}
		else
		{		 
			$this->load->library('xml_to_array');	
								
			$MultiCityAirLowFareSearchRS = $this->MultiCityAirLowFareSearchRQ();
            //echo '<pre/>';print_r($MultiCityAirLowFareSearchRS); exit;
			$AirLowFareSearchRS_arr = $this->xml_to_array->XmlToArray($MultiCityAirLowFareSearchRS);		
			//echo '<pre/>';print_r($AirLowFareSearchRS_arr);exit;
			
			if(isset($AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['air:FlightDetailsList']))
			{
				$CurrencyType = $AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['@attributes']['CurrencyType'];
				
				//$Route = $AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['air:RouteList']['air:Route'];
				
				$FlightDetails = $AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['air:FlightDetailsList']['air:FlightDetails'];
				$AirSegment = $AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['air:AirSegmentList']['air:AirSegment'];
								
				$AirPricingSolution = $AirLowFareSearchRS_arr['SOAP:Body']['air:LowFareSearchRsp']['air:AirPricingSolution'];
				
				$lp = 0;$insertFlightsData = array();
				for($i=0;$i< count($AirPricingSolution);$i++)
				{			
					$AirPricingSolution_attr = $AirPricingSolution[$i]['@attributes'];
					$AirPricingSolution_Key = $AirPricingSolution_attr['Key'];
					
					$TotalPrice = $AirPricingSolution_attr['TotalPrice'];
					$TotalPriceMarkup = (float)substr($TotalPrice,3);
					
					if($this->adminMarkup){
					  	$TotalPriceAdminMarkup = $TotalPriceMarkup+($TotalPriceMarkup*$this->adminMarkup/100);
					}else{
						$TotalPriceAdminMarkup = $TotalPriceMarkup;
					} 
					if($this->agentMarkup){
					  	$TotalPriceAdminAgentMarkup = $TotalPriceAdminMarkup+($TotalPriceAdminMarkup*$this->agentMarkup/100);
					}else{
					  	$TotalPriceAdminAgentMarkup = $TotalPriceAdminMarkup;
					}	
				
					if(isset($AirPricingSolution_attr['EquivalentBasePrice']))
						$BasePrice = $AirPricingSolution_attr['EquivalentBasePrice'];
					else
					    $BasePrice = $AirPricingSolution_attr['ApproximateBasePrice'];
					    
					$Taxes = $AirPricingSolution_attr['Taxes'];
					
					$Journey = $AirPricingSolution[$i]['air:Journey'];	
					
					$AirPricingInfo = $AirPricingSolution[$i]['air:AirPricingInfo'];
					
					if(isset($AirPricingInfo[0])) 
					{
						$AirPricingInfo_attr = $AirPricingInfo[0]['@attributes'];
						if(isset($AirPricingInfo_attr['PlatingCarrier']))
							$PlatingCarrier = $AirPricingInfo_attr['PlatingCarrier'];
						else
							$PlatingCarrier = ''; 
							
						if(isset($AirPricingInfo_attr['Refundable']))
							$Refundable = $AirPricingInfo_attr['Refundable'];
						else
							$Refundable = 'false';
						
						$Pass_BasePrice_arr = $Pass_Taxes_arr = array();	
						for($p=0;$p<count($AirPricingInfo);$p++)
						{
							//$Pass_BasePrice_arr[] = $AirPricingInfo[$p]['@attributes']['EquivalentBasePrice'];
							if(isset($AirPricingInfo[$p]['@attributes']['EquivalentBasePrice']))
								$Pass_BasePrice_arr[] = $AirPricingInfo[$p]['@attributes']['EquivalentBasePrice'];
							else
								$Pass_BasePrice_arr[] = $AirPricingInfo[$p]['@attributes']['ApproximateBasePrice'];
								
							$Pass_Taxes_arr[] = $AirPricingInfo[$p]['@attributes']['Taxes'];
						}
						
						$Pass_BasePrice = implode(',',$Pass_BasePrice_arr);
						$Pass_Taxes = implode(',',$Pass_Taxes_arr);
												
						$BookingInfo = $AirPricingInfo[0]['air:BookingInfo'];	
					}
					else
					{
						$AirPricingInfo_attr = $AirPricingInfo['@attributes'];
						if(isset($AirPricingInfo_attr['PlatingCarrier']))
							$PlatingCarrier = $AirPricingInfo_attr['PlatingCarrier'];
						else
							$PlatingCarrier = '';   
						
						if(isset($AirPricingInfo_attr['Refundable']))
							$Refundable = $AirPricingInfo_attr['Refundable'];
						else
							$Refundable = 'false';						
						
						//$Pass_BasePrice = $AirPricingInfo_attr['BasePrice'];
						if(isset($AirPricingInfo_attr['EquivalentBasePrice']))
							$Pass_BasePrice = $AirPricingInfo_attr['EquivalentBasePrice'];
						else
							$Pass_BasePrice = $AirPricingInfo_attr['ApproximateBasePrice'];
							
						$Pass_Taxes = $AirPricingInfo_attr['Taxes'];
						
						$BookingInfo = $AirPricingInfo['air:BookingInfo'];	
					}
					
					if($Refundable == 'true')
						$FareType = 'Refundable';
					else
						$FareType = 'Non Refundable';
					
					if(isset($Journey[0])) 
					{
                                                $bin = 0;
						for($b=0;$b<count($Journey);$b++)
						{ 
                                                        if($b == 0)
                                                            $mode = 'onward';
                                                        else
                                                            $mode = 'multi';
                                                        
							$Journey_attr = $Journey[$b]['@attributes'];
							$Total_Duration = $Journey_attr['TravelTime'];
							
							$Stops = 0;
							$AirSegmentRef = $Journey[$b]['air:AirSegmentRef'];
							if(isset($AirSegmentRef[0]))
							{								
								for($j=0;$j< count($AirSegmentRef);$j++)
								{
									$AirSegmentRef_attr = $AirSegmentRef[$j]['@attributes'];									
									$AirSegmentRef_Key = $AirSegmentRef_attr['Key'];
									
									for($k=0;$k< count($AirSegment);$k++)
									{
										$AirSegment_attr =  $AirSegment[$k]['@attributes'];										
										$AirSegment_Key = $AirSegment_attr['Key'];
										
										if($AirSegment_Key == $AirSegmentRef_Key)	
										{
											$Group = $AirSegment_attr['Group'];									
											$Carrier = $AirSegment_attr['Carrier'];
											$FlightNumber = $AirSegment_attr['FlightNumber'];
											$Origin = $AirSegment_attr['Origin'];
											$Destination = $AirSegment_attr['Destination'];
											$DepartureTime = $AirSegment_attr['DepartureTime'];
											$ArrivalTime = $AirSegment_attr['ArrivalTime'];
											$FlightTime = $AirSegment_attr['FlightTime'];
											$Distance = $AirSegment_attr['Distance'];
											$ETicketability = $AirSegment_attr['ETicketability'];
											$Equipment = $AirSegment_attr['Equipment'];
											$ChangeOfPlane = $AirSegment_attr['ChangeOfPlane'];
											$ParticipantLevel = $AirSegment_attr['ParticipantLevel'];
											
											$LinkAvailability = '';
											if(isset($AirSegment_attr['LinkAvailability']))
												$LinkAvailability = $AirSegment_attr['LinkAvailability'];
												
											$PolledAvailabilityOption = $AirSegment_attr['PolledAvailabilityOption'];
											$OptionalServicesIndicator = $AirSegment_attr['OptionalServicesIndicator'];		
											
											$AvailabilitySource = '';
											if(isset( $AirSegment_attr['AvailabilitySource']))	
												$AvailabilitySource = $AirSegment_attr['AvailabilitySource'];
											
											if(isset($AirSegment[$k]['air:CodeshareInfo']) && is_array($AirSegment[$k]['air:CodeshareInfo'])) 
											{
												$CodeshareInfo_attr =  $AirSegment[$k]['air:CodeshareInfo']['@attributes'];	
												$OperatingCarrier = $CodeshareInfo_attr['OperatingCarrier'];	
																							
												$OperatingFlightNumber = '';
												if(isset($CodeshareInfo_attr['OperatingFlightNumber']))	
													$OperatingFlightNumber = $CodeshareInfo_attr['OperatingFlightNumber'];		
											}
											else if(isset($AirSegment[$k]['air:CodeshareInfo']))
											{
												$OperatingCarrier = $AirSegment[$k]['air:CodeshareInfo'];
												$OperatingFlightNumber = '';
											}
											else
											{
												$OperatingCarrier = '';
												$OperatingFlightNumber = '';
											}
											
											$ProviderCode = '';$BookingCounts = '';
											if(isset($AirSegment[$k]['air:AirAvailInfo'])) 
											{
												$ProviderCode = $AirSegment[$k]['air:AirAvailInfo']['@attributes']['ProviderCode'];
												$BookingCodeInfo_attr =  $AirSegment[$k]['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
												$BookingCounts = $BookingCodeInfo_attr['BookingCounts'];											
											}
											if(isset($AirSegment[$k]['air:FlightDetailsRef']['@attributes'])){
											$FlightDetailsRef_Key =  $AirSegment[$k]['air:FlightDetailsRef']['@attributes']['Key'];	
											}else{
                                                                                          $FlightDetailsRef_Key ='';
                                                                                          }
											for($l=0;$l< count($FlightDetails);$l++)
											{
												$FlightDetails_attr =  $FlightDetails[$l]['@attributes'];										
												$FlightDetails_Key = $FlightDetails_attr['Key'];
												
												if($FlightDetails_Key == $FlightDetailsRef_Key)	
												{
													//$Equipment = $FlightDetails_attr['Equipment'];													
													$OriginTerminal = '';$DestinationTerminal = '';
													if(isset($FlightDetails_attr['OriginTerminal']))
														$OriginTerminal = $FlightDetails_attr['OriginTerminal'];
													if(isset($FlightDetails_attr['DestinationTerminal']))
														$DestinationTerminal = $FlightDetails_attr['DestinationTerminal'];	
																										
													break;
												}
												
											}
											
											break;
											
										}
										
									}
									
									$BookingInfo_attr = $BookingInfo[$bin]['@attributes'];	
									
									$BookingCode = $BookingInfo_attr['BookingCode'];
									$CabinClass = $BookingInfo_attr['CabinClass'];
									$FareInfoRef = $BookingInfo_attr['FareInfoRef'];
																	
									$insertFlightsData[$lp] = array('session_id' => $this->sess_id, 
															  'AirPricingSolution_Key' => $AirPricingSolution_Key, 
															  'api' => $this->api,					  
															  'CurrencyType' => $CurrencyType, 
															  'TotalPrice' => $TotalPrice,
															  'TotalPriceMarkup' => $TotalPriceAdminAgentMarkup,
															  'TotalPriceAdminMarkup' => $TotalPriceAdminMarkup,
															  'BasePrice' => $BasePrice, 
															  'TaxPrice' => $Taxes, 
															  'Adults' => $this->adults, 
															  'Childs' => $this->childs, 
															  'Infants' => $this->infants,
															  'BasePrice_Breakdown' => $Pass_BasePrice, 
															  'TaxPrice_Breakdown' => $Pass_Taxes, 
															  'FareType' => $FareType,
															  'Total_Duration' => $Total_Duration, 
															  'AirSegment_Key' => $AirSegment_Key,						  
															  'Group' => $Group, 
															  'Carrier' => $Carrier,
															  'FlightNumber' => $FlightNumber,
															  'DepartureCode' => $Origin,
															  'ArrivalCode' => $Destination,
															  'DepartureDateTime' => $DepartureTime,					   
															  'ArrivalDateTime' => $ArrivalTime, 
															  'FlightTime' => $FlightTime,					 
															  'Distance' => $Distance,			  
															  'ETicketability' => $ETicketability, 				 
															  'Equipment' => $Equipment, 
															  'ChangeOfPlane' => $ChangeOfPlane, 
															  'ParticipantLevel' => $ParticipantLevel, 
															  'Stops' => $Stops, 
															  'LinkAvailability' => $LinkAvailability,
															  'PolledAvailabilityOption' => $PolledAvailabilityOption,
															  'OptionalServicesIndicator' => $OptionalServicesIndicator,
															  'AvailabilitySource' => $AvailabilitySource, 
															  'OperatingCarrier' => $OperatingCarrier, 
															  'OperatingFlightNumber' => $OperatingFlightNumber,	
															  'ProviderCode' => $ProviderCode, 
															  'BookingCounts' => $BookingCounts,					  
															  'FlightDetails_Key' => $FlightDetails_Key,					 
															  'OriginTerminal' => $OriginTerminal, 
															  'DestinationTerminal' => $DestinationTerminal,
															  'BookingCode' => $BookingCode,					 
															  'CabinClass' => $CabinClass, 
															  'FareInfoRef' => $FareInfoRef,
															  'PlatingCarrier' => $PlatingCarrier,
															  'Trip_Type' => $this->tripType,	
                                                              'Mode' => $mode,
															  'Admin_Markup' => $this->adminMarkup,
															   'Agent_Markup' => $this->agentMarkup,
															  'Payment_Charge' => ''
															);	
											
											$lp++;
									
									
									$Stops++;
                                                                        
                                                                         $bin++;
									
								}		
								
							}
							else
							{
								$AirSegmentRef_attr 	= $AirSegmentRef['@attributes'];
								$AirSegmentRef_Key 		= $AirSegmentRef_attr['Key'];	
								
								for($k=0;$k< count($AirSegment);$k++)
								{
									$AirSegment_attr =  $AirSegment[$k]['@attributes'];										
									$AirSegment_Key = $AirSegment_attr['Key'];
									
									if($AirSegment_Key == $AirSegmentRef_Key)	
									{
										$Group = $AirSegment_attr['Group'];									
										$Carrier = $AirSegment_attr['Carrier'];
										$FlightNumber = $AirSegment_attr['FlightNumber'];
										$Origin = $AirSegment_attr['Origin'];
										$Destination = $AirSegment_attr['Destination'];
										$DepartureTime = $AirSegment_attr['DepartureTime'];
										$ArrivalTime = $AirSegment_attr['ArrivalTime'];
										$FlightTime = $AirSegment_attr['FlightTime'];
										$Distance = $AirSegment_attr['Distance'];
										$ETicketability = $AirSegment_attr['ETicketability'];
										$Equipment = $AirSegment_attr['Equipment'];
										$ChangeOfPlane = $AirSegment_attr['ChangeOfPlane'];
										$ParticipantLevel = $AirSegment_attr['ParticipantLevel'];
										
										$LinkAvailability = '';
										if(isset($AirSegment_attr['LinkAvailability']))
											$LinkAvailability = $AirSegment_attr['LinkAvailability'];
												
										$PolledAvailabilityOption = $AirSegment_attr['PolledAvailabilityOption'];
										$OptionalServicesIndicator = $AirSegment_attr['OptionalServicesIndicator'];		
										
										$AvailabilitySource = '';
										if(isset( $AirSegment_attr['AvailabilitySource']))	
											$AvailabilitySource = $AirSegment_attr['AvailabilitySource'];
										                                                                               
										if(isset($AirSegment[$k]['air:CodeshareInfo']) && is_array($AirSegment[$k]['air:CodeshareInfo'])) 
										{
												$CodeshareInfo_attr =  $AirSegment[$k]['air:CodeshareInfo']['@attributes'];	
												$OperatingCarrier = $CodeshareInfo_attr['OperatingCarrier'];	

												$OperatingFlightNumber = '';
												if(isset($CodeshareInfo_attr['OperatingFlightNumber']))	
														$OperatingFlightNumber = $CodeshareInfo_attr['OperatingFlightNumber'];		
										}
										else if(isset($AirSegment[$k]['air:CodeshareInfo']))
										{
												$OperatingCarrier = $AirSegment[$k]['air:CodeshareInfo'];
												$OperatingFlightNumber = '';
										}
										else
										{
											$OperatingCarrier = '';
											$OperatingFlightNumber = '';
										}
										
										$ProviderCode = '';$BookingCounts = '';
										if(isset($AirSegment[$k]['air:AirAvailInfo'])) 
										{
											$ProviderCode = $AirSegment[$k]['air:AirAvailInfo']['@attributes']['ProviderCode'];
											$BookingCodeInfo_attr =  $AirSegment[$k]['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
											$BookingCounts = $BookingCodeInfo_attr['BookingCounts'];											
										}
										if(isset($AirSegment[$k]['air:FlightDetailsRef']['@attributes'])){
										$FlightDetailsRef_Key =  $AirSegment[$k]['air:FlightDetailsRef']['@attributes']['Key'];	
										}else{
                                                                                   $FlightDetailsRef_Key ='';
                                                                                    }
										for($l=0;$l< count($FlightDetails);$l++)
										{
											$FlightDetails_attr =  $FlightDetails[$l]['@attributes'];										
											$FlightDetails_Key = $FlightDetails_attr['Key'];
											
											if($FlightDetails_Key == $FlightDetailsRef_Key)	
											{
												//$Equipment = $FlightDetails_attr['Equipment'];													
												$OriginTerminal = '';$DestinationTerminal = '';
												if(isset($FlightDetails_attr['OriginTerminal']))
													$OriginTerminal = $FlightDetails_attr['OriginTerminal'];
												if(isset($FlightDetails_attr['DestinationTerminal']))
													$DestinationTerminal = $FlightDetails_attr['DestinationTerminal'];	
																									
												break;
											}
											
										}
										
										break;
										
									}
									
								}	
								
                                                                if(isset($BookingInfo[$bin]))
                                                                    $BookingInfo_attr = $BookingInfo[$bin]['@attributes'];
                                                                else
                                                                    $BookingInfo_attr = $BookingInfo['@attributes'];
									
								$BookingCode = $BookingInfo_attr['BookingCode'];
								$CabinClass = $BookingInfo_attr['CabinClass'];
								$FareInfoRef = $BookingInfo_attr['FareInfoRef'];
								
								$insertFlightsData[$lp] = array('session_id' => $this->sess_id, 
															  'AirPricingSolution_Key' => $AirPricingSolution_Key, 
															  'api' => $this->api,					  
															  'CurrencyType' => $CurrencyType, 
															  'TotalPrice' => $TotalPrice,
															  'TotalPriceMarkup' => $TotalPriceAdminAgentMarkup,
															  'TotalPriceAdminMarkup' => $TotalPriceAdminMarkup,
															  'BasePrice' => $BasePrice, 
															  'TaxPrice' => $Taxes, 
															  'Adults' => $this->adults, 
															  'Childs' => $this->childs, 
															  'Infants' => $this->infants,
															  'BasePrice_Breakdown' => $Pass_BasePrice, 
															  'TaxPrice_Breakdown' => $Pass_Taxes, 
															  'FareType' => $FareType,
															  'Total_Duration' => $Total_Duration, 
															  'AirSegment_Key' => $AirSegment_Key,						  
															  'Group' => $Group, 
															  'Carrier' => $Carrier,
															  'FlightNumber' => $FlightNumber,
															  'DepartureCode' => $Origin,
															  'ArrivalCode' => $Destination,
															  'DepartureDateTime' => $DepartureTime,					   
															  'ArrivalDateTime' => $ArrivalTime, 
															  'FlightTime' => $FlightTime,					 
															  'Distance' => $Distance,			  
															  'ETicketability' => $ETicketability, 				 
															  'Equipment' => $Equipment, 
															  'ChangeOfPlane' => $ChangeOfPlane, 
															  'ParticipantLevel' => $ParticipantLevel, 
															  'Stops' => $Stops, 
															  'LinkAvailability' => $LinkAvailability,
															  'PolledAvailabilityOption' => $PolledAvailabilityOption,
															  'OptionalServicesIndicator' => $OptionalServicesIndicator,
															  'AvailabilitySource' => $AvailabilitySource, 
															  'OperatingCarrier' => $OperatingCarrier, 
															  'OperatingFlightNumber' => $OperatingFlightNumber,
															  'ProviderCode' => $ProviderCode, 
															  'BookingCounts' => $BookingCounts,					  
															  'FlightDetails_Key' => $FlightDetails_Key,					 
															  'OriginTerminal' => $OriginTerminal, 
															  'DestinationTerminal' => $DestinationTerminal,
															  'BookingCode' => $BookingCode,					 
															  'CabinClass' => $CabinClass, 
															  'FareInfoRef' => $FareInfoRef,
															  'PlatingCarrier' => $PlatingCarrier,
															  'Trip_Type' => $this->tripType,	
                                                              'Mode' => $mode,
															  'Admin_Markup' => $this->adminMarkup,
															   'Agent_Markup' => $this->agentMarkup,
															  'Payment_Charge' => ''
															);	
											
											$lp++;	
                                                                                        
                                                               $bin++;
								
							}
					
						}								
						
					}
					else
					{								
						$Journey_attr = $Journey['@attributes'];
						$Total_Duration = $Journey_attr['TravelTime'];
						
						$Stops = 0;
						$AirSegmentRef = $Journey['air:AirSegmentRef'];
						if(isset($AirSegmentRef[0]))
						{								
							for($j=0;$j< count($AirSegmentRef);$j++)
							{
								$AirSegmentRef_attr = $AirSegmentRef[$j]['@attributes'];									
								$AirSegmentRef_Key = $AirSegmentRef_attr['Key'];
								
								for($k=0;$k< count($AirSegment);$k++)
								{
									$AirSegment_attr =  $AirSegment[$k]['@attributes'];										
									$AirSegment_Key = $AirSegment_attr['Key'];
									
									if($AirSegment_Key == $AirSegmentRef_Key)	
									{
										$Group = $AirSegment_attr['Group'];									
										$Carrier = $AirSegment_attr['Carrier'];
										$FlightNumber = $AirSegment_attr['FlightNumber'];
										$Origin = $AirSegment_attr['Origin'];
										$Destination = $AirSegment_attr['Destination'];
										$DepartureTime = $AirSegment_attr['DepartureTime'];
										$ArrivalTime = $AirSegment_attr['ArrivalTime'];
										$FlightTime = $AirSegment_attr['FlightTime'];
										$Distance = $AirSegment_attr['Distance'];
										$ETicketability = $AirSegment_attr['ETicketability'];
										$Equipment = $AirSegment_attr['Equipment'];
										$ChangeOfPlane = $AirSegment_attr['ChangeOfPlane'];
										$ParticipantLevel = $AirSegment_attr['ParticipantLevel'];
										
										$LinkAvailability = '';
										if(isset($AirSegment_attr['LinkAvailability']))
											$LinkAvailability = $AirSegment_attr['LinkAvailability'];
											
										$PolledAvailabilityOption = $AirSegment_attr['PolledAvailabilityOption'];
										$OptionalServicesIndicator = $AirSegment_attr['OptionalServicesIndicator'];	
										
										$AvailabilitySource = '';
										if(isset( $AirSegment_attr['AvailabilitySource']))	
											$AvailabilitySource = $AirSegment_attr['AvailabilitySource'];
										
										if(isset($AirSegment[$k]['air:CodeshareInfo']) && is_array($AirSegment[$k]['air:CodeshareInfo'])) 
										{
												$CodeshareInfo_attr =  $AirSegment[$k]['air:CodeshareInfo']['@attributes'];	
												$OperatingCarrier = $CodeshareInfo_attr['OperatingCarrier'];	

												$OperatingFlightNumber = '';
												if(isset($CodeshareInfo_attr['OperatingFlightNumber']))	
														$OperatingFlightNumber = $CodeshareInfo_attr['OperatingFlightNumber'];		
										}
										else if(isset($AirSegment[$k]['air:CodeshareInfo']))
										{
												$OperatingCarrier = $AirSegment[$k]['air:CodeshareInfo'];
												$OperatingFlightNumber = '';
										}
										else
										{
											$OperatingCarrier = '';
											$OperatingFlightNumber = '';
										}

										$ProviderCode = '';$BookingCounts = '';
										if(isset($AirSegment[$k]['air:AirAvailInfo'])) 
										{
											$ProviderCode = $AirSegment[$k]['air:AirAvailInfo']['@attributes']['ProviderCode'];
											$BookingCodeInfo_attr =  $AirSegment[$k]['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
											$BookingCounts = $BookingCodeInfo_attr['BookingCounts'];											
										}
										if(isset($AirSegment[$k]['air:FlightDetailsRef']['@attributes'])){
										$FlightDetailsRef_Key =  $AirSegment[$k]['air:FlightDetailsRef']['@attributes']['Key'];	
										}else{
                                                                                 $FlightDetailsRef_Key ='';
                                                                                   }
										for($l=0;$l< count($FlightDetails);$l++)
										{
											$FlightDetails_attr =  $FlightDetails[$l]['@attributes'];										
											$FlightDetails_Key = $FlightDetails_attr['Key'];
											
											if($FlightDetails_Key == $FlightDetailsRef_Key)	
											{
												//$Equipment = $FlightDetails_attr['Equipment'];													
												$OriginTerminal = '';$DestinationTerminal = '';
												if(isset($FlightDetails_attr['OriginTerminal']))
													$OriginTerminal = $FlightDetails_attr['OriginTerminal'];
												if(isset($FlightDetails_attr['DestinationTerminal']))
													$DestinationTerminal = $FlightDetails_attr['DestinationTerminal'];	
																									
												break;
											}
											
										}
										
										break;
										
									}
									
								}
								
								$BookingInfo_attr = $BookingInfo[$j]['@attributes'];	
									
								$BookingCode = $BookingInfo_attr['BookingCode'];
								$CabinClass = $BookingInfo_attr['CabinClass'];
								$FareInfoRef = $BookingInfo_attr['FareInfoRef'];
								
								$insertFlightsData[$lp] = array('session_id' => $this->sess_id, 
															  'AirPricingSolution_Key' => $AirPricingSolution_Key, 
															  'api' => $this->api,					  
															  'CurrencyType' => $CurrencyType, 
															  'TotalPrice' => $TotalPrice,
															  'TotalPriceMarkup' => $TotalPriceAdminAgentMarkup,
															  'TotalPriceAdminMarkup' => $TotalPriceAdminMarkup,
															  'BasePrice' => $BasePrice, 
															  'TaxPrice' => $Taxes, 
															  'Adults' => $this->adults, 
															  'Childs' => $this->childs, 
															  'Infants' => $this->infants,
															  'BasePrice_Breakdown' => $Pass_BasePrice, 
															  'TaxPrice_Breakdown' => $Pass_Taxes, 
															  'FareType' => $FareType,
															  'Total_Duration' => $Total_Duration, 
															  'AirSegment_Key' => $AirSegment_Key,						  
															  'Group' => $Group, 
															  'Carrier' => $Carrier,
															  'FlightNumber' => $FlightNumber,
															  'DepartureCode' => $Origin,
															  'ArrivalCode' => $Destination,
															  'DepartureDateTime' => $DepartureTime,					   
															  'ArrivalDateTime' => $ArrivalTime, 
															  'FlightTime' => $FlightTime,					 
															  'Distance' => $Distance,			  
															  'ETicketability' => $ETicketability, 				 
															  'Equipment' => $Equipment, 
															  'ChangeOfPlane' => $ChangeOfPlane, 
															  'ParticipantLevel' => $ParticipantLevel, 
															  'Stops' => $Stops, 
															  'LinkAvailability' => $LinkAvailability,
															  'PolledAvailabilityOption' => $PolledAvailabilityOption,
															  'OptionalServicesIndicator' => $OptionalServicesIndicator,
															  'AvailabilitySource' => $AvailabilitySource, 
															  'OperatingCarrier' => $OperatingCarrier, 
															  'OperatingFlightNumber' => $OperatingFlightNumber,	
															  'ProviderCode' => $ProviderCode, 
															  'BookingCounts' => $BookingCounts,				  
															  'FlightDetails_Key' => $FlightDetails_Key,					 
															  'OriginTerminal' => $OriginTerminal, 
															  'DestinationTerminal' => $DestinationTerminal,
															  'BookingCode' => $BookingCode,					 
															  'CabinClass' => $CabinClass, 
															  'FareInfoRef' => $FareInfoRef,
															  'PlatingCarrier' => $PlatingCarrier,
															  'Trip_Type' => $this->tripType,
                                                              'Mode' => 'onward',
															  'Admin_Markup' => $this->adminMarkup,
															   'Agent_Markup' => $this->agentMarkup,
															  'Payment_Charge' => ''
															);	
											
											$lp++;
								
								$Stops++;
								
							}		
							
						}
						else
						{
							$AirSegmentRef_attr 	= $AirSegmentRef['@attributes'];
							$AirSegmentRef_Key 		= $AirSegmentRef_attr['Key'];	
							
							for($k=0;$k< count($AirSegment);$k++)
							{
								$AirSegment_attr =  $AirSegment[$k]['@attributes'];										
								$AirSegment_Key = $AirSegment_attr['Key'];
								
								if($AirSegment_Key == $AirSegmentRef_Key)	
								{
									$Group = $AirSegment_attr['Group'];									
									$Carrier = $AirSegment_attr['Carrier'];
									$FlightNumber = $AirSegment_attr['FlightNumber'];
									$Origin = $AirSegment_attr['Origin'];
									$Destination = $AirSegment_attr['Destination'];
									$DepartureTime = $AirSegment_attr['DepartureTime'];
									$ArrivalTime = $AirSegment_attr['ArrivalTime'];
									$FlightTime = $AirSegment_attr['FlightTime'];
									$Distance = $AirSegment_attr['Distance'];
									$ETicketability = $AirSegment_attr['ETicketability'];
									$Equipment = $AirSegment_attr['Equipment'];
									$ChangeOfPlane = $AirSegment_attr['ChangeOfPlane'];
									$ParticipantLevel = $AirSegment_attr['ParticipantLevel'];
									
									$LinkAvailability = '';
									if(isset($AirSegment_attr['LinkAvailability']))
										$LinkAvailability = $AirSegment_attr['LinkAvailability'];
											
									$PolledAvailabilityOption = $AirSegment_attr['PolledAvailabilityOption'];
									$OptionalServicesIndicator = $AirSegment_attr['OptionalServicesIndicator'];		
									
									$AvailabilitySource = '';
									if(isset( $AirSegment_attr['AvailabilitySource']))	
										$AvailabilitySource = $AirSegment_attr['AvailabilitySource'];
										
									
									if(isset($AirSegment[$k]['air:CodeshareInfo']) && is_array($AirSegment[$k]['air:CodeshareInfo'])) 
									{
											$CodeshareInfo_attr =  $AirSegment[$k]['air:CodeshareInfo']['@attributes'];	
											$OperatingCarrier = $CodeshareInfo_attr['OperatingCarrier'];	

											$OperatingFlightNumber = '';
											if(isset($CodeshareInfo_attr['OperatingFlightNumber']))	
													$OperatingFlightNumber = $CodeshareInfo_attr['OperatingFlightNumber'];		
									}
									else if(isset($AirSegment[$k]['air:CodeshareInfo']))
									{
											$OperatingCarrier = $AirSegment[$k]['air:CodeshareInfo'];
											$OperatingFlightNumber = '';
									}
									else
									{
										$OperatingCarrier = '';
										$OperatingFlightNumber = '';
									}
									
									$ProviderCode = '';$BookingCounts = '';
									if(isset($AirSegment[$k]['air:AirAvailInfo'])) 
									{
										$ProviderCode = $AirSegment[$k]['air:AirAvailInfo']['@attributes']['ProviderCode'];
										$BookingCodeInfo_attr =  $AirSegment[$k]['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
										$BookingCounts = $BookingCodeInfo_attr['BookingCounts'];											
									}
									if(isset($AirSegment[$k]['air:FlightDetailsRef']['@attributes'])){
									$FlightDetailsRef_Key =  $AirSegment[$k]['air:FlightDetailsRef']['@attributes']['Key'];	
									}else{
                                                                        $FlightDetailsRef_Key ='';
                                                                         }
									for($l=0;$l< count($FlightDetails);$l++)
									{
										$FlightDetails_attr =  $FlightDetails[$l]['@attributes'];										
										$FlightDetails_Key = $FlightDetails_attr['Key'];
										
										if($FlightDetails_Key == $FlightDetailsRef_Key)	
										{
											//$Equipment = $FlightDetails_attr['Equipment'];													
											$OriginTerminal = '';$DestinationTerminal = '';
											if(isset($FlightDetails_attr['OriginTerminal']))
												$OriginTerminal = $FlightDetails_attr['OriginTerminal'];
											if(isset($FlightDetails_attr['DestinationTerminal']))
												$DestinationTerminal = $FlightDetails_attr['DestinationTerminal'];	
																								
											break;
										}
										
									}
									
									break;
									
								}
								
							}	
							
							$BookingInfo_attr = $BookingInfo['@attributes'];	
									
							$BookingCode = $BookingInfo_attr['BookingCode'];
							$CabinClass = $BookingInfo_attr['CabinClass'];
							$FareInfoRef = $BookingInfo_attr['FareInfoRef'];
							
							$insertFlightsData[$lp] = array('session_id' => $this->sess_id, 
															  'AirPricingSolution_Key' => $AirPricingSolution_Key, 
															  'api' => $this->api,					  
															  'CurrencyType' => $CurrencyType, 
															  'TotalPrice' => $TotalPrice,
															  'TotalPriceMarkup' => $TotalPriceAdminAgentMarkup,
															  'TotalPriceAdminMarkup' => $TotalPriceAdminMarkup, 
															  'BasePrice' => $BasePrice, 
															  'TaxPrice' => $Taxes, 
															  'Adults' => $this->adults, 
															  'Childs' => $this->childs, 
															  'Infants' => $this->infants,
															  'BasePrice_Breakdown' => $Pass_BasePrice, 
															  'TaxPrice_Breakdown' => $Pass_Taxes, 
															  'FareType' => $FareType,
															  'Total_Duration' => $Total_Duration, 
															  'AirSegment_Key' => $AirSegment_Key,						  
															  'Group' => $Group, 
															  'Carrier' => $Carrier,
															  'FlightNumber' => $FlightNumber,
															  'DepartureCode' => $Origin,
															  'ArrivalCode' => $Destination,
															  'DepartureDateTime' => $DepartureTime,					   
															  'ArrivalDateTime' => $ArrivalTime, 
															  'FlightTime' => $FlightTime,					 
															  'Distance' => $Distance,			  
															  'ETicketability' => $ETicketability, 				 
															  'Equipment' => $Equipment, 
															  'ChangeOfPlane' => $ChangeOfPlane, 
															  'ParticipantLevel' => $ParticipantLevel, 
															  'Stops' => $Stops, 
															  'LinkAvailability' => $LinkAvailability,
															  'PolledAvailabilityOption' => $PolledAvailabilityOption,
															  'OptionalServicesIndicator' => $OptionalServicesIndicator,
															  'AvailabilitySource' => $AvailabilitySource, 
															  'OperatingCarrier' => $OperatingCarrier, 
															  'OperatingFlightNumber' => $OperatingFlightNumber,
															  'ProviderCode' => $ProviderCode, 
															  'BookingCounts' => $BookingCounts,					  
															  'FlightDetails_Key' => $FlightDetails_Key,					 
															  'OriginTerminal' => $OriginTerminal, 
															  'DestinationTerminal' => $DestinationTerminal,
															  'BookingCode' => $BookingCode,					 
															  'CabinClass' => $CabinClass, 
															  'FareInfoRef' => $FareInfoRef,
															  'PlatingCarrier' => $PlatingCarrier,
															  'Trip_Type' => $this->tripType,
                                                              'Mode' => 'onward',
															  'Admin_Markup' => $this->adminMarkup,
															   'Agent_Markup' => $this->agentMarkup,
															  'Payment_Charge' => ''
															);	
											
											$lp++;					
							
						}							
						
					}
				}
								
				//Delete temp search data
				$this->Travelport_Model->delete_flight_temp_result($this->sess_id);
				
				//Insert New flight search results
				$this->Travelport_Model->insert_flight_temp_results($insertFlightsData);
				
				//Fetch and display flight results
				$this->fetch_multicity_flight_search_results();
			
			}
			else
			{				
				redirect('flights/multi_results');
			}
		}		
	}
	
	public function fetch_multicity_flight_search_results()
	{		
		$flight_result = $this->Travelport_Model->fetch_multicity_search_result($this->sess_id);
		if(empty($flight_result))
		{				
			$this->session->unset_userdata('flight_search_activate');
		}
		//echo '<pre/>';print_r($flight_result);exit;
		$data['result'] = $flight_result;
		$flight_search_result = $this->load->view('flight/multicity_search_result_ajax', $data, TRUE);
		
		echo json_encode(array("flight_search_result" => $flight_search_result));
        
	}
	
	public function MultiCityAirLowFareSearchRQ()
	{           
		$MultiSearchAirLeg = '';
		for($m=0;$m < count($this->fromCity);$m++)
		{ 
                    $fromCityCode = $this->getAirportCode($this->fromCity[$m]);
                    $toCityCode = $this->getAirportCode($this->toCity[$m]);
                    $departDate = date('Y-m-d',strtotime(str_replace('/', '-', $this->departDate[$m])));
                    
                    $MultiSearchAirLeg .= '<SearchAirLeg>
				<SearchOrigin>
				  <CityOrAirport Code="'.$fromCityCode.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
				</SearchOrigin>
				<SearchDestination>
				  <CityOrAirport Code="'.$toCityCode.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
				</SearchDestination>
				<SearchDepTime PreferredTime="'.$departDate.'T'.$this->departTime.'" ></SearchDepTime>
				<AirLegModifiers>
				  <PreferredCabins>
					<CabinClass Type="'.$this->cabinClass.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CabinClass>
				  </PreferredCabins>
				</AirLegModifiers>
			</SearchAirLeg>';           
                }
		
		$adults = '';
		if($this->adults != 0)
		{
			for($a=0;$a < $this->adults;$a++)
			{
				$adults .= '<SearchPassenger Code="ADT" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
			}
		}
		
		$childs = '';
		if($this->childs != 0)
		{
			for($c=0;$c < $this->childs;$c++)
			{
				$childs .= '<SearchPassenger Code="CNN" Age="10" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
			}
		}
		
		$infants = '';
		if($this->infants != 0)
		{
			for($in=0;$in < $this->infants;$in++)
			{
				$infants .= '<SearchPassenger Code="INF" Age="1" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
			}
		}
		
		$MultiLowFareSearchReqXML = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
			  <s:Header>
				<Action s:mustUnderstand="1" xmlns="http://schemas.microsoft.com/ws/2005/05/addressing/none">http://localhost:8080/kestrel/AirService</Action>
			  </s:Header>
			  <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
				<LowFareSearchReq TargetBranch="'.$this->targetBranch.'" xmlns="http://www.travelport.com/schema/air_v28_0">
				 <BillingPointOfSaleInfo OriginApplication="UAPI" xmlns="http://www.travelport.com/schema/common_v28_0" ></BillingPointOfSaleInfo>
                                    '.$MultiSearchAirLeg.'
				  <AirSearchModifiers>
					<PreferredProviders>
					  <Provider Code="1G" xmlns="http://www.travelport.com/schema/common_v28_0" ></Provider>
					</PreferredProviders>
				  </AirSearchModifiers>
				  '.$adults.'
				  '.$childs.'
				  '.$infants.'
				</LowFareSearchReq>
			  </s:Body>
			</s:Envelope>';
		
		//echo $MultiLowFareSearchReqXML;
		
		$MultiLowFareSearchRes = $this->processRequest($MultiLowFareSearchReqXML);
		//echo $MultiLowFareSearchRes;exit;
		return $MultiLowFareSearchRes;
		
	}
		
	public function flight_itinerary($searchId)
    {	
		$this->set_variables();
			
                $data['flight_result'] = $flight_result = $this->Travelport_Model->get_flight_search_result($searchId);	
		
		$data['flight_segments'] = $flight_segments = $this->Travelport_Model->get_flight_segments($flight_result->session_id,$flight_result->AirPricingSolution_Key,$flight_result->Mode);		
		//echo '<pre/>xml';print_r($flight_segments);exit;
				
				 $data['flight_result_r'] = '';  
                $data['flight_segments_r'] = $flight_segments_r = '';
                if($flight_result->Trip_Type == 'R')
                {
                    $flight_result_r = $this->Travelport_Model->fetch_roundtrip_search_result($flight_result->session_id,$flight_result->AirPricingSolution_Key);	
					$data['flight_result_r'] = $flight_result_r;
					
                    $data['flight_segments_r'] = $flight_segments_r =  $this->Travelport_Model->get_flight_segments($flight_result_r->session_id,$flight_result_r->AirPricingSolution_Key,$flight_result_r->Mode);
		    //echo '<pre/>';print_r($flight_segments_r);exit;
                }
		
                
		
		$AirPriceRS = $this->AirPriceRequest($flight_segments,$flight_segments_r);
		//echo '<pre/>xml';print_r($AirPriceRS); exit;
		
		$AirPriceRS = str_replace('SOAP:','',$AirPriceRS);
		$AirPriceRS = str_replace('air:','',$AirPriceRS);
		$AirPriceRS_obj = new SimpleXMLElement($AirPriceRS);
		//echo '<pre/>xml';print_r($AirPriceRS_obj);exit;
		
		if(isset($AirPriceRS_obj->Body->AirPriceRsp->AirPriceResult))
		{
			$AirItinerary =  $AirPriceRS_obj->Body->AirPriceRsp->AirItinerary;
			$AirItinerary_xml =  $AirItinerary->asXML();
			//echo '<pre/>xml';print_r($AirItinerary_xml);
			
			$AirPricingSolution = $AirPriceRS_obj->Body->AirPriceRsp->AirPriceResult->AirPricingSolution;			
			unset($AirPricingSolution->AirSegmentRef);
			$AirPricingSolution_xml = $AirPricingSolution->asXML();
			//echo '<pre/>xml';print_r($AirPricingSolution_xml);exit;
			
			$TotalPrice = (string)$AirPricingSolution['TotalPrice'];
			
			if(isset($AirPricingSolution['EquivalentBasePrice']))
				$BasePrice = (string)$AirPricingSolution['EquivalentBasePrice'];
			else
				$BasePrice = (string)$AirPricingSolution['ApproximateBasePrice'];
				
			$Taxes = (string)$AirPricingSolution['Taxes'];				
					
			$update_data = array('TotalPrice' => $TotalPrice,'BasePrice' => $BasePrice,'TaxPrice' => $Taxes,'AirItinerary_xml' => $AirItinerary_xml, 'AirPricingSolution_xml' => $AirPricingSolution_xml);
			//echo '<pre/>xml';print_r($update_data);		exit;		
			$this->Travelport_Model->update_flight_price_details($update_data,$searchId);
			
		}
		if($AirItinerary_xml=='' && $AirPricingSolution_xml==''){
			$response = array('status'=>'0','msg'=>'Sorry flight has not confirmed, Please do the process again');
		}else{
			$response = array('status'=>'1','msg'=>'Flight confirmed, Please go a head');
		}
		return json_encode($response);
		//echo '<pre/>xml';print_r($data);		exit;	
		//$this->load->view('flight/confirm_itinerary',$data);			
		
	}
	
	public function flight_multi_itinerary($searchId)
    {	
		$this->set_multisearch_variables();
			
                $data['flight_result'] = $flight_result = $this->Travelport_Model->get_flight_search_result($searchId);	
		
		$data['flight_segments'] = $flight_segments = $this->Travelport_Model->get_multi_flight_segments($flight_result->session_id,$flight_result->AirPricingSolution_Key);		
		//echo '<pre/>xml';print_r($flight_segments);exit;
				
		$data['flight_segments_r'] = $flight_segments_r = '';               
		
		$AirPriceRS = $this->AirPriceRequest($flight_segments,$flight_segments_r);
		//echo '<pre/>xml';print_r($AirPriceRS); exit;
		
		$AirPriceRS = str_replace('SOAP:','',$AirPriceRS);
		$AirPriceRS = str_replace('air:','',$AirPriceRS);
		$AirPriceRS_obj = new SimpleXMLElement($AirPriceRS);
		//echo '<pre/>xml';print_r($AirPriceRS_obj);exit;
		
		if(isset($AirPriceRS_obj->Body->AirPriceRsp->AirPriceResult))
		{
			$AirItinerary =  $AirPriceRS_obj->Body->AirPriceRsp->AirItinerary;
			$AirItinerary_xml =  $AirItinerary->asXML();
			//echo '<pre/>xml';print_r($AirItinerary_xml);
			
			$AirPricingSolution = $AirPriceRS_obj->Body->AirPriceRsp->AirPriceResult->AirPricingSolution;			
			unset($AirPricingSolution->AirSegmentRef);
			$AirPricingSolution_xml = $AirPricingSolution->asXML();
			//echo '<pre/>xml';print_r($AirPricingSolution_xml);exit;
			
			$TotalPrice = (string)$AirPricingSolution['TotalPrice'];
			
			if(isset($AirPricingSolution['EquivalentBasePrice']))
				$BasePrice = (string)$AirPricingSolution['EquivalentBasePrice'];
			else
				$BasePrice = (string)$AirPricingSolution['ApproximateBasePrice'];
				
			$Taxes = (string)$AirPricingSolution['Taxes'];				
					
			$update_data = array('TotalPrice' => $TotalPrice,'BasePrice' => $BasePrice,'TaxPrice' => $Taxes,'AirItinerary_xml' => $AirItinerary_xml, 'AirPricingSolution_xml' => $AirPricingSolution_xml);
			//echo '<pre/>xml';print_r($update_data);		exit;		
			$this->Travelport_Model->update_flight_price_details($update_data,$searchId);
			
		}
		//echo '<pre/>xml';print_r($data);		exit;	
		//$this->load->view('flight/confirm_multi_itinerary',$data);			
		
	}
        
      
    public function confirm_reservation($searchId)
    {	
		$this->set_variables();
			
        $data['flight_result'] = $flight_result = $this->Travelport_Model->get_flight_search_result($searchId);	
		//echo '<pre/>xml';print_r($flight_result);exit;
		
		$AirItinerary_xml = $flight_result->AirItinerary_xml;
		$AirPricingSolution_xml = $flight_result->AirPricingSolution_xml;
		
		$data['flight_segments'] = $flight_segments = $this->Travelport_Model->get_flight_segments($flight_result->session_id,$flight_result->AirPricingSolution_Key,$flight_result->Mode);
        //echo '<pre/>xml';print_r($flight_segments);exit;
        
             
		$data['flight_segments_r'] = $flight_segments_r = '';
		if($flight_result->Trip_Type == 'R')
		{
			$flight_result_r = $this->Travelport_Model->fetch_roundtrip_search_result($flight_result->session_id,$flight_result->AirPricingSolution_Key);	
						
			$data['flight_segments_r'] = $flight_segments_r =  $this->Travelport_Model->get_flight_segments($flight_result_r->session_id,$flight_result_r->AirPricingSolution_Key,$flight_result_r->Mode);
			//echo '<pre/>';print_r($flight_segments_r);exit;
		}
		
		$AirItinerary_xml = str_replace('<AirItinerary>','',$AirItinerary_xml);
		$AirItinerary_xml = str_replace('</AirItinerary>','',$AirItinerary_xml);
		
		 $AirPricingSolution_xml = str_replace('common_v28_0:','',$AirPricingSolution_xml);
		 
                
                $doc = new DOMDocument();
                $doc->loadXML($AirPricingSolution_xml);
                $fragment = $doc->createDocumentFragment();
                $fragment->appendXML($AirItinerary_xml);              
                $AirPricingInfo  = $doc->getElementsByTagName("AirPricingInfo")->item(0);
                $doc->documentElement->insertBefore($fragment,$AirPricingInfo);                  
             
                // Removing Endorsement tag
                $xp = new DOMXPath($doc);
                foreach($xp->query('//Endorsement') as $key => $tn)
                {
                    $tn->parentNode->removeChild($tn);
                }
                
                // Adding BookingTravelerRef for Passengers
                $PassengerType = $xp->evaluate("/AirPricingSolution/AirPricingInfo//PassengerType");
                for ($i = 0; $i < $PassengerType->length; $i++) {
                        $Passenger = $PassengerType->item($i);                                             
                        $Passenger->setAttribute("BookingTravelerRef", $i);
                }
                
               

                $AirPricingSolution_xml = str_replace('<?xml version="1.0"?>','',$doc->saveXML());
                //echo '<pre/>xml';print_r($AirPricingSolution_xml);exit;
		
		$AirBookRS = $this->AirCreateReservationRQ($AirPricingSolution_xml);
		//echo '<pre/>xml';print_r($AirBookRS);
		
		$AirBookRS = str_replace('SOAP:','',$AirBookRS);
		$AirBookRS = str_replace('air:','',$AirBookRS);
		$AirBookRS = str_replace('universal:','',$AirBookRS);
		$AirBookRS = str_replace('common_v28_0:','',$AirBookRS);
		
		$AirBookRS_obj = new SimpleXMLElement($AirBookRS);
		//echo '<pre/>xml';print_r($AirBookRS_obj);exit;
						
		$BookingStatus = 'Fail';
		$LocatorCode = '';$Status = '';
		$ProviderLocatorCode = '';$SupplierLocatorCode= '';
		$AirReservationLocatorCode = '';$ProviderReservationInfoRef= '';
		$BookingTravelerRef = '';
		if(!empty($AirBookRS_obj))
		{
			if(isset($AirBookRS_obj->Body->AirCreateReservationRsp->UniversalRecord))
			{
				$UniversalRecord = $AirBookRS_obj->Body->AirCreateReservationRsp->UniversalRecord;
								
				$LocatorCode = (string)$UniversalRecord['LocatorCode'];
				$Status = (string)$UniversalRecord['Status'];
				
                $ProviderReservationInfo = $UniversalRecord->ProviderReservationInfo;
				$ProviderLocatorCode = (string)$ProviderReservationInfo['LocatorCode'];
                $ProviderCode = (string)$ProviderReservationInfo['ProviderCode'];
                                
                $AirReservation = $UniversalRecord->AirReservation;
				$AirReservationLocatorCode = (string)$AirReservation['LocatorCode'];
                                
				$SupplierLocator = $AirReservation->SupplierLocator;
				if(isset($SupplierLocator[0])) 
				{
					$SupplierCode = (string)$SupplierLocator[0]['SupplierCode'];
					$SupplierLocatorCode = (string)$SupplierLocator[0]['SupplierLocatorCode'];
					$ProviderReservationInfoRef = (string)$SupplierLocator[0]['ProviderReservationInfoRef'];
				}
				else
				{
					$SupplierCode = (string)$SupplierLocator['SupplierCode'];
					$SupplierLocatorCode = (string)$SupplierLocator['SupplierLocatorCode'];
					$ProviderReservationInfoRef = (string)$SupplierLocator['ProviderReservationInfoRef'];
				}
				
				$TravelerRef_arr = array();
				$BookingTravelerRef_arr = $AirReservation->BookingTravelerRef;
				foreach($BookingTravelerRef_arr as $travelref)
				{
					$TravelerRef_arr[] = (string)$travelref['Key'];
				}
				
				$BookingTravelerRef = implode(',',$TravelerRef_arr);
				
				$BookingStatus = 'Success';  
				$Remarks = 'No remarks'; 
				                             
             }
             else
             {
				 $ErrorInfo = $AirBookRS_obj->Body->Fault->detail->ErrorInfo;
				 $Remarks = (string)$ErrorInfo->Description;
			 }
		}
                
        $SysRefNo = $this->generateReferenceNo(8);	
		$this->Travelport_Model->insert_booking_report($SysRefNo,$LocatorCode,$Status,$ProviderLocatorCode,$AirReservationLocatorCode,$SupplierLocatorCode,$ProviderReservationInfoRef,$BookingTravelerRef,$BookingStatus,$Remarks,$flight_segments,$flight_segments_r);
		$this->Travelport_Model->insert_booking_passenger_info($SysRefNo);
		$this->flight = new Flights();	
		//redirect('flights/flight_eticket/'.$SysRefNo,'refresh');	
		echo $this->flight->flight_eticket($SysRefNo);
		
		
	}
	
	public function confirm_multi_reservation($searchId)
    {	
		$this->set_multisearch_variables();
			
        $data['flight_result'] = $flight_result = $this->Travelport_Model->get_flight_search_result($searchId);	
		 //echo '<pre/>xml';print_r($flight_result);exit;
		
		$AirItinerary_xml = $flight_result->AirItinerary_xml;
		$AirPricingSolution_xml = $flight_result->AirPricingSolution_xml;
		
		$data['flight_segments'] = $flight_segments = $this->Travelport_Model->get_multi_flight_segments($flight_result->session_id,$flight_result->AirPricingSolution_Key);
        //echo '<pre/>xml';print_r($flight_segments);exit;
        
             
		$data['flight_segments_r'] = $flight_segments_r = '';
				
		$AirItinerary_xml = str_replace('<AirItinerary>','',$AirItinerary_xml);
		$AirItinerary_xml = str_replace('</AirItinerary>','',$AirItinerary_xml);
		
		 $AirPricingSolution_xml = str_replace('common_v28_0:','',$AirPricingSolution_xml);
		 
                
                $doc = new DOMDocument();
                $doc->loadXML($AirPricingSolution_xml);
                $fragment = $doc->createDocumentFragment();
                $fragment->appendXML($AirItinerary_xml);              
                $AirPricingInfo  = $doc->getElementsByTagName("AirPricingInfo")->item(0);
                $doc->documentElement->insertBefore($fragment,$AirPricingInfo);                  
             
                // Removing Endorsement tag
                $xp = new DOMXPath($doc);
                foreach($xp->query('//Endorsement') as $key => $tn)
                {
                    $tn->parentNode->removeChild($tn);
                }
                
                // Adding BookingTravelerRef for Passengers
                $PassengerType = $xp->evaluate("/AirPricingSolution/AirPricingInfo//PassengerType");
                for ($i = 0; $i < $PassengerType->length; $i++) {
                        $Passenger = $PassengerType->item($i);                                             
                        $Passenger->setAttribute("BookingTravelerRef", $i);
                }
                
               

                $AirPricingSolution_xml = str_replace('<?xml version="1.0"?>','',$doc->saveXML());
                //echo '<pre/>xml';print_r($AirPricingSolution_xml);exit;
		
		$AirBookRS = $this->AirCreateReservationRQ($AirPricingSolution_xml);
		//echo '<pre/>xml';print_r($AirBookRS);
		
		$AirBookRS = str_replace('SOAP:','',$AirBookRS);
		$AirBookRS = str_replace('air:','',$AirBookRS);
		$AirBookRS = str_replace('universal:','',$AirBookRS);
		$AirBookRS = str_replace('common_v28_0:','',$AirBookRS);
		
		$AirBookRS_obj = new SimpleXMLElement($AirBookRS);
		//echo '<pre/>xml';print_r($AirBookRS_obj);exit;
						
		$BookingStatus = 'Fail';
		$LocatorCode = '';$Status = '';
		$ProviderLocatorCode = '';$SupplierLocatorCode= '';
		$AirReservationLocatorCode = '';$ProviderReservationInfoRef= '';
		$BookingTravelerRef = '';
		if(!empty($AirBookRS_obj))
		{
			if(isset($AirBookRS_obj->Body->AirCreateReservationRsp->UniversalRecord))
			{
				$UniversalRecord = $AirBookRS_obj->Body->AirCreateReservationRsp->UniversalRecord;
								
				$LocatorCode = (string)$UniversalRecord['LocatorCode'];
				$Status = (string)$UniversalRecord['Status'];
				
                $ProviderReservationInfo = $UniversalRecord->ProviderReservationInfo;
				$ProviderLocatorCode = (string)$ProviderReservationInfo['LocatorCode'];
                $ProviderCode = (string)$ProviderReservationInfo['ProviderCode'];
                                
                $AirReservation = $UniversalRecord->AirReservation;
				$AirReservationLocatorCode = (string)$AirReservation['LocatorCode'];
                                
				$SupplierLocator = $AirReservation->SupplierLocator;
				if(isset($SupplierLocator[0])) 
				{
					$SupplierCode = (string)$SupplierLocator[0]['SupplierCode'];
					$SupplierLocatorCode = (string)$SupplierLocator[0]['SupplierLocatorCode'];
					$ProviderReservationInfoRef = (string)$SupplierLocator[0]['ProviderReservationInfoRef'];
				}
				else
				{
					$SupplierCode = (string)$SupplierLocator['SupplierCode'];
					$SupplierLocatorCode = (string)$SupplierLocator['SupplierLocatorCode'];
					$ProviderReservationInfoRef = (string)$SupplierLocator['ProviderReservationInfoRef'];
				}
				
				$TravelerRef_arr = array();
				$BookingTravelerRef_arr = $AirReservation->BookingTravelerRef;
				foreach($BookingTravelerRef_arr as $travelref)
				{
					$TravelerRef_arr[] = (string)$travelref['Key'];
				}
				
				$BookingTravelerRef = implode(',',$TravelerRef_arr);
				
				$BookingStatus = 'Success';  
				$Remarks = 'No remarks'; 
				                             
             }
             else
             {
				 $ErrorInfo = $AirBookRS_obj->Body->Fault->detail->ErrorInfo;
				 $Remarks = (string)$ErrorInfo->Description;
			 }
		}
                
        $SysRefNo = $this->generateReferenceNo(8);		
		$this->Travelport_Model->insert_booking_report($SysRefNo,$LocatorCode,$Status,$ProviderLocatorCode,$AirReservationLocatorCode,$SupplierLocatorCode,$ProviderReservationInfoRef,$BookingTravelerRef,$BookingStatus,$Remarks,$flight_segments,$flight_segments_r);
		$this->Travelport_Model->insert_booking_passenger_info($SysRefNo);
				
		//redirect('flights/flight_multi_eticket/'.$SysRefNo,'refresh');
		$this->flight = new Flights();	
		echo $this->flight->flight_multi_eticket($SysRefNo);		
		
	}
        
   
	public function AirPriceRequest($flight_segments,$flight_segments_r='')
	{
		$AirSegment = '';
		foreach($flight_segments as $seg) 
		{
			$LinkAvailability = '';
			if($seg->LinkAvailability != '')
			{
				$LinkAvailability = 'LinkAvailability="'.$seg->LinkAvailability.'"';
			}
			
			$AvailabilitySource = '';
			if($seg->AvailabilitySource != '')
			{
				$AvailabilitySource = 'AvailabilitySource="'.$seg->AvailabilitySource.'"';
			}
			
			if($seg->OperatingFlightNumber != '')
			{
				$CodeshareInfo = '<CodeshareInfo OperatingCarrier="'.$seg->OperatingCarrier.'" OperatingFlightNumber="'.$seg->OperatingFlightNumber.'" ></CodeshareInfo>';
			}
			else
			{
				$CodeshareInfo = '<CodeshareInfo>'.$seg->OperatingCarrier.'</CodeshareInfo>';
			}
			
			$OriginTerminal = '';
			if($seg->OriginTerminal != '')
			{
				$OriginTerminal = 'OriginTerminal="'.$seg->OriginTerminal.'"';
			}
			
			$DestinationTerminal = '';
			if($seg->DestinationTerminal != '')
			{
				$DestinationTerminal = 'DestinationTerminal="'.$seg->DestinationTerminal.'"';
			}
			
                    $AirSegment .= '<AirSegment Key="'.$seg->AirSegment_Key.'" ClassOfService="'.$seg->BookingCode.'" ETicketability="'.$seg->ETicketability.'" Equipment="'.$seg->Equipment.'" ChangeOfPlane="'.$seg->ChangeOfPlane.'" '.$AvailabilitySource.' OptionalServicesIndicator="'.$seg->OptionalServicesIndicator.'" PolledAvailabilityOption="'.$seg->PolledAvailabilityOption.'" Origin="'.$seg->DepartureCode.'" Destination="'.$seg->ArrivalCode.'" DepartureTime="'.$seg->DepartureDateTime.'" FlightNumber="'.$seg->FlightNumber.'" Group="'.$seg->Group.'" Carrier="'.$seg->Carrier.'" ArrivalTime="'.$seg->ArrivalDateTime.'" ParticipantLevel="'.$seg->ParticipantLevel.'" '.$LinkAvailability.' ProviderCode="'.$seg->ProviderCode.'" FlightTime="'.$seg->FlightTime.'" Distance="'.$seg->Distance.'">
                '.$CodeshareInfo.'
                <AirAvailInfo ProviderCode="'.$seg->ProviderCode.'">
                    <BookingCodeInfo BookingCounts="'.$seg->BookingCounts.'"></BookingCodeInfo>
                </AirAvailInfo>
                <FlightDetails Equipment="'.$seg->Equipment.'" '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$seg->ArrivalCode.'" Origin="'.$seg->DepartureCode.'" Key="'.$seg->FlightDetails_Key.'" FlightTime="'.$seg->FlightTime.'" ArrivalTime="'.$seg->ArrivalDateTime.'" DepartureTime="'.$seg->DepartureDateTime.'" ></FlightDetails>
                </AirSegment>';
		
            }
        
        if(!empty($flight_segments_r))
        {
            foreach($flight_segments_r as $seg_r) 
            {
			$LinkAvailability = '';
			if($seg_r->LinkAvailability != '')
			{
				$LinkAvailability = 'LinkAvailability="'.$seg_r->LinkAvailability.'"';
			}
			
			$AvailabilitySource = '';
			if($seg_r->AvailabilitySource != '')
			{
				$AvailabilitySource = 'AvailabilitySource="'.$seg_r->AvailabilitySource.'"';
			}
			
			if($seg_r->OperatingFlightNumber != '')
			{
				$CodeshareInfo = '<CodeshareInfo OperatingCarrier="'.$seg_r->OperatingCarrier.'" OperatingFlightNumber="'.$seg_r->OperatingFlightNumber.'" ></CodeshareInfo>';
			}
			else
			{
				$CodeshareInfo = '<CodeshareInfo>'.$seg_r->OperatingCarrier.'</CodeshareInfo>';
			}
			
			$OriginTerminal = '';
			if($seg_r->OriginTerminal != '')
			{
				$OriginTerminal = 'OriginTerminal="'.$seg_r->OriginTerminal.'"';
			}
			
			$DestinationTerminal = '';
			if($seg_r->DestinationTerminal != '')
			{
				$DestinationTerminal = 'DestinationTerminal="'.$seg_r->DestinationTerminal.'"';
			}
			
                    $AirSegment .= '<AirSegment Key="'.$seg_r->AirSegment_Key.'" ClassOfService="'.$seg_r->BookingCode.'" ETicketability="'.$seg_r->ETicketability.'" Equipment="'.$seg_r->Equipment.'" ChangeOfPlane="'.$seg_r->ChangeOfPlane.'" '.$AvailabilitySource.' OptionalServicesIndicator="'.$seg_r->OptionalServicesIndicator.'" PolledAvailabilityOption="'.$seg_r->PolledAvailabilityOption.'" Origin="'.$seg_r->DepartureCode.'" Destination="'.$seg_r->ArrivalCode.'" DepartureTime="'.$seg_r->DepartureDateTime.'" FlightNumber="'.$seg_r->FlightNumber.'" Group="'.$seg_r->Group.'" Carrier="'.$seg_r->Carrier.'" ArrivalTime="'.$seg_r->ArrivalDateTime.'" ParticipantLevel="'.$seg_r->ParticipantLevel.'" '.$LinkAvailability.' ProviderCode="'.$seg_r->ProviderCode.'" FlightTime="'.$seg_r->FlightTime.'" Distance="'.$seg_r->Distance.'">
                '.$CodeshareInfo.'
                <AirAvailInfo ProviderCode="'.$seg_r->ProviderCode.'">
                    <BookingCodeInfo BookingCounts="'.$seg_r->BookingCounts.'"></BookingCodeInfo>
                </AirAvailInfo>
                <FlightDetails Equipment="'.$seg_r->Equipment.'" '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$seg_r->ArrivalCode.'" Origin="'.$seg_r->DepartureCode.'" Key="'.$seg_r->FlightDetails_Key.'" FlightTime="'.$seg_r->FlightTime.'" ArrivalTime="'.$seg_r->ArrivalDateTime.'" DepartureTime="'.$seg_r->DepartureDateTime.'" ></FlightDetails>
                </AirSegment>';
		
            }
        }
	$paxId=0;	
        $adults = '';
        if($this->adults != 0)
        {
                for($a=0;$a < $this->adults;$a++)
                {
                        $adults .= '<SearchPassenger BookingTravelerRef="'.$paxId.'" Code="ADT" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
               		$paxId++;
		}
        }

        $childs = '';
        if($this->childs != 0)
        {
                for($c=0;$c < $this->childs;$c++)
                {
                        $childs .= '<SearchPassenger BookingTravelerRef="'.$paxId.'" Code="CNN" Age="10" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
                	$paxId++;
		}
        }

        $infants = '';
        if($this->infants != 0)
        {
                for($in=0;$in < $this->infants;$in++)
                {
                        $infants .= '<SearchPassenger BookingTravelerRef="'.$paxId.'" Code="INF" Age="1" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
			$paxId++;                
		}
        }
        
        $AirPricingModifiers = '';
        if($flight_segments[0]->PlatingCarrier != '')
        {
            $AirPricingModifiers .= '<AirPricingModifiers PlatingCarrier="'.$flight_segments[0]->PlatingCarrier.'" ></AirPricingModifiers>';
        }
		
	$AirPriceRQXml = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
				  <s:Header>
					<Action s:mustUnderstand="1" xmlns="http://schemas.microsoft.com/ws/2005/05/addressing/none">http://localhost:8080/kestrel/AirService</Action>
				  </s:Header>
				  <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
					<AirPriceReq TargetBranch="'.$this->targetBranch.'" xmlns="http://www.travelport.com/schema/air_v28_0">
					  <BillingPointOfSaleInfo OriginApplication="UAPI" xmlns="http://www.travelport.com/schema/common_v28_0"></BillingPointOfSaleInfo>
					  <AirItinerary>
							'.$AirSegment.'
					  </AirItinerary>
					  '.$AirPricingModifiers.'
					  '.$adults.'
					  '.$childs.'
					  '.$infants.'
					  <AirPricingCommand></AirPricingCommand>
					</AirPriceReq>
				  </s:Body>
				</s:Envelope>';
		
		//echo $AirPriceRQXml;
		
		$AirPriceResponse = $this->processRequest($AirPriceRQXml);
		//echo $AirPriceResponse;exit;
		return $AirPriceResponse;
		
	}
	
	public function AirCreateReservationRQ($AirPricingSolution_xml)
	{		
		$pass_info = $this->session->userdata('pass_info');
            
                $adults = '';
                $pax = 0;
		if($this->adults != 0)
		{
			for($a=0;$a < $this->adults;$a++)
			{
                            $address = '';
                            if($a==0)
                            {
                                $address .= '<Address>
                                                <AddressName>addressName</AddressName>
                                                <Street>St Allen 25 B 1</Street>
                                                <City>Bourdeux</City>
                                                <State>CO</State>
                                                <PostalCode>81818</PostalCode>
                                                <Country>ES</Country>
                                            </Address>';
                            }
				$adults .= '<BookingTraveler Key="'.$pax.'" TravelerType="ADT" xmlns="http://www.travelport.com/schema/common_v28_0">
                                                <BookingTravelerName Prefix="'.$pass_info['saladult'][$a].'" First="'.$pass_info['fnameadult'][$a].'" Last="'.$pass_info['lnameadult'][$a].'" ></BookingTravelerName>
                                                <PhoneNumber Number="'.$pass_info['user_mobile'].'" Type="Mobile" ></PhoneNumber>
                                                <Email EmailID="'.$pass_info['user_email'].'" Type="P" ></Email>   
                                                    '.$address.'
                                            </BookingTraveler>';
                                
                                $pax++;
			}
		}
		
		$childs = '';
		if($this->childs != 0)
		{
			for($c=0;$c < $this->childs;$c++)
			{
				$childs .= '<BookingTraveler Key="'.$pax.'" TravelerType="CNN" Age="11" xmlns="http://www.travelport.com/schema/common_v28_0">
                                                <BookingTravelerName Prefix="'.$pass_info['salchild'][$c].'" First="'.$pass_info['fnamechild'][$c].'" Last="'.$pass_info['lnamechild'][$c].'" ></BookingTravelerName>
                                                <PhoneNumber Number="'.$pass_info['user_mobile'].'" Type="Mobile" ></PhoneNumber>
                                                <Email EmailID="'.$pass_info['user_email'].'" Type="P" ></Email>
                                                 <NameRemark Category="AIR">
                                                    <RemarkData>01JAN04</RemarkData>
                                                </NameRemark>
                                            </BookingTraveler>';
                                 $pax++;
			}
		}
		
		$infants = '';
		if($this->infants != 0)
		{
			for($in=0;$in < $this->infants;$in++)
			{
				$infants .= '<BookingTraveler Key="'.$pax.'" TravelerType="INF" Age="1" xmlns="http://www.travelport.com/schema/common_v28_0">
                                                <BookingTravelerName Prefix="'.$pass_info['salinfant'][$in].'" First="'.$pass_info['fnameinfant'][$in].'" Last="'.$pass_info['lnameinfant'][$in].'" ></BookingTravelerName>
                                                <PhoneNumber Number="'.$pass_info['user_mobile'].'" Type="Mobile" ></PhoneNumber>
                                                <Email EmailID="'.$pass_info['user_email'].'" Type="P" ></Email>
                                                <NameRemark Category="AIR">
                                                    <RemarkData>12FEB13</RemarkData>
                                                </NameRemark>
                                            </BookingTraveler>';
                                 $pax++;
			}
		}

		
	$AirReservationRQXml = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
                        <s:Header>
                            <Action s:mustUnderstand="1" xmlns="http://schemas.microsoft.com/ws/2005/05/addressing/none">http://localhost:8080/kestrel/AirService</Action>
                        </s:Header>
                        <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
                        <ns5:AirCreateReservationReq xmlns:ns5="http://www.travelport.com/schema/universal_v28_0" TargetBranch="'.$this->targetBranch.'" xmlns="http://www.travelport.com/schema/air_v28_0" RetainReservation="Both">    
			<AirCreateReservationReq TargetBranch="'.$this->targetBranch.'"  xmlns="http://www.travelport.com/schema/air_v28_0">
                            <BillingPointOfSaleInfo OriginApplication="UAPI" xmlns="http://www.travelport.com/schema/common_v28_0" ></BillingPointOfSaleInfo>
                            '.$adults.'
                            '.$childs.'
                            '.$infants.'
                            '.$AirPricingSolution_xml.'
                            <ActionStatus ProviderCode="1G" TicketDate="T*" Type="ACTIVE" QueueCategory="01" xmlns="http://www.travelport.com/schema/common_v28_0" ></ActionStatus>
                            </AirCreateReservationReq>
			 </ns5:AirCreateReservationReq>
                        </s:Body>
                        </s:Envelope>';
		
		//echo $AirReservationRQXml;
		
		$AirReservationRS = $this->processRequest($AirReservationRQXml);
		
		return $AirReservationRS;
		
	}		
	
	public function processRequest($requestData)
	{
		$soapAction = '';
		$Authorization = base64_encode($this->username.':'.$this->password);		
		$httpHeader = array("SOAPAction: {$soapAction}", 
						"Content-Type: text/xml; charset=UTF-8", 
						"Content-Encoding: UTF-8",
						"Authorization: Basic $Authorization",
						"Content-length: ".strlen($requestData),
						"Accept-Encoding: gzip,deflate");
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->post_url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 180);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");

		// Execute request, store response and HTTP response code
		$response = curl_exec($ch);
		$error = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		return $response;
		
	}
	
	public function getAirportCode($city)
	{		
		list($cityname, $airportCode) = explode(',',$city);		
    				
		if(!empty($airportCode))
			return $airportCode;		  		
	}
	
	public function generateReferenceNo($len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
	{
		$string = '';
		for ($i = 0; $i < $len; $i++)
		{
			$pos = rand(0, strlen($chars)-1);
			$string .= $chars{$pos};
		}
		return $string;
	}
		
}

/* End of file universal.php */
/* Location: ./application/modules/flights/universal.php */
