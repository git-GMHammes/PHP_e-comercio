<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $helpers = ['form', 'url', 'general'];

    protected $currentUser = null;
    protected $data = [];
    protected $session = null;
    protected $db;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;

        if (service('auth')->loggedIn()) {
            $this->currentUser = service('auth')->user();
        }

        $this->data['currentUser'] = $this->currentUser;
        $this->data['currentTheme'] = 'indomarket';
        $this->data['auth'] = service('auth');

        $this->db = \Config\Database::connect();
    }
}