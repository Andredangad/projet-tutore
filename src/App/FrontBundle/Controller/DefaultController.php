<?php
namespace App\FrontBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
<<<<<<< HEAD

      return $this->render('fr/accueil/index.html.twig');

=======
  		$foo = $request->get('langue');
		if ($foo == "login"){
        return $this->render('fr/accueil/index.html.twig');
			
		}
		else
      return $this->render($foo.'/accueil/index.html.twig');
    }
>>>>>>> parent of a7775bf... Changement routes
}

    public function langueAction(Request $request)
    {

      return $this->render('en/accueil/index.html.twig');

}

}


