<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use function App\Helpers\myPrint;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // myPrint('STOP C:\laragon\www\ci46comercio\src\app\Filters\AdminAuthFilter.php', true, true);
        // exit();

        if (!service('auth')->loggedIn()) {
            return redirect()->to('/login');
        }
        $user = service('auth')->user();
        
        // myPrint($user, true, true);
        
        if ($arguments !== null) {
            $hasAccess = false;
            foreach ($arguments as $group) {
                if ($user->inGroup($group)) {
                    $hasAccess = true;
                    break;
                }
            }

            if (!$hasAccess) {
                session()->setFlashdata('error', "You don't have permission to access this page.");
                return redirect()->to('/');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}