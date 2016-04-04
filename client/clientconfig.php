<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config['base_url'] = 'http://localhost/ezolp/';
//$config['base_url'] = 'http://localhost/ezolp/';



/*
|--------------------------------------------------------------------------
| NPC INFORMATION
|--------------------------------------------------------------------------
|
*/
/***Gateway Selection (Only 1 active at a time)***/
// $config['Gateway'] = 'NPC';
$config['Gateway'] = 'NMI';
/***End Gateway Selection***/

/***NPC Gateway Settings***/
// $config['NPC_SerialNumber'] = '001515047250';
// $config['NPC_Devloper_SerialNumber'] = '984964341831';
// $config['NPC_DevRequestUrl'] = 'https://developer.skipjackic.com/scripts/evolvcc.dll?Authorize';
// $config['NPC_ProdRequestUrl'] = 'https://www.skipjackic.com/scripts/evolvcc.dll?Authorize';
/***End NPC Gateway Settings***/


/***NMI Gateway Settings***/
//Sandbox
// $config['NMI_Username'] = 'demo';
// $config['NMI_Password'] = 'password';
// $config['NMI_URL'] = 'https://securitycardservices.transactiongateway.com/api/transact.php';

//Live
$config['NMI_Username'] = 'IWATLLC';
$config['NMI_Password'] = '3Y62XYb2FpGR7eT6';
$config['NMI_URL'] = 'https://securitycardservices.transactiongateway.com/api/transact.php';
$config['NMI_URL_QUERY'] = 'https://securitycardservices.transactiongateway.com/api/query.php?';

/***End NMI Gateway Settings***/


/***** COMPANY CONFIG ******/
$config['Company_Title'] = 'Go Fund It Solutions ';
$config['Company_Heading'] = 'Welcome';
$config['Company_Description'] = '';
$config['Company_Author'] = 'Go Fund It Solutions ' . date("Y");
$config['Company_Name'] = 'Go Fund It Solutions';
$config['Company_Logo'] = 'assets/img/logo.png';
$config['Company_Slogan'] = 'Leader In Fundraising Solutions';
/***End Company Config Settings***/

/***** CLIENT CONFIG ******/
// DO NOT ADD ANY MORE CONFIG VARIABLES TO THIS FILE.  WE NEED TO MOVE THEM
// DO THE DATABASE
// $config['Client_Heading'] = 'CLIENT HEADING';
// $config['Client_Description'] = 'CLIENT DESCRIPTION';
// $config['Client_Author'] = 'Client Company ' . date("Y");
// $config['Client_Name'] = 'Client Company Name';
// $config['Client_Logo'] = 'client/client_website/JM-logo.png';
// $config['Client_Slogan'] = 'CLIENT SLOGAN';
/***End Company Config Settings***/

