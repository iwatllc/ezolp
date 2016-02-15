<?php
 
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
 
/**
 * Seeder Class
 *
 * Stop talking and start faking!
 */
class Seeder extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
 
        // can only be called from the command line
        if (!$this->input->is_cli_request()) {
            exit('Direct access is not allowed');
        }
 
        // initiate faker
        $this->faker = Faker\Factory::create();
 
        // load required models
        $this->load->model('Contributor_model');
        $this->load->model('donation/Donation_model');
    }
 
    /**
     * seed local database
     */
    function seed()
    {
        // purge existing data
        // $this->_truncate_db();
 
        // seed users
        $this->_basic_seed(200);

    }
 
    /**
     * seed contributors and donations
     *
     * @param int $limit
     */
    function _basic_seed($limit)
    {
        echo "seeding $limit contributors";
 
        // create a bunch of base buyer accounts
        for ($i = 0; $i < $limit; $i++) {
            echo ".";

            $firstName = $this->faker->firstName();
            $middleName = $this->faker->firstName();
            $middleInitial = substr($middleName,0,1);
            $lastName = $this->faker->lastName();
            $email = $firstName.$lastName.'@'.$this->faker->safeEmailDomain();
            $address = $this->faker->streetAddress();
            $state = $this->faker->stateAbbr();
            $zip = substr($this->faker->postcode(),0,5);
            $city = $this->faker->city();
            $employer = $this->faker->company();
            $occupation = ucwords($this->faker->word());
            $transactionDate = $this->faker->dateTimeBetween('-8 months', 'now');
            $transactionAmount = $this->faker->biasedNumberBetween(10, 2000, 'sqrt');
            $creditCardType = $this->faker->creditCardType();
            $creditCardNumber = substr($this->faker->creditCardNumber(),-4);
            $notes = $this->faker->optional(0.2, $default = '')->text(200);
            $ipAddress = $this->faker->ipv4();

 
            $this->Contributor_model->insert(array(
                'name'              => $firstName.' '.$middleInitial.' '.$lastName,
                'firstname'         => $firstName,
                'lastname'          => $lastName,
                'city'              => $city,
                'state'             => $state,
                'zip_code'          => $zip,
                'employer'          => $employer,
                'occupation'        => $occupation,
                'transaction_date'  => $transactionDate->format('Y-m-d'),
                'transaction_amt'   => $transactionAmount,
                'memo_text'         => $notes,
            ));

            // 10% get inserted as donations
            if($this->faker->boolean(10)) {
                $this->Donation_model->save(array(
                    'firstname'         => $firstName,
                    'lastname'          => $lastName,
                    'middleinitial'     => $middleInitial,
                    'streetaddress'     => $address,
                    'city'              => $city,
                    'state'             => $state,
                    'zip'               => $zip,
                    'employer'          => $employer,
                    'occupation'        => $occupation,
                    'email'             => $email,
                    'cardtype'          => $creditCardType,
                    'cclast4'           => $creditCardNumber,
                    'notes'             => $notes,
                    'amount'            => $transactionAmount,
                    'InsertDate'        => $transactionDate->format('Y-m-d H:i:s'),
                ));
            }
        }
 
        echo PHP_EOL;
    }
}