<?php
// src/AppBundle/Controller/LuckyController.php
namespace App\FrontBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use App\FrontBundle\Entity\Contact;

class ContactController extends Controller
{
    /**
    * @Route("/form", name="homepage")
    */
    public function contactAction(Request $request)
    {
      $foo = $request->get('langue');
    	$user = $this->getUser();
      $contact = new Contact;
     # Add form fields
       if ($foo == 'fr') {
        $form = $this->createFormBuilder($contact)
         ->add('name', TextType::class, array('label'=> 'nom', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px','value'=>$user->getUsername())))
         ->add('email', TextType::class, array('label'=> 'email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px','value'=>$user->getEmail())))
         ->add('message', TextareaType::class, array('label'=> 'message','attr' => array('class' => 'form-control')))
         ->add('Save', SubmitType::class, array('label'=> 'valider', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))
         ->getForm();
       }
       else {
         $form = $this->createFormBuilder($contact)
         ->add('name', TextType::class, array('label'=> 'name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px','value'=>$user->getUsername())))
         ->add('email', TextType::class, array('label'=> 'email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px','value'=>$user->getEmail())))
         ->add('message', TextareaType::class, array('label'=> 'message','attr' => array('class' => 'form-control')))
         ->add('Save', SubmitType::class, array('label'=> 'submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))
         ->getForm();
       }
     # Handle form response
       $form->handleRequest($request);
	       # check if form is submitted
           if($form->isSubmitted() &&  $form->isValid()){
               $name = $form['name']->getData();
               $email = $form['email']->getData();

               $message = $form['message']->getData();
         # set form data
               $contact->setName($name);
               $contact->setEmail($email);
               $contact->setMessage($message);
          # finally add data in database
               $sn = $this->getDoctrine()->getManager();
               $sn -> persist($contact);
		   $sn -> flush();
		   		       $message1 = \Swift_Message::newInstance()
                   ->setFrom('andre.dang@hotmail.fr')
                   ->setTo($email)
                   ->setBody($this->renderView('emails/sendemail.html.twig',array('name' => $name)),'text/html');
			$this->get('mailer')->send($message1);
				 $message1 = \Swift_Message::newInstance()
                   ->setFrom($email)
                   ->setTo('unilim.andre@gmail.com')
                   ->setBody($this->renderView('emails/sendmessage.html.twig',array('message' => $message,'name' => $name, 'email' => $email)),'text/html');
			$this->get('mailer')->send($message1);


		   }

	    return $this->render($foo.'/contact/contact.html.twig',array('form' => $form->createView()));
    }

}
