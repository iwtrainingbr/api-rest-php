<?php

declare(strict_types=1);

namespace App\Controller;

use App\Connection\DatabaseConnection;
use App\Entity\User;
use App\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectRepository;

class AuthController extends AbstractController
{
    private EntityManager $em;
    private ObjectRepository $repository;

    public function __construct() {
        $this->em = DatabaseConnection::getEntityManager();
        $this->repository = $this->em->getRepository(User::class);
    }

    public function login(): void
    {
        //recupera o json da request
        $body = $this->getRequestBody();

        //buscao usuario no banco pelo email
        $user = $this->repository->findOneBy([
            'email' => $body->email,
        ]);

        if (!$user) {
            JsonResponse::error('Usuario nao encontrado');
            return;
        }

        if (!password_verify($body->password, $user->password)) {
            JsonResponse::error('Senha incorreta');
            return;
        }

        $token = base64_encode(
            date('dmYHis') . $user->id
        ); //gerando um token

        $user->token = $token;

        $this->em->persist($user);
        $this->em->flush();

        JsonResponse::success($user);
    }

}