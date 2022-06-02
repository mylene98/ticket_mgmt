<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/', name: 'app_login', methods: ['GET','POST'])]
    public function index5(AuthenticationUtils $authenticationUtils): Response

    {
        
        return $this->render('login/login.html.twig', [
              'last_username' => $authenticationUtils->getLastUsername(),
             'error'=> $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(){



    }
    #[Route('/account', name: 'app_account')]
    
    public function Myaccount(){
        return $this->render('profil/profil.html.twig',[
            'user' => $this->getUser()

        ]);




    }
   

    
    
   
}
