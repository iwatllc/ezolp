<?php

class Contributionreport_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
     
    /**
     * Returns the name, address, amount donated through company, and amount donated through other companies.
     *
        SELECT totals_donations.firstname, totals_donations.lastname, totals_donations.streetaddress, totals_donations.total_amount_donated AS total_company, totals_contributors.total_amount_donated AS total_other FROM totals_donations
        JOIN totals_contributors ON totals_donations.lastname = totals_contributors.lastname AND totals_donations.firstname = totals_contributors.firstname AND totals_donations.city = totals_contributors.city AND totals_donations.state = totals_contributors.state
        GROUP BY lastname;
     *
     * TODO: Need to change how this function pulls data by changing comparison of tables.
     * 1. name - need to split out first, last, and middle initial (prefixes and suffixes)
     * 2. zip code - extended zip code
     */
    public function get_total_amounts_donated()
    {
        $this->db->select('
            totals_donations.firstname,
            totals_donations.lastname,
            totals_donations.streetaddress,
            totals_donations.total_amount_donated AS total_company,
            totals_contributors.total_amount_donated AS total_other'
        );

        $this->db->from('totals_donations');

        $this->db->join('totals_contributors', 'totals_donations.lastname = totals_contributors.lastname AND totals_donations.firstname = totals_contributors.firstname AND totals_donations.city = totals_contributors.city AND totals_donations.state = totals_contributors.state');

        $this->db->group_by('lastname');

        $query = $this->db->get();

        return $query;
    }
}