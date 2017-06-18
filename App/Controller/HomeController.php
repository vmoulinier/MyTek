<?php

namespace App\Controller;

use Core\Controller\Controller;

class HomeController extends Controller
{
    public function index() {
        $user = $this->getCurrentUser();
        $this->template = 'default';
        $this->render('home/index', compact('user'));
    }
}