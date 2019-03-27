<?php
namespace App\FrontBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
		$foo = $request->get('langue');
		if ($foo == "fr"){
        return $this->render('Accueil/index1.html.twig');
		}
	else{
		return $this->render('Accueil/index.html.twig');
    }

}}