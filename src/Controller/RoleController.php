<?php

declare(strict_types=1);

namespace App\Controller;

use App\Connection\DatabaseConnection;
use App\Entity\Role;
use App\Response\JsonResponse;
use App\Validator\RoleValidator;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectRepository;

class RoleController extends AbstractController
{
    private EntityManager $em;
    private ObjectRepository $repository;

    public function __construct() 
    {
        $this->em = DatabaseConnection::getEntityManager();
        $this->repository = $this->em->getRepository(Role::class);
    }

    public function list(): void
    {

        //se houver um id na URL, então é pra buscar apenas o elemento desse id, e retornar via JSON
        if ($this->getId()) {
            JsonResponse::success(
                $this->repository->find($this->getId()) //SELECT * FROM Role WHERE id='id'
            );
            return;
        }

        JsonResponse::success(
            $this->repository->findAll() //SELECT * FROM Role;
        );
    }

    public function add(): void
    {
        //recuperando o json enviado pelo cliente
        $body = $this->getRequestBody();

        try {
            RoleValidator::validatePost($body);
        } catch (\Exception $exception) {
            JsonResponse::error($exception->getMessage());
            return;
        } 


        //criando um objeto do PHP e passando os dados recebidos via request POST
        $role = new Role($body->name);

        //salvando no banco de dados
        $this->em->persist($role); //INSERT INTO 
        $this->em->flush();

        JsonResponse::success($role, 201);
    }

    public function edit(): void
    {
        //buscando o role pra editar
        $role = $this->repository->find(
            $this->getId()
        );

        //recuperando os dados da requisicao/json
        $body = $this->getRequestBody();

        //atualizando os dados conforme o que foi passado
        $role->setName($body->name);

        //salvando
        $this->em->persist($role); //UPDATE table SET ...
        $this->em->flush();

        JsonResponse::success($role, 201);
    }

    public function remove(): void
    {
        $role = $this->repository->find(
            $this->getId()
        );

        $this->em->remove($role);
        $this->em->flush();

        JsonResponse::success(code: 204);
    }
}