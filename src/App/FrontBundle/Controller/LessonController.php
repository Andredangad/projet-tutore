<?php
// src/App/FrontBundle/Controller/LessonController.php
namespace App\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LessonController extends Controller
{

    public function lessonAction()
    {
        return $this->render('cours/lesson.html.twig', [
        ]);
    }

    public function showMatieresAction()
    {
      $em = $this->getDoctrine()->getManager();
        $QUERY = 'SELECT * FROM `matiere`';

        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();

        $resultat = $jour->fetchAll();

      return $this->render('cours/showMatieres.html.twig', array(
        'affichage'=>$resultat,));
    }

    public function showCoursAction()
    {
       $em = $this->getDoctrine()->getManager();
        $QUERY = 'SELECT * FROM `cours`';

        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();

        $resultat = $jour->fetchAll();
      return $this->render('cours/showCours.html.twig', array(
        'affichage'=>$resultat,));
    }

    public function addCoursAction()
    {
      $em = $this->getDoctrine()->getManager();
      $QUERY = 'SELECT * FROM `matiere`';

      $jour = $em->getConnection()->prepare($QUERY);
      $jour->execute();

      $matieres = $jour->fetchAll();

      if(isset($_GET['submit'])){
      $titre = $_GET['titre'];
      $matiere = $_GET['matiere'];
      $description = $_GET['description'];

      $em = $this->getDoctrine()->getManager();
        $QUERY = 'INSERT INTO `cours` (`titre`, `id_matiere`, `description`) VALUES (\''.$titre.'\', \''.$matiere.'\', \''.$description.'\')';


        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();
      }
      else{

      }

      return $this->render('cours/addCours.html.twig', array('matiere'=>$matieres,));
    }

    public function associerCoursMatiereAction()
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
      return $this->render('cours/associerCoursMatiere.html.twig', array(
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
      return $this->render('cours/associerEleveFiliere.html.twig', array(
        'eleve'=>$eleve,'filiere'=>$filieres,));
    }

    public function editCoursAction()
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

      if(isset($_GET['submit'])AND isset($_GET['titre']) AND isset($_GET['matiere']) AND isset($_GET['description']) ){

        $titre = $_GET['titre'];
        $matiere = $_GET['matiere'];
        $description = $_GET['description'];
        $id = $_GET['cours'];
        $em = $this->getDoctrine()->getManager();
        $QUERY = 'UPDATE `cours` SET `titre` = \''.$titre.'\', `id_matiere` = '.$matiere.', `description` = \''.$description.'\' WHERE `cours`.`id` = '.$id.'';

        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();
      }

      else{
        echo ("Remplissez tous les champs !");
      }
      return $this->render('cours/editCours.html.twig', array(
        'cours'=>$cours, 'matiere'=>$matieres,));
    }
}
