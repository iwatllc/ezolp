<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//$config['protocol'] = 'smtp';
//$config['wordwrap'] = TRUE;
//$config['useragent'] = 'BZB';
//$config['smtp_host'] = 'ssl://mail.onebzb.com';
//$config['smtp_port'] = '465';
//$config['smtp_user'] = 'update@onebzb.com';
//$config['smtp_pass'] = '5BpqG$Z%GoHe';
//$config['charset'] = 'utf-8';
//$config['mailtype'] = 'html';
//$config['newline'] = "\r\n";

$config['protocol'] = 'smtp';
$config['wordwrap'] = TRUE;
$config['useragent'] = 'BZB';
$config['smtp_host'] = 'mail.onebzb.com';
//$config['smtp_port'] = '465';
$config['smtp_port'] = '25';
$config['smtp_user'] = 'test@onebzb.com';
$config['smtp_pass'] = 'Test123#';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "\r\n";

// $config['imap_host'] = 'server.iwatllc.com';
// $config['imap_host'] = '198.57.173.101';
$config['imap_host'] = '162.144.55.202';
$config['imap_user'] = 'iwat@onebzb.com';
$config['imap_pass'] = ']Q}K);BMOaBn';
// Non SSL Port
$config['imap_port'] = '143';
// SSL Port
//$config['imap_port'] = '993';
$config['imap_mailbox'] = 'INBOX';
// Below is actually flags for imap.
$config['imap_path'] = '/imap/notls';
$config['imap_server_encoding'] = 'utf-8';
$config['imap_attachemnt_dir'] = './bbtmp/';