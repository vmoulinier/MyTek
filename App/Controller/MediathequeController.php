<?php

namespace App\Controller;

use App\Entity\Mediatheque;
use App\Entity\Test;
use Core\Controller\Controller;
use App\Model\UserRepository;

class MediathequeController extends Controller
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
        $usersmovies = $this->entityManager->getRepository('App\Entity\mediatheque')->findBy(array('user' => $user));
        $movies = array();

        if(!empty($usersmovies)) {
            foreach ($usersmovies as $key => $usermovie) {
                $code_film = $usermovie->getCodeFilm();
                try
                {
                    // Envoi de la requête
                    $movie = $this->helper->movie($code_film, 'long' );
                    $movies[$key] = $movie;
                }
                catch( \ErrorException $error )
                {
                    // En cas d'erreur
                    echo "Erreur n°", $error->getCode(), ": ", $error->getMessage(), PHP_EOL;
                }
            }
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
            $mediatheque = $this->entityManager->getRepository('App\Entity\Mediatheque')->findOneBy(array('code_film' => $id));
            $this->entityManager->remove($mediatheque);
            $this->entityManager->flush();
        }

        if(isset($_POST['id_addgrp'])) {
            $id = $_POST['id_addgrp'];
            $mediatheque = $this->entityManager->getRepository('App\Entity\Mediatheque')->findOneBy(array('code_film' => $id, 'user' => $user));
            $exist = $this->entityManager->getRepository('App\Entity\Mediatheque')->findOneBy(array('code_film' => $id, 'user' => $user, 'groupe' => $user->getGroupe()));
            if($exist) {
                $mediatheque->setGroupe(null);
                $this->entityManager->merge($mediatheque);
                $this->entityManager->flush();
                return;
            }
            $mediatheque->setGroupe($user->getGroupe());
            $this->entityManager->merge($mediatheque);
            $this->entityManager->flush();
        }

        if(isset($_POST['id_delgrp'])) {
            $id = $_POST['id_del'];
            $mediatheque = $this->entityManager->getRepository('App\Entity\Mediatheque')->findOneBy(array('code_film' => $id, 'user' => $user));
            $exist = $this->entityManager->getRepository('App\Entity\Mediatheque')->findOneBy(array('code_film' => $id, 'user' => $user, 'groupe' => $user->getGroupe()));
            if($exist) {
                $mediatheque->setGroupe(null);
                $this->entityManager->merge($mediatheque);
                $this->entityManager->flush();
                return;
            }
            $mediatheque->setGroupe($user->getGroupe());
            $this->entityManager->merge($mediatheque);
            $this->entityManager->flush();
        }

        $this->template = 'default';
        $this->render('mediatheque/index', compact('movies', 'user'));
    }
}