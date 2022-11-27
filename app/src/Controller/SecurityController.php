<?php

namespace App\Controller;

use App\Entity\User;
use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Route\Route;

class SecurityController extends AbstractController
{
    #[Route('/login', name: "login", methods: ["POST"])]
    public function login()
    {
        $formUsername = $_POST['username'] = "toto";
        $formPwd = $_POST['password'] = "toto";

        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($formUsername);

        if (!$user) {
            header("Location: /?error=notfound");
            exit;
        }

        if ($user->passwordMatch($formPwd)) {

            $this->render("user/showUsers.php", [
                "message" => "je suis un message"
            ],
                "titre de la page");
        }

        header("Location: /?error=notfound");
        exit;
    }

    #[Route('/signup', name: "signup", methods: ["GET"])]
    public function signup()
    {
        $this->render("signup.php", [], "signup");
    }

    #[Route('/signup', name: "signup", methods: ["POST"])]
    public function signupPost()
    {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $gender = $_POST["gender"];
        $password = $_POST["password"];

        $manager = new UserManager(new PDOFactory());
        $user = new User();
        $user->setUsername($username)
            ->setEmail($email)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setGender($gender)
            ->setPassword($password);
        $manager->insertUser($user);

        return "ok";
    }
}
