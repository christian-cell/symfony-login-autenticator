<?php

namespace App\Controller;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/signUp",name="signUp")
     */
    public function renderLoginPage()
    {
      return $this->render("register/registro.html.twig");
    }

    /**
     * @Route("registro/completed",name="registro")
     */
    public function CreateNewUser(Request $request , EntityManagerInterface $doctrine , UserPasswordEncoderInterface $passwordEncoder)
    {
      $user = new User();
      $user->setUsername($request->get("username"));
      $user->setPassword($passwordEncoder->encodePassword($user , $request->get("password")));

      $doctrine->persist($user);
      $doctrine->flush();

      return $this->render("security/login.html");
    }
}


?>