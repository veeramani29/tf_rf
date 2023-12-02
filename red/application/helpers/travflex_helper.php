<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 global $ServiceCode="veera";
function SearchHotel(){



$xml='<?xml version="1.0" encoding="utf-8" ?>
<Service_SearchHotel>
<AgentLogin>
<AgentId>REDT</AgentId>
<LoginName>REDTTEST</LoginName>
<Password>REDTXML2018</Password>
</AgentLogin>
<SearchHotel_Request>
<PaxPassport>WSOCAU</PaxPassport>
<DestCountry>WSASTH</DestCountry>
<DestCity>WSASTHBKK</DestCity>
<HotelId></HotelId>
<ServiceCode></ServiceCode>
<Period checkIn="2018-06-12" checkOut="2018-06-15" />
<RoomInfo>
<AdultNum RoomType="Twin" RQBedChild="N">2</AdultNum>
<ChildAges>
<ChildAge>8</ChildAge>
</ChildAges>
</RoomInfo>
<RoomInfo>
<AdultNum RoomType="Twin" RQBedChild="N">2</AdultNum>
</RoomInfo>
<flagAvail/>
</SearchHotel_Request>
</Service_SearchHotel>';



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://xml.travflex.com/11WS_SP2_1/ServicePHP/SearchHotel.php');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "requestXML=" . urlencode($xml));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

   $CI =& get_instance();
   $CI->load->library('xml_to_array');
   $SearchRes = $CI->xml_to_array->XmlToArray($response);

}
 ?>
