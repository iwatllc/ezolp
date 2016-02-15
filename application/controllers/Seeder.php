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
 
        // load any required models
        $this->load->model('Contributor_model');
    }
 
    /**
     * seed local database
     */
    function seed()
    {
        // purge existing data
        // $this->_truncate_db();
 
        // seed users
        $this->_seed_contributors(1);

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
            $lastName = $this->faker->lastName();
            $state = $this->faker->stateAbbr();
            $zip = substr($this->faker->postcode(),0,5);
            $city = $this->faker->city();
            $employer = $this->faker->company();
            $transactionDate = $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')->format('Y-m-d');
            $transactionAmount = $this->faker->biasedNumberBetween($min = 10, $max = 2000, $function = 'sqrt');
 
            $data = array(
                'name'              => $firstName.' '.$lastName,
                'firstname'         => $firstName,
                'lastname'          => $lastName,
                'city'              => $city,
                'state'             => $state,
                'zip_code'          => $zip,
                'employer'          => $employer,
                'transaction_date'  => $transactionDate,
                'transaction_amt'   => $transactionAmount,
            );
 
            $this->Contributor_model->insert($data);
        }
 
        echo PHP_EOL;
    }
}