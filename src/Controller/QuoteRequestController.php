<?php

namespace App\Controller;

use App\Entity\QuoteRequest;
use App\Form\QuoteRequestType;
use Flasher\Prime\FlasherInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class QuoteRequestController extends AbstractController
{
    #[Route('/devis', name: 'quote_request')]
    public function index(Request $request, MailerInterface $mailer, FlasherInterface $flasher): Response
    {
        $quoteRequest = new QuoteRequest();

        $form = $this->createForm(QuoteRequestType::class, $quoteRequest);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quoteRequest);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from($quoteRequest->getEmail())
                ->to('info@mywebcreation.be')
                ->subject('My Web Creation: Demande de devis n° '.$quoteRequest->getId())
                ->htmlTemplate('email/quote_request.html.twig')
                ->context([
                    'num'       => $quoteRequest->getId(),
                    'name'      => $quoteRequest->getName(),
                    'company'   => $quoteRequest->getCompany(),
                    'phone'     => $quoteRequest->getPhone(),
                    'userEmail'     => $quoteRequest->getEmail(),
                    'website'   => $quoteRequest->getWebsite(),
                    'pack'  => $quoteRequest->getPack(),
                    'options' => $quoteRequest->getOptions(),
                    'message'   => $quoteRequest->getMessage()
                ])
            ;

            $mailer->send($email);

            $builder = $flasher->type('success')
                ->message('Votre demande nous est bien parvenue. Nous y répondrons dans les plus brefs délais.')
                ->option('timer', 5000);

            $builder->flash();

            return $this->redirectToRoute('home');
        }

        return $this->render('quote_request/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
