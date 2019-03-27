<?php

namespace App\FrontBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppFrontBundle extends Bundle
{
  public function indexAction()
  {
    return $this->render('fr/accueil/index.html.twig');
  }
}
