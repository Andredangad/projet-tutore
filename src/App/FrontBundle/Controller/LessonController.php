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
      return $this->render('cours/matieres.html.twig', []);
    }
}
