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
        $payment_data = array(
            'PaymentTransactionid' => $data['transaction_id'],
            'PaymentSource' => $data['PaymentSource'],
            'TransactionAmount' => $data['amount'],
            'InsertDate' => date('Y-n-j H:i:s')
        );
        $payment_id = $this->Payment->save($payment_data);

        //  Might need to develop an interface for the data coming out
        //  and make the gateway give it to us in the correct format.
        //  What gateway should we use??  Not sure but will hard code for now.
        //  Later we will pull this from database config.
        // TODO put a case statement in for other gateways when we are ready to add them.
        $gateway = $this->config->item('Gateway');


        // Hard coding the NPC gateway usage.
        $this->load->module('npc');
        $result_data = $this->npc->post_payment($data);


        // SAVE THE RESULT OF THE PAYMENT PROCESSING
        $post_payment_data = array(
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

        $this->Payment->update($post_payment_data, $payment_id);


        return $post_payment_data;

    }


}