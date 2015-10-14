<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config['base_url'] = 'http://localhost:8888/ezolp/';
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
$config['NMI_Username'] = 'demo';
$config['NMI_Password'] = 'password';
// $config['NMI_Username'] = 'RFulcherLeveliii';
// $config['NMI_Password'] = 'pCLx4T2j7kVNNHPE';
$config['NMI_URL'] = 'https://securitycardservices.transactiongateway.com/api/transact.php';
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
$config['Client_Title'] = 'Jeb 2016';
$config['Client_Heading'] = 'Thanks for helping us make a difference';
$config['Client_Description'] = '';
$config['Client_Author'] = 'Client Company ' . date("Y");
$config['Client_Name'] = 'Client Company Name';
$config['Client_Logo'] = 'client/client.png';
$config['Client_Slogan'] = 'Please help us support our cause';
/***End Company Config Settings***/

