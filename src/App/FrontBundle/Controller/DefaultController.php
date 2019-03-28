<?php
namespace App\FrontBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
  		$foo = $request->get('langue');
		if ($foo == "login"){
        return $this->render('fr/accueil/index.html.twig');
			
		}
		else
      return $this->render('fr/accueil/index.html.twig');
    }
}
