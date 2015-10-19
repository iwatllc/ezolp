<?php

class Checkdonationamount_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Pass in the id from donationform_submissions table and query the database for user's info
     * Return query from database
     */
    public function get_company_donations($donationid)
    {
        $this->db->select('*');
        $this->db->from('donationform_submissions');
        $this->db->where('id', $donationid);

        $query = $this->db->get();

        return $query;
    }

    /**
     * Pass the row returned from the donation form.  Create an array of information for that row.
     * Query the database to see which fields match.  On a match return that row.
     * Return query from database.
     */
    public function get_all_donations($donationrow)
    {
        $donation_array = array();

        foreach ($donationrow->result() as $result)
        {
            $donation_array['id'] = $result->id;
            $donation_array['name'] = $result->name;
            $donation_array['streetaddress'] = $result->streetaddress;
            $donation_array['streetadress2'] = $result->streetaddress2;
            $donation_array['city'] = $result->city;
            $donation_array['state'] = $result->state;
            $donation_array['zip'] = $result->zip;
            $donation_array['notes'] = $result->notes;
            $donation_array['cclast4'] = $result->cclast4;
            $donation_array['amount'] = $result->amount;
            $donation_array['InsertDate'] = $result->InsertDate;
        }

        $this->db->select('*');
        $this->db->from('contributors');
        $this->db->where('name', $donation_array['name']);
        $this->db->where('city', $donation_array['city']);
        $this->db->where('state', $donation_array['state']);
        $this->db->where('zip_code', $donation_array['zip']);


        $query = $this->db->get();

        return $query;

    }


}