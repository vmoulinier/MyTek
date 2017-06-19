<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 19/06/2017
 * Time: 02:17
 */

namespace App\Controller;


use Core\Controller\Controller;
use Core\HTML\TemplateForm;

class RechercheController extends Controller
{
    public function index() {

        $form = new TemplateForm($_POST);

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
        $this->render('recherche/index', compact('form', 'movies'));
    }
}