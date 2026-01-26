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

        // Pass generic data if needed (e.g. for header/footer common vars if they exist)
        // Utama controller passes $value for everything. 
        // We might need to copy some header/footer logic or just duplicate the layout.
        // For now, let's assume valid pages.
        
        return view('page', $data);
    }
}
