<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request, 
        MailerInterface $mailer, 
        EntityManagerInterface $entityManager
    ): Response {

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted())  {

            // Obtenir la réponse du captcha
            $captchaResponse = $request->request->get('g-recaptcha-response');

            // Préparer la requête à l'API de vérification de reCAPTCHA
            $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptchaSecret = $this->getParameter('google_recaptcha_secret');

            $recaptchaUrl .= '?secret=' . $recaptchaSecret . '&response=' . $captchaResponse;

            // Exécuter la requête
            $verifyResponse = file_get_contents($recaptchaUrl);

            // Décoder la réponse
            $responseData = json_decode($verifyResponse);

            // error_log(print_r($responseData, true));

            // Vérifier que le captcha a été validé
            if (!$responseData->success) {
                // Le captcha n'a pas été validé, afficher un message d'erreur
                $this->addFlash('error', 'Erreur de captcha. Veuillez réessayer.');
                return $this->redirectToRoute('app_contact');
            }

            if ($form->isValid()) {

                $data = $form->getData();

                $email = $data->getEmail(); // Access the email property using the getEmail() method
                $message = $data->getMessage(); // Access the message property using the getMessage() method
                $data->setDateCreation();
            
                $entityManager->persist($data);         
                $entityManager->flush();
                

                $emailObject = (new Email())
                    ->from('contact@firstcom.fr')
                    ->to($email)
                    ->subject('FIRSTCOM - Votre demande de contact...')
                    ->text($message)
                    ->html('<p>Bonjour</p>
                            <p>Nous avons bien reçu votre demande de contact.</p>
                            <p>Nous ne manquerons pas de revenir vers vous prochainement.</p>
                            <p>À bientôt.</p>
                            <p>Firstcom.</p>');

                try {
                    $mailer->send($emailObject);
                } catch (\Symfony\Component\Mailer\Exception\TransportException $e) {
                    // Vous pouvez ici logger l'erreur, afficher un message, etc.
                    error_log($e->getMessage());
                }
                            

                $managerEmail = "hamid@firstcom.fr"; 

                $managerEmailObject = (new Email())
                    ->from('contact@firstcom.fr')
                    ->to($managerEmail)
                    ->subject('Une nouvelle demande de contact a été reçue')
                    ->text('Une nouvelle demande de contact a été reçue de ' . $email . '. Le message était : ' . $message)
                    ->html('<p>Bonjour,</p>
                                <p>Une nouvelle demande de contact a été reçue de ' . $email . '.</p>
                                <p>Le message était : </p>
                                <p>' . $message . '</p>');

                try {
                    $mailer->send($managerEmailObject);
                } catch (\Symfony\Component\Mailer\Exception\TransportException $e) {
                    // Vous pouvez ici logger l'erreur, afficher un message, etc.
                    error_log($e->getMessage());
                }
                        
            }
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form->createView(), // Use createView() to render the form
        ]);
    }
}
