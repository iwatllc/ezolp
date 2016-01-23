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
        $this->load->model('configsys/configsys_model');

        // set config variables
        $this->slug = $this->configsys_model->get_value('nationbuilder_slug');
        $this->client_id = $this->configsys_model->get_value('nationbuilder_client_id');
        $this->client_secret = $this->configsys_model->get_value('nationbuilder_client_secret');
        $this->access_token = $this->configsys_model->get_value('nationbuilder_access_token');
        $this->base_api_url = 'https://' . $this->slug . '.nationbuilder.com';

        parent::__construct();
    }

    public function process_donation($data) {
        $person = [
            'person' => [
                'email' => $data['email'],
                'first_name' => $data['firstname'],
                'last_name' => $data['lastname']
            ]
        ];

        $donor = $this->push_person($person);

        // print_r($donor);

        $donation = [
            'donation' => [
                'donor_id' => $donor['person']['id'],
                'amount_in_cents' => bcmul($data['amount'], 100),
                'payment_type_name' => 'Other',
            ]
        ];

        $donation_result = $this->create_donation($donation);
    }

    /*
     * Creates/updates a donor on NationBuilder
     */
    private function push_person($person) {

        $response = $this->execute_request('/api/v1/people/push', $person, 'PUT');

        return $response;
    }

    /*
     * Creates a donation on NationBuilder
     */
    private function create_donation($donation) {

        $response = $this->execute_request('/api/v1/donations', $donation, 'POST');

        print_r($response);

        return $response;
    }

    private function execute_request($endpoint, $data, $type = 'POST') {
        $ch = curl_init($this->base_api_url . $endpoint . '?access_token=' . $this->access_token);
        // echo $this->base_api_url . $endpoint . '?access_token=' . $this->access_token;

        // Configre Curl
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, '10');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Accept: application/json"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Get response
        $json_response = curl_exec($ch);
        // print_r($json_response);
        curl_close($ch);
        $response = json_decode($json_response, true);
        return $response;
    }

}