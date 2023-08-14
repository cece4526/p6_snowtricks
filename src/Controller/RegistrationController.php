<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\UserAuthenticator;
use App\Service\SendMailService;
use App\Service\JWTService;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, JWTService $jwt ,SendMailService $mail , UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $now = new DateTimeImmutable();
            $user->setCreatedAt($now);
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];

            $payload = [
                'user_id' => $user->getId()
            ];

            $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));

            // do anything else you need here, like send an email
            $mail->send(
                'no-reply@snowtricks.fr',
                $user->getEmail(),
                'activatio de votre compte sur Snowtricks',
                'register',
                compact('user', 'token')
            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }
        $userRepository->remove($user);
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verife/{token}', name: 'verify_user')]
    public function VerifyUser($token, JWTService $jwt, UserRepository $userRepository, EntityManagerInterface $em) : Response 
    {
        if ($jwt->isValid($token) && !$jwt->isEpired($token) && $jwt->checkToken($token, $this->getParameter('app.jwtsecret'))) 
        {
            $payload = $jwt->getPayload($token);
            $user = $userRepository->find($payload['user_id']);

            if ($user && ! $user->getIsVerified()) 
            {
                $user->setIsVerified(true);
                $em->flush($user);
                $this->addFlash('succes', 'Utilisateur activé(e)');
                return $this->redirectToRoute('app_home');
            }
        }   

        $this->addFlash('danger', 'Le token est invalid ou a expiré');
        return $this->redirectToRoute('app_login');
    }
    
    #[Route('/renvoiverif', name: 'resend_verif')]
    public function ReSendVerif(JWTService $jwt, SendMailService $mail, UserRepository $userRepository) : Response 
    {
        $user =  $this->getUser();
        
        if (!$user) 
        {
            $this->addFlash('danger', 'vous devez etre connecté pour accéder à cette page');
            return $this->redirectToRoute('app_login');
        }

        if ($user->getIsVerified()) {
            $this->addFlash('warning', 'Cette utilisateur est déjà activé');
            return $this->redirectToRoute('app_home');
        }
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        $payload = [
            'user_id' => $user->getId()
        ];

        $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));

        // do anything else you need here, like send an email
        $mail->send(
            'no-reply@snowtricks.fr',
            $user->getEmail(),
            'activatio de votre compte sur Snowtricks',
            'register',
            compact('user', 'token')
        );
        $this->addFlash('succes', 'email de vérification renvoyé');
        return $this->redirectToRoute('app_home');
    }
}
