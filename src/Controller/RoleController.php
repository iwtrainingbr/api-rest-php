<?php

declare(strict_types=1);

namespace App\Controller;

use App\Connection\DatabaseConnection;
use App\Entity\Role;
use App\Response\JsonResponse;
use Doctrine\ORM\EntityManager;

class RoleController
{
    private EntityManager $em;

    public function __construct() 
    {
        $this->em = DatabaseConnection::getEntityManager();
    }

    public function list(): void
    {
        $repository = $this->em->getRepository(Role::class);

        JsonResponse::success(
            $repository->findAll()
        );
    }

    public function add(): void
    {
        //recuperando o json enviado pelo cliente
        $body = json_decode(
            file_get_contents('php://input')
        ); 

        //criando um objeto do PHP e passando os dados recebidos via request POST
        $role = new Role($body->name);

        //salvando no banco de dados
        $this->em->persist($role); //INSERT INTO 
        $this->em->flush();

        JsonResponse::success($role, 201);
    }

    public function edit(): void
    {
        JsonResponse::success(null, 201);
    }

    public function remove(): void
    {
        JsonResponse::success(code: 204);
    }
}