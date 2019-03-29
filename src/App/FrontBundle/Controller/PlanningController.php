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

    public function planningAction(Request $request)
    {
 $user = $this->getUser();

	$foo = $request->get('langue');
		$em = $this->getDoctrine()->getManager();
        $planning = $em->getRepository('AppFrontBundle:Planning')->findAll();
		$RAW_QUERY = 'SELECT * FROM planning WHERE filiere="'.$user->getFiliere().'"AND langue="'.$foo.'"';
		
        
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();
		
		$QUERY = 'SELECT * FROM planning WHERE id=1';
        
        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();

        $resultat = $jour->fetchAll();
		
		$QUERYS = 'SELECT DISTINCT filiere FROM planning';
		
        
        $state = $em->getConnection()->prepare($QUERYS);
        $state->execute();

        $results = $state->fetchAll();
		
        return $this->render($foo.'/planning/planning.html.twig',array(
		'planning'=>$resultat,
		'affichage'=>$result,
		'modifier'=>$results,
		));


    }
		/**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
		$foo = $request->get('langue');
        $planning = new Planning();
        $form = $this->createForm('App\FrontBundle\Form\PlanningType', $planning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($planning);
            $em->flush();

            return $this->redirectToRoute('app_planning', array( 'langue' => $foo ));
        }

        return $this->render($foo.'/planning/new.html.twig', array(
            'planning' => $planning,
            'form' => $form->createView(),
        ));
    }
 public function modifierAction(Request $request)
    {
 $user = $this->getUser();


		$em = $this->getDoctrine()->getManager();
        $planning = $em->getRepository('AppFrontBundle:Planning')->findAll();

        return $this->render($foo.'/planning/modifier.html.twig',array(
		'planning'=>$planning
		));


    }
	 /**
     * Finds and displays a planning entity.
     *
     */
    public function showAction(Request $request)
    {
		$foo = $request->get('filiere');
		$em = $this->getDoctrine()->getManager();
        $planning = $em->getRepository('AppFrontBundle:Planning')->findAll();
		$RAW_QUERY = 'SELECT * FROM planning WHERE filiere="'.$foo.'"';
        
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
		$foo = $request->get('langue');
        return $this->render($foo.'/planning/show.html.twig', array(
            'planning' => $statement,
        ));
    }
	/**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Planning $planning)
    {
		$foo = $request->get('langue');
        $editForm = $this->createForm('App\FrontBundle\Form\PlanningType', $planning);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('app_planning', array( 'langue' => $foo ));
        }

        return $this->render($foo.'/planning/edit.html.twig', array(
            'planning' => $planning,
            'edit_form' => $editForm->createView(),
        ));
    }
	

}