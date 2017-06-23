<?php

namespace App\Controller;

use App\Entity\Mediatheque;
use App\Model\UserRepository;
use Core\Controller\Controller;
use Core\HTML\TemplateForm;

class RechercheController extends Controller
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

        $form = new TemplateForm($_POST);
        $user = $this->getCurrentUser();

        if(isset($_POST['id_add']))
        {
            $id = $_POST['id_add'];

            $exist = $this->entityManager->getRepository('App\Entity\Mediatheque')->findOneBy(array('code_film' => $id, 'user' => $user));
            if($exist) {
                $this->entityManager->remove($exist);
                $this->entityManager->flush();
                return;
            }
            $mediatheque = new Mediatheque();
            $mediatheque->setCodeFilm($id);
            $mediatheque->setUser($user);
            $this->entityManager->persist($mediatheque);
            $this->entityManager->flush();
        }

        if(isset($_POST['id_del']))
        {
            $id = $_POST['id_del'];
            $exist = $this->entityManager->getRepository('App\Entity\Mediatheque')->findOneBy(array('code_film' => $id, 'user' => $user));
            if(!$exist) {
                $mediatheque = new Mediatheque();
                $mediatheque->setCodeFilm($id);
                $mediatheque->setUser($user);
                $this->entityManager->persist($mediatheque);
                $this->entityManager->flush();
                return;
            }
            $mediatheque = $this->entityManager->getRepository('App\Entity\Mediatheque')->findOneBy(array('code_film' => $id, 'user' => $user));
            $this->entityManager->remove($mediatheque);
            $this->entityManager->flush();
        }

        if(!empty($_POST)) {

            $motsCles = $_POST['titre'];
            $page = 1;

            try
            {
                $movies = $this->helper->search($motsCles, $page, 16);
            }
            catch( \ErrorException $error )
            {
                echo "Erreur n°", $error->getCode(), ": ", $error->getMessage(), PHP_EOL;
            }
        }
        
        $this->template = 'default';
        $this->render('recherche/index', compact('form', 'movies', 'user'));
    }
}