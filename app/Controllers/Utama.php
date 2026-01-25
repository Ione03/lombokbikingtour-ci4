<?php

namespace App\Controllers;

use App\Models\UtamaModel;

class Utama extends BaseController
{
    protected $utamaModel;
    
    public function __construct()
    {
        $this->utamaModel = new UtamaModel();
    }
    
    /**
     * Main page index
     * 
     * @return string
     */
    public function index()
    {
        try {
            $data['value'] = $this->utamaModel->getData();
        } catch (\Exception $e) {
            // If database connection fails, provide empty array
            log_message('error', 'Database error in Utama::index - ' . $e->getMessage());
            $data['value'] = [];
        }
        
        return view('utama', $data);
    }
    
    /**
     * Package filter AJAX endpoint
     * 
     * @param string $pIdx Package index
     * @return \CodeIgniter\HTTP\Response
     */
    public function packageFilter($pIdx = '0')
    {
        $data['value'] = $this->utamaModel->getPackageFilter($pIdx);
        
        return $this->response->setJSON($data['value']);
    }
}
