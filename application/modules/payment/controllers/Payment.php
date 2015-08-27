<?php
/**
 * Created by PhpStorm.
 * User: robertfulcher
 * Date: 4/13/15
 * Time: 3:38 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MX_Controller
{
    public function index()
    {
        Echo "index function";
    }

    public function process_payment($data)
    {
        // Save the initial data before processing.
        // SAVE SUBMITTED FORM DATA
        $this->load->model('Payment_model', 'Payment');
		$gateway = $this->config->item('Gateway');
        $payment_data = array(
            'PaymentTransactionid' => $data['transaction_id'],
            'PaymentSource' => $data['PaymentSource'],
            'TransactionAmount' => $data['amount'],
            'InsertDate' => date('Y-n-j H:i:s'),
			'Gateway' => $gateway
        );
        $payment_id = $this->Payment->save($payment_data);

		log_message('debug', "Gateway is set -> " . $gateway);
		if(strcmp($gateway, 'NPC') == 0) {
			//Gateway is NPC
			$post_payment_data = $this->_NPC_post_payment($data);
		}

		else if(strcmp($gateway, 'NMI') == 0) {
			//Gateway is NMI
			$post_payment_data = $this->_NMI_post_payment($data);	
		}
		else {
			show_error("Unrecognized gateway '". $gateway . "'");
		}
		
        $this->Payment->update($post_payment_data, $payment_id);

        return $post_payment_data;

    }

	private function _NPC_post_payment($data)
	{
		$this->load->module('npc');
        $result_data = $this->npc->post_payment($data);

        return array(
            'AuthCode' => $result_data['AUTHCODE'],
            'SerialNumber' => $result_data['szSerialNumber'],
            'AuthorizationDeclinedMessage' => $result_data['szAuthorizationDeclinedMessage'],
            'AVSResponseCode' => $result_data['szAVSResponseCode'],
            'AVSResponseMessage' => $result_data['szAVSResponseMessage'],
            'OrderNumber' => $result_data['szOrderNumber'],
            'AuthorizationResponseCode' => $result_data['szAuthorizationResponseCode'],
            'IsApproved' => $result_data['szIsApproved'],
            'CVV2ResponseCode' => $result_data['szCVV2ResponseCode'],
            'CVV2ResponseMessage' => $result_data['szCVV2ResponseMessage'],
            'ReturnCode' => $result_data['szReturnCode'],
            'TransactionFileName' => $result_data['szTransactionFileName'],
            'CAVVResponseCode' => $result_data['szCAVVResponseCode'],
            'ResponseHTML' => $result_data['html'],
            'UpdateDate' => date('Y-n-j H:i:s')
        );		
	}
	
	private function _NMI_post_payment($data)
	{
		$this->load->module('nmi');
		$result_data = $this->nmi->doSale($data);
		
		return array(
            'AuthCode' => $result_data['authcode'],
            'AVSResponseCode' => $result_data['avsresponse'],
            'OrderNumber' => $result_data['orderid'],
            'IsApproved' => $result_data['response'],
            'CVV2ResponseCode' => $result_data['cvvresponse'],
            'ReturnCode' => $result_data['response_code'],
            'TransactionFileName' => $result_data['transactionid'],
            'ResponseHTML' => $result_data['responsetext'],
            'UpdateDate' => date('Y-n-j H:i:s')
        );
	}
	
}