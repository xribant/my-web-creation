<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Flasher\Prime\FlasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer, FlasherInterface $flasher): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $ip = $request->getClientIp();

            $contact->setIp($ip);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);

            $subject = '[mywebcreation.be]: '.$contact->getSubject();
            $message = '<p><strong>Nom: '.$contact->getName().'</strong></p><p>'.$contact->getMessage().'</p>';

            $email = (new Email())
                ->from($contact->getEmail())
                ->to('info@mywebcreation.be')
                ->subject($subject)
                ->html($message);

            $mailer->send($email);
            $entityManager->flush();

            $builder = $flasher->type('success')
                ->message('Votre message nous est bien parevenu. Nous y répondrons dans les plus brefs délais.')
                ->option('timer', 5000);

            $builder->flash();
            return $this->redirectToRoute('home');
        }

        return $this->render('contact_form/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
