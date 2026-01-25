<?php

namespace App\Models;

use CodeIgniter\Model;

class UtamaModel extends Model
{
    protected $table = 'm_teks';
    protected $primaryKey = 'kd_teks';
    protected $allowedFields = ['kd_teks', 'teks', 'other_teks', 'img', 'status', 'group_data', 'last_update'];
    
    /**
     * Get data by ID
     */
    public function getById($kode)
    {
        return $this->select('teks')
                    ->where('kd_teks', $kode)
                    ->first();
    }
    
    /**
     * Get all data from m_teks table
     */
    public function getData()
    {
        return $this->findAll();
    }
    
    /**
     * Get package data filtered by package index
     * 
     * @param string $pIdx Package index (0 for all, 1+ for specific group)
     * @return array
     */
    public function getPackageFilter($pIdx)
    {
        $builder = $this->where('status', '5');
        
        if ($pIdx != '0') {
            $builder->where('group_data', (intval($pIdx) - 1));
        }
        
        return $builder->orderBy('RAND()')
                      ->get()
                      ->getResult();
    }
}
