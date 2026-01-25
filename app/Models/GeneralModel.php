<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
    /**
     * Get current date in Y-m-d format
     */
    public function getCurrentDate()
    {
        $timezone = new \DateTimeZone('Asia/Jakarta'); // Changed from Kolkata to Jakarta for Lombok
        $date = new \DateTime('now', $timezone);
        
        return $date->format('Y-m-d');
    }
    
    /**
     * Get current date in format: dd mmmm yyyy hh:mm:ss
     */
    public function getCurrentDateFormat1()
    {
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $date = new \DateTime('now', $timezone);
        
        return $date->format('d F Y H:i:s');
    }
    
    /**
     * Get current date in format: dd/mm/yyyy hh:mm:ss
     */
    public function getCurrentDateFormat2()
    {
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $date = new \DateTime('now', $timezone);
        
        return $date->format('d/m/Y H:i:s');
    }
    
    /**
     * Get current date in format: dd/mm/yyyy
     */
    public function getCurrentDateFormat3()
    {
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $date = new \DateTime('now', $timezone);
        
        return $date->format('d/F/Y');
    }
    
    /**
     * Load last code from tmp_last_code table
     */
    public function loadLastCode($tablename)
    {
        $builder = $this->db->table('tmp_last_code');
        $query = $builder->select('last_code')
                        ->where('kd_table', $tablename)
                        ->limit(1)
                        ->get();
        
        if ($query->getNumRows() == 1) {
            return $query->getResult();
        }
        
        return 0;
    }
    
    /**
     * Save last code to tmp_last_code table
     */
    public function saveLastCode($tablename, $lastcode)
    {
        if ($lastcode == '') {
            $lastcode = '1';
        }
        
        $data = [
            'kd_table' => $tablename,
            'last_code' => $lastcode
        ];
        
        $result = $this->loadLastCode($tablename);
        $builder = $this->db->table('tmp_last_code');
        
        if ($result) {
            // Update existing record
            $builder->where('kd_table', $tablename)->update($data);
        } else {
            // Insert new record
            $builder->insert($data);
        }
    }
    
    /**
     * Check if primary key is unique
     */
    public function isUnique($tablename, $primarykey)
    {
        $builder = $this->db->table($tablename);
        $query = $builder->where($primarykey)
                        ->limit(1)
                        ->get();
        
        if ($query->getNumRows() == 1) {
            return false; // Not unique
        }
        
        return true; // Is unique
    }
    
    /**
     * Increment last code (e.g., A001 becomes A002)
     */
    public function incLastCode($data)
    {
        $arr = [];
        for ($i = strlen($data) - 1; $i >= 0; $i--) {
            $arr[] = substr($data, $i, 1);
        }
        
        $num = '';
        $isNum = 0;
        
        foreach ($arr as $r) {
            if ($isNum == 0 && is_numeric($r)) {
                $num = $r . $num;
            } else {
                $isNum = 1;
            }
        }
        
        $num2 = $num + 1;
        
        // Maintain leading zeros
        for ($i = strlen($num2); $i < strlen($num); $i++) {
            $num2 = '0' . $num2;
        }
        
        return str_replace($num, $num2, $data);
    }
}
