<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\Model\UserRepository;

class GroupesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $userrepo = new UserRepository();
        if(!$userrepo->islogged()){
            $this->denied();
        }
    }

    public function index() {
        $user = $this->getCurrentUser();
        $groupeuser = $user->getGroupe();
        $groupes = $this->getEntityManager()->getRepository('App\Entity\Groupe')->findAll();
        $this->template = 'default';
        $this->render('groupes/index', compact('groupeuser', 'groupes'));
    }

    public function infos() {
        $id = $_GET['id'];
        $groupe = $this->entityManager->getRepository('App\Entity\Groupe')->findOneBy(array('id' => $id));
        $this->template = 'default';
        if($groupe) {
            $this->render('groupes/infos', compact('groupe'));
        } else {
            $this->render('error/404');
        }


    }
}