<?php

namespace App\Controllers;

use function App\Helpers\myPrint;

class Home extends BaseController
{
    public function index(): string
    {
        // return view('welcome_message');
        // myPrint($this->data, true, true);
		return view('themes/'. $this->data['currentTheme'] .'/pages/home', $this->data);

    }
}
