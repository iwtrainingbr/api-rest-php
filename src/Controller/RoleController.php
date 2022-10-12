<?php

declare(strict_types=1);

namespace App\Controller;

use App\Connection\DatabaseConnection;
use App\Entity\Role;
use App\Response\JsonResponse;

class RoleController
{
    public function list(): void
    {
        $em = DatabaseConnection::getEntityManager();

        $repository = $em->getRepository(Role::class);

        $roles = $repository->findAll(); // SELECT * FROM Role;

        echo json_encode($roles);

        JsonResponse::success();
    }

    public function add(): void
    {
        //recuperando o json enviado pelo cliente
        $body = json_decode(
            file_get_contents('php://input')
        ); 

        //criando um objeto do PHP e passando os dados recebidos via request POST
        $role = new Role();
        $role->setName($body->name);

        //salvando no banco de dados
        $em = DatabaseConnection::getEntityManager();
        $em->persist($role); //INSERT INTO 
        $em->flush();

        //mostrando na resposta o resultado
        echo json_encode($role);

        JsonResponse::success(201);
    }

    public function edit(): void
    {
        JsonResponse::success(201);
    }

    public function remove(): void
    {
        JsonResponse::success(204);
    }
}