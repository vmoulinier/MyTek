<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 22/06/2017
 * Time: 03:47
 */

namespace App\Controller;


use Core\Controller\Controller;

class GroupesController extends Controller
{

    public function index() {
        $this->template = 'default';
        $this->render('groupes/index');
    }
}