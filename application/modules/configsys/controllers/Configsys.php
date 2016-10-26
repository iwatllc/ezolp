<?php
/**
 * Created by PhpStorm.
 * User: robertfulcher
 * Date: 2/9/15
 * Time: 7:07 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Configsys extends MX_Controller {

    public $data = array(
        'title' => 'EZ Online Pay | Virtual Terminal Payment Form',
        'heading' => 'Virtual Terminal Payment Form',
        'description' => 'EZ Online Pay Virtual Terminal Payment Form',
        'author' => 'EZ Online Pay 2015'
    );

    public function __construct()
    {
        parent::__construct();
    }


    public function get_config_value($data, $defaultValue = "")
    {
        $this->load->model('Configsys_model');
        $value = $this->Configsys_model->get_value($data);

        if(empty($value)) {
            return $defaultValue;
        } else {
            return $value;
        }
    }

    public function ajax_get_displayad_header_text()
    {
        $this -> load -> model('configsys_model', '', TRUE);

        $headertext = $this -> configsys_model -> get_value('Displayad_Header');

        echo $headertext;
    }

    public function ajax_update_displayad_header()
    {
        $this -> load -> model('configsys_model', '', TRUE);

        $headertext = $this -> input -> post('headertext');

        $headertext = $this -> configsys_model -> set_value('Displayad_Header', $headertext);

        echo $headertext;
    }
}