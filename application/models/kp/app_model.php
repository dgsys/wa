<?php

class App_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getAkibat() {
        $this->db->where('set_group', 'akibat');
        return $this->db->get('setting');
    }
    
    public function getPenyakit() {
        $this->db->where('set_group', 'penyakit');
        return $this->db->get('setting');
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

