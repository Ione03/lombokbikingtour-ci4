<?php

namespace App\Controllers;

use App\Models\UtamaModel;

class Page extends BaseController
{
    protected $utamaModel;

    public function __construct()
    {
        $this->utamaModel = new UtamaModel();
    }

    public function index($slug)
    {
        $data['page'] = $this->utamaModel->find($slug);

        if (empty($data['page'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Fetch all data for footer/navigation
        $data['value'] = $this->utamaModel->getData();
        
        return view('page', $data);
    }
}
