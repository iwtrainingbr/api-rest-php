<?php

declare(strict_types=1);

namespace App\Controller;

use App\Connection\DatabaseConnection;
use App\Entity\Role;
use App\Entity\User;
use App\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectRepository;

class UserController extends AbstractController
{
    private EntityManager $em;
    private ObjectRepository $repository;
    private ObjectRepository $roleRepository;

    public function __construct()
    {
        $this->em = DatabaseConnection::getEntityManager();
        $this->repository = $this->em->getRepository(User::class);
        $this->roleRepository = $this->em->getRepository(Role::class);
    }

    public function list(): void
    {
        JsonResponse::success(
            $this->repository->findAll()
        );
    }

    public function add(): void
    {
        $body = $this->getRequestBody();

        $password = password_hash($body->password, PASSWORD_ARGON2I);

        //criando o novo usuario
        $user = new User(
            $body->name,
            $body->email,
            $password
        );

        //buscando o role do id recebido no json
        $user->role = $this->roleRepository->find(
            $body->role
        );

        //salvando o usuario
        $this->em->persist($user);
        $this->em->flush();

        JsonResponse::success($user);
    }

    public function remove(): void
    {
        header('HTTP CODE', true, 204);
    }
}