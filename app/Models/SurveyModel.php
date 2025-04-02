<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyModel extends Model {

    protected $DBGroup = 'default'; // You can set this to your database group if you have one

    public function __construct() {
        parent::__construct();
        // CodeIgniter 4 automatically loads the database on the Model class
        // No need to call $this->load->database(); here
    }

    // Insert Data
    public function insert_data($tablename, $data) {
        $builder = $this->db->table($tablename);
        $builder->insert($data);
        return $this->db->insertID();
    }

    // Get Services with parameters
    public function get_services($param) {
        $builder = $this->db->table('tblservices');
        $builder->where($param);
        // $builder->orderBy('CASE WHEN name = "Others" THEN 1 ELSE 0 END', 'ASC');
        $builder->orderBy('unit', 'ASC');
        $builder->orderBy('name', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // Get All Data
    public function get_all_data($tablename) {
        $builder = $this->db->table($tablename);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // Get Active Quarter
    public function get_active_quarter() {
        $builder = $this->db->table('tblquarters');
        $builder->where('is_active', 1);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
