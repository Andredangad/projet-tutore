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

      
      if(isset($_POST['Valider'])){
      $titre = $_POST['titre'];
      $matiere = $_POST['matiere'];
      $description = $_POST['description'];

      $em = $this->getDoctrine()->getManager();
        $QUERY = 'INSERT INTO `cours` (`id`, `titre`, `id_matiere`, `description`) VALUES (NULL, '.$titre.', '.$matiere.', '.$description.')';


        $jour = $em->getConnection()->prepare($QUERY);
        $jour->execute();
      }
      else{

      }
      return $this->render('cours/addCours.html.twig', []);
    }

    public function associerCoursMatiereAction()
    {
      return $this->render('cours/associerCoursMatiere.html.twig', []);
    }

    public function associerEleveFiliereAction()
    {
      return $this->render('cours/associerEleveFiliere.html.twig', []);
    }

    public function editCoursAction()
    {
      return $this->render('cours/editCours.html.twig', []);
    }
}
