<?php

namespace App\Controllers;

use App\Models\UtamaModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $utamaModel;

    public function __construct()
    {
        $this->utamaModel = new UtamaModel();
        helper(['form', 'url']);
    }

    private function checkSession()
    {
        $session = session();
        if (!$session->get('is_admin')) {
            return false;
        }

        // Check 5 minutes idle time (300 seconds)
        $lastActivity = $session->get('last_activity');
        if ($lastActivity && (time() - $lastActivity > 300)) {
            $session->destroy();
            return false;
        }

        // Update activity timestamp
        $session->set('last_activity', time());
        return true;
    }

    public function index($status = 1) // Default to Active (1) instead of All
    {
        if (!$this->checkSession()) {
            return redirect()->to('/admin/login');
        }
        
        $data['items'] = $this->utamaModel->where('status', $status)->findAll();
        $data['current_status'] = $status;
        
        return view('admin/dashboard', $data);
    }

    public function login()
    {
        if (session()->get('is_admin')) {
            return redirect()->to('/admin');
        }
        
        // Generate Math Captcha
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        session()->set('captcha_answer', $num1 + $num2);
        
        $data['captcha_question'] = "$num1 + $num2 = ?";
        return view('admin/login', $data);
    }

    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $captcha = $this->request->getPost('captcha');
        
        // Check Captcha
        if ($captcha != session()->get('captcha_answer')) {
            return redirect()->to('/admin/login')->with('error', 'Incorrect Captcha');
        }

        // Hardcoded Credentials
        if ($username === 'admin' && $password === 'admin123') {
            session()->set('is_admin', true);
            session()->set('last_activity', time()); // Set initial activity
            return redirect()->to('/admin');
        } else {
            return redirect()->to('/admin/login')->with('error', 'Invalid Username or Password');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }

    public function edit($id)
    {
        if (!$this->checkSession()) {
            return redirect()->to('/admin/login');
        }

        $data['item'] = $this->utamaModel->find($id);
        
        if (empty($data['item'])) {
            return redirect()->to('/admin')->with('error', 'Item not found');
        }

        return view('admin/edit', $data);
    }

    public function update($id)
    {
        if (!$this->checkSession()) {
            return redirect()->to('/admin/login');
        }

        $img = $this->request->getFile('img');
        $imgName = $this->request->getPost('old_img');

        // Handle Image Upload
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move(FCPATH . 'assets/themes/images', $imgName);
        }

        $data = [
            'teks' => $this->request->getPost('teks'),
            'other_teks' => $this->request->getPost('other_teks'),
            'status' => $this->request->getPost('status'),
            'group_data' => $this->request->getPost('group_data'), 
            'img' => $imgName,
            'last_update' => date('Y-m-d H:i:s')
        ];

        $this->utamaModel->update($id, $data);

        return redirect()->to('/admin')->with('success', 'Data updated successfully');
    }

    public function delete($id)
    {
        if (!$this->checkSession()) {
            return redirect()->to('/admin/login');
        }
        // $this->utamaModel->delete($id); // Uncomment to enable
        return redirect()->to('/admin')->with('error', 'Delete disabled for safety');
    }
}
