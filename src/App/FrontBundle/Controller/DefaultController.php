<?php
namespace App\FrontBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
  		$foo = $request->get('langue');
      return $this->render($foo.'/accueil/index.html.twig');
    }
}
