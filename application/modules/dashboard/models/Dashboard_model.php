<?php

class Dashboard_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Return the entire amount thus far from payment_response table.
     *
     * SELECT SUM(TransactionAmount) FROM payment_response
     */
    public function get_total_volume()
    {
        $this->db->select_sum('TransactionAmount');
        $this->db->from('payment_response');

        $query = $this->db->get();

        return $query->row()->TransactionAmount;
    }


    /**
     * Returns the number of unique names from tables.
     *
     * guestform_submissions, virtualterminal_submissions
     * SQL:
     * SELECT DISTINCT Name FROM virtualterminal_submissions
     * UNION
     * SELECT DISTINCT name FROM guestform_submissions
     *
     * Note: Codeigniter does not support UNION, so I had to write my own query
     *
     */
    public function get_total_customers()
    {
        $this->db->distinct();
        $this->db->select('name');
        $this->db->from('virtualterminal_submissions');
        $this->db->get();
        $query1 = $this->db->last_query();

        $this->db->distinct();
        $this->db->select('name');
        $this->db->from('guestform_submissions');
        $this->db->get();
        $query2 = $this->db->last_query();

        $query = $this->db->query($query1." UNION ".$query2);

        return $query->num_rows();
    }


    /**
     * Returns the total amount within a given date (day)
     *
     * SELECT SUM(TransactionAmount) FROM payment_response WHERE InsertDate BETWEEN '2015-05-16 00:00:00' AND '2015-05-16 23:59:59'
     */
    public function get_total_amount_by_date($begin_date, $end_date)
    {
        $this->db->select_sum('TransactionAmount');
        $this->db->from('payment_response');

        if ($begin_date != NULL && $end_date != NULL && $begin_date != "1969-12-31" && $end_date != "1969-12-31")
        {
            $this->db->where('DATE(payment_response.InsertDate) >=', $begin_date)->where('DATE(payment_response.InsertDate) <=', $end_date);

        } else if ($begin_date != "1969-12-31")
        {
            $this->db->where('DATE(payment_response.InsertDate) >=', $begin_date);

        } else if ($end_date != "1969-12-31")
        {
            $this->db->where('DATE(payment_response.InsertDate) <=', $end_date);
        }

        $query = $this->db->get();

        return $query->row()->TransactionAmount;
    }



    /**
     * Returns the number of unique names from tables.
     *
     * Pulls from guest_form, virtual_terminal and donation tables.
     * It selects the names of all three tables (union query) and groups by
     * First Name and Last Name
     *
     * guestform_submissions, virtualterminal_submissions
     *
     * SQL:
     * SELECT DISTINCT Name FROM virtualterminal_submissions WHERE InsertDate BETWEEN '2015-05-16 00:00:00' AND '2015-05-16 23:59:59'
     * UNION
     * SELECT DISTINCT name FROM guestform_submissions WHERE InsertDate BETWEEN '2015-05-16 00:00:00' AND '2015-05-16 23:59:59'
     *
     * Note: Codeigniter does not support UNION, so I had to concatenate the two queries
     *
     */
    public function get_total_customers_by_date($begin_date, $end_date)
    {
        $this->db->distinct();
        $this->db->select('name');
        $this->db->from('virtualterminal_submissions');

        if ($begin_date != NULL && $end_date != NULL && $begin_date != "1969-12-31" && $end_date != "1969-12-31")
        {
            $this->db->where('DATE(virtualterminal_submissions.InsertDate) >=', $begin_date)->where('DATE(virtualterminal_submissions.InsertDate) <=', $end_date);

        } else if ($begin_date != "1969-12-31")
        {
            $this->db->where('DATE(virtualterminal_submissions.InsertDate) >=', $begin_date);

        } else if ($end_date != "1969-12-31")
        {
            $this->db->where('DATE(virtualterminal_submissions.InsertDate) <=', $end_date);
        }

        $this->db->get();
        $query1 = $this->db->last_query();

        $this->db->distinct();
        $this->db->select('name');
        $this->db->from('guestform_submissions');

        if ($begin_date != NULL && $end_date != NULL && $begin_date != "1969-12-31" && $end_date != "1969-12-31")
        {
            $this->db->where('DATE(guestform_submissions.InsertDate) >=', $begin_date)->where('DATE(guestform_submissions.InsertDate) <=', $end_date);

        } else if ($begin_date != "1969-12-31")
        {
            $this->db->where('DATE(guestform_submissions.InsertDate) >=', $begin_date);

        } else if ($end_date != "1969-12-31")
        {
            $this->db->where('DATE(guestform_submissions.InsertDate) <=', $end_date);
        }

        $this->db->get();
        $query2 = $this->db->last_query();

        $query = $this->db->query($query1 . " UNION " . $query2);

        return $query->num_rows();
    }
}