<?php

namespace App\Models;

use CodeIgniter\Model;


class HomeModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect(); // Load the database
    }

    public function get_data($tablename, $param)
    {
        $builder = $this->db->table($tablename . ' a');
        $builder->select('a.*, b.*');
        $builder->join('tbloffice b', 'a.officeid = b.officeid');
        $builder->where($param);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function get_active_quarter()
    {
        $builder = $this->db->table('tblquarters');
        $builder->where('is_active', 1);
        $query = $builder->get();

        return $query->getRowArray();
    }
}
