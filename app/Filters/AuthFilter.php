<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if (!$session->get('is_admin')) {
            return redirect()->to('/admin/login')->with('error', 'Please login first.');
        }

        // Check 5 minutes idle time (300 seconds)
        $lastActivity = $session->get('last_activity');
        if ($lastActivity && (time() - $lastActivity > 300)) {
            $session->destroy();
            return redirect()->to('/admin/login')->with('error', 'Session timeout. Please login again.');
        }

        // Update activity timestamp
        $session->set('last_activity', time());
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
