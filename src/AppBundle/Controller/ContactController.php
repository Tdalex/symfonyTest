<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contact controller.
 *
 * @Route("contact")
 */
class ContactController extends Controller
{
    /**
     * Contact form
     *
     * @Route("/", name="contact_index")
     * @Method("GET")
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\ContactType',null,array(
            'action' => $this->generateUrl('contact_index'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if($form->isValid()){
                if(!$this->sendEmail($form->getData())){
                    var_dump("Errooooor :(");
                }
            }
        }

        return $this->render('AppBundle:contact:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function sendEmail($data){
        $mailer = \Swift_Mailer::newInstance();
        
        $message = \Swift_Message::newInstance("Our Code World Contact Form ". $data["subject"])
        ->setFrom(array($myappContactMail => "Message by ".$data["name"]))
        ->setTo(array(
            $myappContactMail => $myappContactMail
        ))
        ->setBody($data["message"]."<br>ContactMail :".$data["email"]);
        
        return $mailer->send($message);
    }
}
