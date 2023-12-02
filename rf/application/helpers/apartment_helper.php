<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-09-11T11:45:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/
function AddressToGeometry($address = ''){
    $prepAddr = str_replace(' ','+',$address);
    $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyCr6U4xXBenGoPyw6ajSLekgl5EKYx_rb8&address='.$prepAddr.'&sensor=false');
    $output= json_decode($geocode);
    if($output->status == 'OK'){
        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;
    }else{
        $lat = '';
        $long = '';
    }
    $geometry = array(
        'latitude' => $lat,
        'longitude' => $long,
        'status' => $output->status
    );
    return $geometry;
}