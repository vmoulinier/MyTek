<?php

namespace App\Controller;

use App\Entity\Mediatheque;
use Core\Controller\Controller;
use App\Entity\User;

class MediathequeController extends Controller
{

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

        $this->template = 'default';
        $this->render('mediatheque/index', compact('movies'));
    }
}