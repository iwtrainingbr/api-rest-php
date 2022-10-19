<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Connection\DatabaseConnection;
use App\Entity\Role;
use App\Entity\User;

class RoleAdminController
{
    public function logout(): void
    {
        session_start();

        session_destroy();

        header('location: /login');
    }


    public function login(): void
    {
        header('Content-Type: text/html; charset=UTF-8');

        if (false === empty($_POST)) {
            $em = DatabaseConnection::getEntityManager();
            $respository = $em->getRepository(User::class);

            $user = $respository->findOneBy([
                'email' => $_POST['email'], //SELECT * FROM User WHERE email='a@a.com';
            ]);

            if (!$user) {
                die('Usuario nao encontrado');
            }

            if (false === password_verify($_POST['password'], $user->password)) {
                die('Senha Incorreta');
            }

            session_start();

            $_SESSION['user_logged'] = [
                'id' => $user->id,
                'name' => $user->name,
            ];

            header('location: /admin');
        }

        include dirname(__DIR__).'/../../views/login.phtml';
    }


    public function list(): void
    {
        header('Content-Type: text/html; charset=UTF-8');
        
        session_start();

        if (false === isset($_SESSION['user_logged'])) {
            echo '<h2 style="color: red;">Você precisa estar logado</h2>';
            return;
        }


        $em = DatabaseConnection::getEntityManager();

        $roles = $em->getRepository(Role::class)->findAll();

        include dirname(__DIR__).'/../../views/role/list.phtml';
    }
}