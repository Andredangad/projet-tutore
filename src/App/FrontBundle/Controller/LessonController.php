<?php
// src/AppBundle/Controller/LuckyController.php
namespace App\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LessonController extends Controller
{

    public function lessonAction()
    {
        $number = random_int(0, 100);

        return $this->render('cours/lesson.html.twig', [
            'number' => $number,
        ]);
    }
}