<?php

class Contributionreport_model extends CI_Model {

    const STATUS_WAITING = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_ERROR = 9;
    
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


    public function get_matching_list($filters) {

        $startDate = DateTime::createFromFormat('m/d/Y', $filters['startDate'])->format("Y-m-d");
        $endDate = DateTime::createFromFormat('m/d/Y', $filters['endDate'])->format("Y-m-d");

        $this->db->query('SET SQL_BIG_SELECTS=1');
        $this->db->select('donationform_submissions.*, contributors.* ');
        $this->db->from('donationform_submissions');
        $this->db->join('contributors', 'donationform_submissions.lastname = contributors.lastname AND donationform_submissions.firstname = contributors.firstname AND donationform_submissions.city = contributors.city');
        
        // Append where conditions when needed
        if(!empty($startDate)) {
            $this->db->where('donationform_submissions.InsertDate >=', $startDate);
        }
        if(!empty($endDate)) {
            $this->db->where('donationform_submissions.InsertDate <=', $endDate);
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

    /*
     * Persists the request for a new report in the database
     */
    public function create_new_report($input) {
        $this->db->insert('contribution_reports', [
            'input' => json_encode(['data' => $input]),
            'creation_date' => date("Y-m-d H:i:s"),
            'status_code' => Contributionreport_model::STATUS_WAITING,
            ]);

        return $this->db->insert_id();
    }

    /*
     * Sets a report's status to STATUS_IN_PROGRESS
     */
    public function set_report_in_progress($id) {
        $this->db->where('id', $id);
        $this->db->update('contribution_reports', [
                'status_code' => Contributionreport_model::STATUS_IN_PROGRESS,
            ]);
    }

    /*
     * Stores the result for a report and sets status to STATUS_COMPLETED
     */
    public function set_report_result($id, $result) {
        $this->db->where('id', $id);
        $this->db->update('contribution_reports', [
                'results' => json_encode($result),
                'status_code' => Contributionreport_model::STATUS_COMPLETED,
            ]);
    }

    /*
     * Retrieves a report
     */
    public function get_report($id) {
        $this->db->from('contribution_reports');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $row = $query->row();

        // Decode json
        if(isset($row->input)) {
            $row->input = json_decode($row->input)->data;
        }
        if(isset($row->results)) {
            $row->results = json_decode($row->results);
        }

        return $row;
    }

    /*
     * Retrieves all reports
     */
    public function get_all_reports() {
        $this->db->select('id, input, creation_date, status_code');
        $this->db->from('contribution_reports');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        $result = array();

        foreach ($query->result() as $row)
        {
            // Decode json
            if(isset($row->input)) {
                $row->input = json_decode($row->input)->data;
            }
            // Status Names
            switch ($row->status_code) {
                case Contributionreport_model::STATUS_WAITING:
                    $row->status_name = "Queued";
                    break;
                case Contributionreport_model::STATUS_IN_PROGRESS:
                    $row->status_name = "In Progress";
                    break;
                case Contributionreport_model::STATUS_COMPLETED:
                    $row->status_name = "Completed";
                    break;
                case Contributionreport_model::STATUS_ERROR:
                    $row->status_name = "Error";
                    break;
                default:
                    $row->status_name = "Unknown";
            }

            $result[] = $row;
        }

        return $result;
    }


}