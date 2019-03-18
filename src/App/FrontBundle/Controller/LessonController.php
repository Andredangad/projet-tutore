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
      return $this->render('cours/showMatieres.html.twig', []);
    }

    public function showCoursAction()
    {
      return $this->render('cours/showCours.html.twig', []);
    }

    public function addCoursAction()
    {
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
