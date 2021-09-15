<?php

use App\Facade\AbstractFacade;
use Doctrine\ORM\EntityManager;


class UserFacade extends AbstractFacade
{

    public function __construct(EntityManager $em, $entityName)
    {
        $this->em = $em;
        $this->model = $em->getRepository($entityName);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getUser($id)
    {
        return $this->find($id);
    }

    public function getAllUsers()
    {
        return $this->findAll();
    }

    public function createUser($user)
    {
        return $this->save($user);
    }

    public function editUser($user)
    {
        return $this->update($user);
    }

    public function deleteUser($id)
    {   
        return $this->delete($this->find($id));
    }



}