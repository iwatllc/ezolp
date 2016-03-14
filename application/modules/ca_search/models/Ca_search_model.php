<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 3/9/2016
 * Time: 10:52 AM
 */

class Ca_search_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_promocode_dropdown_list()
    {
        $this -> db -> from('ca_promo');
        $this -> db -> order_by('code');
        $result = $this -> db -> get();

        $return = array();

        if ($result -> num_rows() > 0)
        {
            $return[''] = '';
            foreach ($result->result_array() as $row)
            {
                $return[$row['code']] = $row['code'];
            }
        }

        return $return;
    }

    public function get_search_results($search_array)
    {
        // only search if search_array has something in it
        if (!empty($search_array))
        {
            $this -> db -> select('classifiedad_submissions.* , users.username AS username');
            $this -> db -> from('classifiedad_submissions');

            if ($search_array['contactinfo'] != NULL)
            {
                // split up strings by spaces
                if ( preg_match('/\s/',$search_array['contactinfo']) ) // if there are spaces in the string
                {
                    $pieces = explode(" ", $search_array['contactinfo']);

                    foreach($pieces as $piece)
                    {
                        $this -> db -> where(
                            '(classifiedad_submissions.firstname LIKE'           . $this->db->escape($piece)
                            .' OR classifiedad_submissions.lastname LIKE'        . $this->db->escape($piece)
                            .' OR classifiedad_submissions.streetaddress LIKE'   . $this->db->escape('%'.$piece.'%')
                            .' OR classifiedad_submissions.city LIKE'            . $this->db->escape($piece)
                            .' OR classifiedad_submissions.state LIKE'           . $this->db->escape($piece)
                            .' OR classifiedad_submissions.zip LIKE'             . $this->db->escape($piece)
                            .' OR classifiedad_submissions.email LIKE'           . $this->db->escape('%'.$piece.'%') . ')'
                        );
                    }
                } else
                {
                    $this -> db -> where(
                        '(classifiedad_submissions.firstname LIKE'              . $this->db->escape($search_array['contactinfo'])
                        .' OR classifiedad_submissions.lastname LIKE'           . $this->db->escape($search_array['contactinfo'])
                        .' OR classifiedad_submissions.streetaddress LIKE'      . $this->db->escape('%'.$search_array['contactinfo'].'%')
                        .' OR classifiedad_submissions.city LIKE'               . $this->db->escape($search_array['contactinfo'])
                        .' OR classifiedad_submissions.state LIKE'              . $this->db->escape($search_array['contactinfo'])
                        .' OR classifiedad_submissions.zip LIKE'                . $this->db->escape($search_array['contactinfo'])
                        .' OR classifiedad_submissions.email LIKE'              . $this->db->escape('%'.$search_array['contactinfo'].'%') . ')'
                    );
                }

            }

            if ($search_array['adtext'] != NULL)
            {
                $this -> db -> where('classifiedad_submissions.adtext LIKE '.$this->db->escape('%'.$search_array['adtext'].'%'));
            }

            if ($search_array['promocode'] != NULL)
            {
                $this -> db -> where('classifiedad_submissions.promocode', $search_array['promocode']);
            }

            if ($search_array['issues'] != NULL)
            {
                foreach ($search_array['issues'] as $issue)
                {
                    $this -> db -> where('classifiedad_submissions.issues LIKE '.$this->db->escape('%'.$issue.'%'));
                }
            }

            if ($search_array['begindate'] != NULL && $search_array['enddate'] != NULL)
            {
                $this -> db -> where('DATE(classifiedad_submissions.created) >=', $search_array['begindate']) -> where('DATE(classifiedad_submissions.created) <=', $search_array['enddate']);
            } else if ($search_array['begindate'] != NULL)
            {
                $this -> db -> where('DATE(classifiedad_submissions.created) >=', $search_array['begindate']);
            } else if ($search_array['enddate'] != NULL)
            {
                $this -> db -> where('DATE(classifiedad_submissions.created) <=', $search_array['enddate']);
            }

            if ($search_array['approval'] == 'approved')
            {
                $this -> db -> where('classifiedad_submissions.approved', '1');
            } else
            {
                $this -> db -> where('classifiedad_submissions.approved', '0');
            }

            $this -> db -> order_by('classifiedad_submissions.created', 'DESC');

            $this -> db -> join('users', 'classifiedad_submissions.approvedby = users.id', 'left');

            // uncomment this to get the db query
//            echo $this->db->get_compiled_select();

            return $this -> db -> get();

        } else
        {
            return NULL; // search array is empty
        }

    }

    public function disapprove_submission($id, $statusid)
    {
        $data = array(
            'approved' => $statusid,
            'approvedby' => 0,
            'approveddate' => 'NULL'
        );

        $this -> db -> where('id', $id);
        $this -> db -> update('classifiedad_submissions', $data);

    }

    public function approve_submission($id, $statusid, $approvedby, $approveddate)
    {
        $data = array(
            'approved' => $statusid,
            'approvedby' => $approvedby,
            'approveddate' => $approveddate
        );

        $this -> db -> where('id', $id);
        $this -> db -> update('classifiedad_submissions', $data);

    }

    public function get_submission($id)
    {
        $row = $this -> db -> select('classifiedad_submissions.*')
            -> where('id', $id)
//            -> join('users', 'classifiedad_submissions.approvedby = users.id', 'left')
            -> get('classifiedad_submissions')
            -> row();

        return $row;
    }

    public function change_approved_ad_text($id, $text)
    {
        $data = array(
            'approvedtext' => $text
        );

        $this -> db -> where('id', $id);
        $this -> db -> update('classifiedad_submissions', $data);
    }

}