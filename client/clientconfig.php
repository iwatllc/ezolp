<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// $config['base_url'] = 'http://localhost:8888/ezolp/';
$config['base_url'] = 'http://localhost/ezolp/';



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
//$config['NMI_Username'] = 'RFulcherLeveliii';
//$config['NMI_Password'] = 'pCLx4T2j7kVNNHPE';
$config['NMI_URL'] = 'https://securitycardservices.transactiongateway.com/api/transact.php';
