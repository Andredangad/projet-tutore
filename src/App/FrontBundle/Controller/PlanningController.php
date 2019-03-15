<?php
// src/AppBundle/Controller/LuckyController.php
namespace App\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use App\FrontBundle\Entity\Planning;

class PlanningController extends Controller
{

    public function planningAction()
    {
 $user = $this->getUser();


		$em = $this->getDoctrine()->getManager();
        $planning = $em->getRepository('AppFrontBundle:Planning')->findAll();
		$RAW_QUERY = 'SELECT * FROM planning WHERE filiere="'.$user->getFiliere().'"';
        
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();
		
		$QUERY = 'SELECT * FROM planning WHERE id=1';
        
        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();

        $resultat = $jour->fetchAll();
        return $this->render('planning/planning.html.twig',array(
		'planning'=>$resultat,
		'test'=>$result,
		));


    }
		/**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $planning = new Planning();
        $form = $this->createForm('App\FrontBundle\Form\PlanningType', $planning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($planning);
            $em->flush();

            return $this->redirectToRoute('app_planning');
        }

        return $this->render('planning/new.html.twig', array(
            'planning' => $planning,
            'form' => $form->createView(),
        ));
    }
	

}