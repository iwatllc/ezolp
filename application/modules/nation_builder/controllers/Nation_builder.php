<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nation_builder extends MX_Controller {
    var $client;
    var $slug;
    var $client_id;
    var $client_secret;
    var $access_token;
    var $base_api_url;

    public function __construct()
    {
        // load required models
        $this->load->model('configsys/configsys_model');
        $this->load->model('nation_builder/NationBuilderDonation');

        // set config variables
        $this->slug = $this->configsys_model->get_value('nationbuilder_slug');
        $this->client_id = $this->configsys_model->get_value('nationbuilder_client_id');
        $this->client_secret = $this->configsys_model->get_value('nationbuilder_client_secret');
        $this->access_token = $this->configsys_model->get_value('nationbuilder_access_token');
        $this->base_api_url = 'https://' . $this->slug . '.nationbuilder.com';

        // Register event handlers
        Events::register('guestform_payment_approved', array($this, 'process_donation'));
        Events::register('donation_payment_approved', array($this, 'process_donation'));
        Events::register('payment_refund_approved', array($this, 'process_refund'));
        Events::register('payment_void_approved', array($this, 'process_refund'));

        parent::__construct();
    }

    /*
     * Allows a person and their dontaion to be added to Nationbuilder API
     */
    public function process_donation($data) {
        if($this->configsys_model->get_value('nationbuilder_enabled') === 'true') {
            // since we only match on email, the provided email MUST be valid.
            if(filter_var($data['submitted_data']['email'], FILTER_VALIDATE_EMAIL)) {
                log_message('debug', 'Processing NationBuilder donation...');

                $person = [
                    'person' => [
                        'email' => $data['submitted_data']['email'],
                        'first_name' => $data['submitted_data']['firstname'],
                        'last_name' => $data['submitted_data']['lastname']
                    ]
                ];

                $donor = $this->push_person($person);

                $donation = [
                    'donation' => [
                        'donor_id' => $donor['person']['id'],
                        'amount_in_cents' => bcmul($data['submitted_data']['amount'], 100),
                        'payment_type_name' => 'Other'
                    ]
                ];

                $donation_result = $this->create_donation($donation);

                // Determine if this a valid response
                if(isset($donation_result) && isset($donation_result['donation']) && isset($donation_result['donation']['id'])) {
                    // Create the association between the PaymentResponseId and the donation id
                    $this->NationBuilderDonation->add($data['result_data']['PaymentResponseId'], $donation_result['donation']['id']);
                } else {
                    log_message('error', 'Unexpected result from NationBuilder API. ' . print_r($donation_result));
                }

            } else {
                log_message('error', 'NationBuilder donation cannot be processed because the provided email is not valid.');
            }

        } else {
            log_message('debug', 'NationBuilder integration is disabled.');
        }
    }

    /*
     * Removes a dontaion from the Nationbuilder API
     */
    public function process_refund($paymentResponseId) {
        if($this->configsys_model->get_value('nationbuilder_enabled') === 'true') {
            $donationId = $this->NationBuilderDonation->getDonationId($paymentResponseId);

            if(isset($donationId)) {
                $this->delete_donation($donationId);
            } else {
                log_message('debug', 'No NationBuilder donation id found for this PaymentResponseId.');
            }
        } else {
            log_message('debug', 'NationBuilder integration is disabled.');
        }
    }

    /*
     * Creates/updates a donor on NationBuilder
     */
    private function push_person($person) {
        log_message('debug', 'Pushing a person via the NationBuilder API...');

        $response = $this->execute_request('/api/v1/people/push', $person, 'PUT');

        return $response;
    }

    /*
     * Creates a donation on NationBuilder
     */
    private function create_donation($donation) {
        log_message('debug', 'Creating a donation via the NationBuilder API...');

        $response = $this->execute_request('/api/v1/donations', $donation, 'POST');

        return $response;
    }

    /*
     * Creates a donation on NationBuilder
     */
    private function delete_donation($donationId) {
        log_message('debug', 'Deleting donation (' . $donationId . ') via the NationBuilder API...');

        $response = $this->execute_request('/api/v1/donations/' . $donationId, null, 'DELETE');

        return $response;
    }

    private function execute_request($endpoint, $data, $type = 'POST') {
        $ch = curl_init($this->base_api_url . $endpoint . '?access_token=' . $this->access_token);

        // Configre Curl
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, '8'); // 8 second timeout
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Accept: application/json"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Get response
        $json_response = curl_exec($ch);

        if(curl_errno($ch)) {
            log_message('error', 'Error executing NationBuilder request. ' . curl_error($ch));
        } else {
            curl_close($ch);
            $response = json_decode($json_response, true);
            return $response;
        }
    }

}