<?php
// src/App/FrontBundle/Controller/LessonController.php
namespace App\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use App\FrontBundle\Entity\Cours;

class LessonController extends Controller
{

    public function lessonAction(Request $request)
    {
		$user = $this->getUser();
		$em = $this->getDoctrine()->getManager();
        $QUERY = 'SELECT * FROM `matiere` WHERE filiere="'.$user->getFiliere().'"';

        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();

        $resultat = $jour->fetchAll();
		$QUERYS = 'SELECT DISTINCT titre,id FROM matiere';


        $state = $em->getConnection()->prepare($QUERYS);
        $state->execute();

        $results = $state->fetchAll();
        $foo = $request->get('langue');
        return $this->render($foo.'/cours/lesson.html.twig', array(
		'affichage'=>$resultat,
		'modifier'=>$results,

		));
    }

    public function showMatieresAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();
        $QUERY = 'SELECT * FROM `matiere`';

        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();

        $resultat = $jour->fetchAll();
        $foo = $request->get('langue');
      return $this->render($foo.'/cours/showMatieres.html.twig', array(
        'affichage'=>$resultat,));
    }

    public function showCoursAction(Request $request)
    {
		$foo = $request->get('id');
       $em = $this->getDoctrine()->getManager();
        $QUERY = 'SELECT * FROM `cours` WHERE id_matiere="'.$foo.'"';

        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();

        $resultat = $jour->fetchAll();
        $foo = $request->get('langue');
      return $this->render($foo.'/cours/showCours.html.twig', array(
        'affichage'=>$resultat,));
    }

    public function addCoursAction(Request $request)
    {
        $cours = new Cours();
        $form = $this->createForm('App\FrontBundle\Form\AddCoursType', $cours);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cours);
            $em->flush();
            return $this->redirectToRoute('app_lesson');
        }
        $foo = $request->get('langue');
        return $this->render($foo.'/cours/addCours.html.twig', array(
            'cours' => $cours,
            'form' => $form->createView(),
        ));
      }



    public function associerCoursMatiereAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      $QUERY = 'SELECT * FROM `cours`';

      $jour = $em->getConnection()->prepare($QUERY);
      $jour->execute();

      $cours = $jour->fetchAll();

      $em = $this->getDoctrine()->getManager();
      $QUERY = 'SELECT * FROM `matiere`';

      $jour = $em->getConnection()->prepare($QUERY);
      $jour->execute();

      $matieres = $jour->fetchAll();
      //----------------deuxième fonction---------------------------------------

      if(isset($_GET['submit'])){
        $matiere = $_GET['matiere'];
        $id = $_GET['cours'];
        $em = $this->getDoctrine()->getManager();
        $QUERY = 'UPDATE `cours` SET `id_matiere` = '.$matiere.' WHERE `cours`.`id` = '.$id.'';

        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();
      }
      else{
      }
      $foo = $request->get('langue');
      return $this->render($foo.'/cours/associerCoursMatiere.html.twig', array(
        'cours'=>$cours,'matiere'=>$matieres,));
    }

    public function associerEleveFiliereAction()
    {
      $em = $this->getDoctrine()->getManager();
      $QUERY = 'SELECT * FROM `etudiant`';

      $jour = $em->getConnection()->prepare($QUERY);
      $jour->execute();

      $eleve = $jour->fetchAll();

      $em = $this->getDoctrine()->getManager();
      $QUERY = 'SELECT * FROM `filiere`';

      $jour = $em->getConnection()->prepare($QUERY);
      $jour->execute();

      $filieres = $jour->fetchAll();
      //----------------deuxième fonction---------------------------------------

      if(isset($_GET['submit'])){
        $filiere = $_GET['filiere'];
        $id = $_GET['eleve'];
        $em = $this->getDoctrine()->getManager();
        $QUERY = 'UPDATE `etudiant` SET `id_filiere` = '.$filiere.' WHERE `etudiant`.`id` = '.$id.'';

        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();
      }
      else{
      }
      $foo = $request->get('langue');
      return $this->render($foo.'/cours/associerEleveFiliere.html.twig', array(
        'eleve'=>$eleve,'filiere'=>$filieres,));
    }

    public function editCoursAction(Request $request, Cours $cours)
    {
      $editForm = $this->createForm('App\FrontBundle\Form\CoursType', $cours);
        $editForm->handleRequest($request);
        $foo = $request->get('langue');
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute($foo.'app_lesson');
        }
        return $this->render($foo.'/cours/editCours.html.twig', array(
            'cours' => $cours,
            'edit_form' => $editForm->createView(),
        ));
    }

}
