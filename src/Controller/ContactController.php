<?php

namespace App\Controller;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\ContactFormType; // Add this line at the top

class ContactController extends AbstractController
{

/**
 * @Route("/contact", name="contact", methods={"GET"})
 */
public function showContactForm(): Response
{
    $form = $this->createForm(ContactFormType::class);

    return $this->render('contact/form.html.twig', [
        'form' => $form->createView(),
    ]);
}

    /**
     * @Route("/contact", name="contact_submit", methods={"POST"})
     */
    public function submitContactForm(Request $request): Response
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $message = $request->request->get('message');

        // Perform validation on the form fields

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'your-mailtrap-username';
            $mail->Password = 'your-mailtrap-password';
            $mail->Port = 587;

            $mail->setFrom($email, $name);
            $mail->addAddress('your-email@example.com'); // Replace with your email address
            $mail->Subject = 'New Contact Message';
            $mail->Body = $message;

            $mail->send();

            // Redirect or display a success message
            return $this->redirectToRoute('contact_success');
        } catch (Exception $e) {
            // Handle the exception if sending email fails
            return $this->redirectToRoute('contact_failure');
        }
    }

    /**
     * @Route("/contact/success", name="contact_success")
     */
    public function contactSuccess(): Response
    {
        return $this->render('contact/success.html.twig');
    }

    /**
     * @Route("/contact/failure", name="contact_failure")
     */
    public function contactFailure(): Response
    {
        return $this->render('contact/failure.html.twig');
    }
}
