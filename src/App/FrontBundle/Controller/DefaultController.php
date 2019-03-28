<?php
namespace App\FrontBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

      return $this->render('fr/accueil/index.html.twig');

}

    public function langueAction(Request $request)
    {

      return $this->render('en/accueil/index.html.twig');

}

}


