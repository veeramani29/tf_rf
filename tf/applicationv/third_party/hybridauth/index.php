<?php


require_once( "Hybrid/Auth.php" );
require_once( "Hybrid/Endpoint.php" ); 

if (isset($_REQUEST['hauth_start']) || isset($_REQUEST['hauth_done']))
{
    Hybrid_Endpoint::process();
}
