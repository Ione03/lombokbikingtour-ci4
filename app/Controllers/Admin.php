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



    public function index($status = null) 
    {

        
        $session = session();
        
        // Sticky Tab Logic
        if ($status !== null) {
            $session->set('last_admin_status', $status);
        } else {
            if ($session->has('last_admin_status')) {
                return redirect()->to('/admin/status/' . $session->get('last_admin_status'));
            }
            $status = 1;
            $session->set('last_admin_status', $status);
        }
        
        $sort = $this->request->getGet('sort') ?? 'kd_teks';
        $order = $this->request->getGet('order') ?? 'asc';
        
        // Define allowed sort columns to prevent SQL injection
        $allowedSorts = ['kd_teks', 'teks', 'other_teks', 'last_update'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'kd_teks';
        }
        
        // Fetch data with sorting
        $data['items'] = $this->utamaModel->where('status', $status)
                                          ->orderBy($sort, $order)
                                          ->findAll();
                                          
        $data['current_status'] = $status;
        $data['sort'] = $sort;
        $data['order'] = $order;
        // Fetch counts for tabs
        $data['counts'] = [
            0 => $this->utamaModel->where('status', 0)->countAllResults(),
            1 => $this->utamaModel->where('status', 1)->countAllResults(),
            5 => $this->utamaModel->where('status', 5)->countAllResults(),
            6 => $this->utamaModel->where('status', 6)->countAllResults(),
            7 => $this->utamaModel->where('status', 7)->countAllResults(),
        ];

        
        return view('admin/dashboard', $data);
    }

    public function create()
    {


        // Default empty item for packages
        $data['item'] = [
            'kd_teks' => '', // Auto-increment or manual? DB uses string ID usually. Let's assume manual or auto. 
                             // Looking at DB, it is 'kd_teks'. If it's not auto-inc, user must provide.
                             // I'll assume I need to generate or let user input. 
                             // For simplicity given the inputs, I'll let user input or generate uniquely.
                             // Actually, let's look at edit view. It shows ID in header but not input.
                             // I will enable ID input for create.
            'teks' => '',
            'other_teks' => '',
            'status' => '5', // Default to package
            'group_data' => '1',
            'img' => ''
        ];
        $data['is_new'] = true;

        return view('admin/edit', $data);
    }

    public function store()
    {


        $img = $this->request->getFile('img');
        $imgName = '';

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move(FCPATH . 'assets/themes/images', $imgName);
            
            // Smart Crop Logic
            $db = \Config\Database::connect();
            $query = $db->query("SELECT img_width, img_height FROM g_settings WHERE kd_setting = 'S04' LIMIT 1");
            $settings = $query->getRow();
            
            if ($settings && !empty($settings->img_width) && !empty($settings->img_height)) {
                try {
                    $image = \Config\Services::image();
                    $image->withFile(FCPATH . 'assets/themes/images/' . $imgName)
                          ->fit($settings->img_width, $settings->img_height, 'center')
                          ->save(FCPATH . 'assets/themes/images/' . $imgName);
                } catch (\Exception $e) {
                    // Log error or continue if image processing fails
                    log_message('error', 'Image processing failed: ' . $e->getMessage());
                }
            }
        }
        
        // Generate a simple ID if not provided? Model says primaryKey = kd_teks.
        // I'll grab a posted ID or generate one like "PKG" . time()
        $id = $this->request->getPost('kd_teks');
        if (!$id) {
            $id = 'PKG' . date('ymdHis');
        }

        $data = [
            'kd_teks' => $id,
            'teks' => $this->request->getPost('teks'),
            'other_teks' => $this->request->getPost('other_teks'),
            'status' => $this->request->getPost('status'),
            'group_data' => $this->request->getPost('group_data'), 
            'img' => $imgName,
            'last_update' => date('Y-m-d H:i:s')
        ];

        $this->utamaModel->insert($data);

        return redirect()->to('/admin/status/5')->with('success', 'Package created successfully');
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


        $data['item'] = $this->utamaModel->find($id);
        
        if (empty($data['item'])) {
            return redirect()->to('/admin')->with('error', 'Item not found');
        }
        
        $data['is_new'] = false;

        return view('admin/edit', $data);
    }

    public function update($id)
    {


        $img = $this->request->getFile('img');
        $imgName = $this->request->getPost('old_img');

        // Handle Image Upload
        // Handle Image Upload
        if ($img && $img->isValid() && !$img->hasMoved()) {
            // Delete old image if exists
            $oldImg = $this->request->getPost('old_img');
            if ($oldImg && file_exists(FCPATH . 'assets/themes/images/' . $oldImg)) {
                unlink(FCPATH . 'assets/themes/images/' . $oldImg);
            }

            $imgName = $img->getRandomName();
            $img->move(FCPATH . 'assets/themes/images', $imgName);
            
            // Smart Crop Logic
            $db = \Config\Database::connect();
            $query = $db->query("SELECT img_width, img_height FROM g_settings WHERE kd_setting = 'S04' LIMIT 1");
            $settings = $query->getRow();
            
            if ($settings && !empty($settings->img_width) && !empty($settings->img_height)) {
                try {
                    $image = \Config\Services::image();
                    $image->withFile(FCPATH . 'assets/themes/images/' . $imgName)
                          ->fit($settings->img_width, $settings->img_height, 'center')
                          ->save(FCPATH . 'assets/themes/images/' . $imgName);
                } catch (\Exception $e) {
                    // Log error or continue if image processing fails
                    log_message('error', 'Image processing failed: ' . $e->getMessage());
                }
            }
        } elseif ($this->request->getPost('delete_img') == '1') {
            // Remove Image Requested
            $oldImg = $this->request->getPost('old_img');
            if ($oldImg && file_exists(FCPATH . 'assets/themes/images/' . $oldImg)) {
                unlink(FCPATH . 'assets/themes/images/' . $oldImg);
            }
            $imgName = '';
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

        
        // Delete image file if exists
        $item = $this->utamaModel->find($id);
        if ($item && !empty($item['img'])) {
            if (file_exists(FCPATH . 'assets/themes/images/' . $item['img'])) {
                unlink(FCPATH . 'assets/themes/images/' . $item['img']);
            }
        }

        $this->utamaModel->delete($id);
        return redirect()->to('/admin/status/5')->with('success', 'Item deleted successfully');
    }
}
