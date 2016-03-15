<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 3/9/2016
 * Time: 10:52 AM
 */

class Da_search_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_promocode_dropdown_list()
    {
        $this -> db -> from('da_promo');
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

    public function get_pricing_list()
    {
        $this -> db -> from('displayad_pricing');
        $this -> db -> order_by('bwprice');
        $result = $this -> db -> get();

        $return = array();

        if ($result -> num_rows() > 0)
        {
            $return[''] = '';
            foreach ($result -> result_array() as $row)
            {
                $return[$row['pagesize']] = $row['pagesize'];
            }
        }

        return $return;
    }

    public function get_search_results($search_array)
    {
        // only search if search_array has something in it
        if (!empty($search_array))
        {
            $this -> db -> select('displayad_submissions.*, users.username AS username, GROUP_CONCAT(da_imageupload_approved.filename SEPARATOR ", ") 	AS approvedfilenames');

            $this -> db -> from('displayad_submissions');

            if ($search_array['contactinfo'] != NULL)
            {
                // split up strings by spaces
                if ( preg_match('/\s/',$search_array['contactinfo']) ) // if there are spaces in the string
                {
                    $pieces = explode(" ", $search_array['contactinfo']);

                    foreach($pieces as $piece)
                    {
                        $this -> db -> where(
                            '(displayad_submissions.firstname LIKE'           . $this->db->escape($piece)
                            .' OR displayad_submissions.lastname LIKE'        . $this->db->escape($piece)
                            .' OR displayad_submissions.streetaddress LIKE'   . $this->db->escape('%'.$piece.'%')
                            .' OR displayad_submissions.city LIKE'            . $this->db->escape($piece)
                            .' OR displayad_submissions.state LIKE'           . $this->db->escape($piece)
                            .' OR displayad_submissions.zip LIKE'             . $this->db->escape($piece)
                            .' OR displayad_submissions.email LIKE'           . $this->db->escape('%'.$piece.'%') . ')'
                        );
                    }
                } else
                {
                    $this -> db -> where(
                        '(displayad_submissions.firstname LIKE'              . $this->db->escape($search_array['contactinfo'])
                        .' OR displayad_submissions.lastname LIKE'           . $this->db->escape($search_array['contactinfo'])
                        .' OR displayad_submissions.streetaddress LIKE'      . $this->db->escape('%'.$search_array['contactinfo'].'%')
                        .' OR displayad_submissions.city LIKE'               . $this->db->escape($search_array['contactinfo'])
                        .' OR displayad_submissions.state LIKE'              . $this->db->escape($search_array['contactinfo'])
                        .' OR displayad_submissions.zip LIKE'                . $this->db->escape($search_array['contactinfo'])
                        .' OR displayad_submissions.email LIKE'              . $this->db->escape('%'.$search_array['contactinfo'].'%') . ')'
                    );
                }

            }

            if ($search_array['pricing'] != NULL)
            {
                $this -> db -> where('displayad_submissions.option LIKE '.$this->db->escape('%'.$search_array['pricing'].'%'));
            }

            if ($search_array['promocode'] != NULL)
            {
                $this -> db -> where('displayad_submissions.promocode', $search_array['promocode']);
            }

            if ($search_array['issues'] != NULL)
            {
                foreach ($search_array['issues'] as $issue)
                {
                    $this -> db -> where('displayad_submissions.issues LIKE '.$this->db->escape('%'.$issue.'%'));
                }
            }

            if ($search_array['begindate'] != NULL && $search_array['enddate'] != NULL)
            {
                $this -> db -> where('DATE(displayad_submissions.created) >=', $search_array['begindate']) -> where('DATE(displayad_submissions.created) <=', $search_array['enddate']);
            } else if ($search_array['begindate'] != NULL)
            {
                $this -> db -> where('DATE(displayad_submissions.created) >=', $search_array['begindate']);
            } else if ($search_array['enddate'] != NULL)
            {
                $this -> db -> where('DATE(displayad_submissions.created) <=', $search_array['enddate']);
            }

            if ($search_array['approval'] == 'approved')
            {
                $this -> db -> where('displayad_submissions.approved', '1');
            } else
            {
                $this -> db -> where('displayad_submissions.approved', '0');
            }

            $this -> db -> join('da_imageupload_approved', 'displayad_submissions.id = da_imageupload_approved.da_submissionid', 'inner');

            $this -> db -> join('users', 'displayad_submissions.approvedby = users.id', 'left');

            $this -> db -> group_by('displayad_submissions.id');

            $this -> db -> order_by('displayad_submissions.created', 'DESC');

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
        $this -> db -> update('displayad_submissions', $data);

    }

    public function approve_submission($id, $statusid, $approvedby, $approveddate)
    {
        $data = array(
            'approved' => $statusid,
            'approvedby' => $approvedby,
            'approveddate' => $approveddate
        );

        $this -> db -> where('id', $id);
        $this -> db -> update('displayad_submissions', $data);

    }

    public function get_submission($id)
    {
        $row = $this -> db -> select('displayad_submissions.*')
            -> where('id', $id)
//            -> join('users', 'displayad_submissions.approvedby = users.id', 'left')
            -> get('displayad_submissions')
            -> row();

        return $row;
    }

    public function upload_approved_image($displayad_id, $data)
    {
        $data = array(
            'da_submissionid' => $displayad_id,
            'filename'        => $data['file_name'],
            'filepath'        => $data['file_path'],
            'filetype'        => $data['file_type'],
            'filesize'        => $data['file_size'],
            'fileext'         => $data['file_ext'],
            'imagewidth'      => $data['image_width'],
            'imageheight'     => $data['image_height'],
            'uploaddate'      => date('Y-n-j H:i:s')
        );


        $this -> db -> insert('da_imageupload_approved', $data);

//        return $this -> db -> insert_id();
    }

}