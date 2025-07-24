<?php

namespace App\Models;

use CodeIgniter\Model;


class RegistryModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect(); // Load the database
    }

    public function get_offices(){
        $query = $this->db->table('tbloffice')->get();
        return $query->getResultArray();
    }


    public function get_signatories_not_approver()
    {
        return $this->db->table('tblsignatories a')
            ->select('a.*, b.name as officename')
            ->join('tbloffice b', 'b.shorthand = a.office', 'left')
            ->where('a.is_approver', 0)
            ->orderBy('a.office')
            ->get()
            ->getResultArray();
    }

    
    public function get_signatory_approver()
    {
        return $this->db->table('tblsignatories')
            ->select('*')
            ->where('is_approver', 1)
            ->get()
            ->getRowArray();
    }


    public function insert_data($tablename, $data)
    {
        $builder = $this->db->table($tablename);
        $builder->insert($data);
        return $this->db->insertID();
    }

    public function update_data($tablename, $data, $where)
    {
        $builder = $this->db->table($tablename);
        return $builder->update($data, $where);
    }

    public function delete_data($tablename, $where) {
        $builder = $this->db->table($tablename);
        return $builder->delete($where);
    }




}
