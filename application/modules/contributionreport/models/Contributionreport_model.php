<?php

class Contributionreport_model extends Report_model {
    
    public function __construct()
    {
        parent::__construct();

        // Configure the table name used for storing reports
        $this->tableName = 'contribution_reports';
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


    public function get_matching_list($filters) {

        $this->db->query('SET SQL_BIG_SELECTS=1');
        $this->db->select('donationform_submissions.*, contributors.* ');
        $this->db->from('donationform_submissions');
        $this->db->join('contributors', 'donationform_submissions.lastname = contributors.lastname AND donationform_submissions.firstname = contributors.firstname AND donationform_submissions.city = contributors.city');
        
        // Append where conditions when needed
        if(!empty($filters['startDate'])) {
            $startDate = DateTime::createFromFormat('m/d/Y', $filters['startDate'])->format("Y-m-d");
            $this->db->where('contributors.transaction_date >=', $startDate);
        }
        if(!empty($filters['endDate'])) {
            $endDate = DateTime::createFromFormat('m/d/Y', $filters['endDate'])->format("Y-m-d");
            $this->db->where('contributors.transaction_date <=', $endDate);
        }
        if(!empty($filters['zip'])) {
            $this->db->where('donationform_submissions.zip', $filters['zip']);
        }
        if(!empty($filters['firstName'])) {
            $this->db->like('donationform_submissions.firstname', $filters['firstName']);
        }
        if(!empty($filters['lastName'])) {
            $this->db->like('donationform_submissions.lastname', $filters['lastName']);
        }
        if(!empty($filters['city'])) {
            $this->db->like('donationform_submissions.city', $filters['city']);
        }
        if(!empty($filters['state'])) {
            $this->db->like('donationform_submissions.state', $filters['state']);
        }
        if(!empty($filters['occupation'])) {
            $this->db->like('donationform_submissions.occupation', $filters['occupation']);
        }
        if(!empty($filters['employer'])) {
            $this->db->like('donationform_submissions.employer', $filters['employer']);
        }

        $query = $this->db->get();

        return $query;
    }




    public function get_total_amounts_donated_through_company_by_date($begin_date, $end_date)
    {
        $where_clause_donation = NULL;
        $where_clause_contribution = NULL;

        if ($begin_date != NULL && $end_date != NULL && $begin_date != "1969-12-31" && $end_date != "1969-12-31")
        {
            $where_clause_donation = 'WHERE DATE(InsertDate) >= "' . $begin_date . '" AND ' . 'DATE(InsertDate) <= "' . $end_date . '"';
            $where_clause_contribution = 'WHERE DATE(transaction_date) >= "' . $begin_date . '" AND ' . 'DATE(transaction_date) <= "' . $end_date . '"';

        } else if ($begin_date != "1969-12-31") // NULL
        {
            $where_clause_donation = 'WHERE InsertDate >= "' . $begin_date . '"';
            $where_clause_contribution = 'WHERE transaction_date >= "' . $begin_date . '"';

        } else if ($end_date != "1969-12-31") // NULL
        {
            $where_clause_donation = 'WHERE InsertDate <= "' . $end_date . '"';
            $where_clause_contribution = 'WHERE transaction_date <= "' . $end_date . '"';
        }

        $sql = "SELECT donation.lastname, donation.firstname, donation.streetaddress, donation.city, donation.state, donation.zip, donation.total_company, contribution.total_other
FROM
(
    SELECT lastname, firstname, streetaddress, city, state, zip, SUM(donationform_submissions.amount) AS total_company
    FROM donationform_submissions " . $where_clause_donation . " GROUP BY lastname, firstname, city, state, zip
) AS donation
JOIN
(
	SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(name, ', ', 1), ' ', -1) AS lastname, SUBSTRING_INDEX(SUBSTRING_INDEX(name, ', ', 2), ' ', -1) AS firstname, '' AS streetaddress, city, state, zip_code as zip, SUM(transaction_amt) AS total_other
	FROM contributors
	GROUP BY lastname, firstname, city, state, zip
) AS contribution ON (donation.lastname = contribution.lastname) AND (donation.firstname = contribution.firstname) AND (donation.city = contribution.city)";

        $query = $this -> db -> query($sql);

        return $query;
    }


}