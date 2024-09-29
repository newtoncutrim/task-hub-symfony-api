<?php

namespace App\Repository\Contract;

use Symfony\Bridge\Doctrine\ManagerRegistry;
use App\Repository\Contract\InterfaceRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository implements InterfaceRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, $this->getEntityClass());
    }

    abstract protected function getEntityClass();

    public function getAll()
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function create($data)
    {
        // Cria uma nova instância da entidade dinamicamente
        $entityClass = $this->getEntityClass();
        $entity = new $entityClass();

        // Percorre cada chave e valor do array de dados
        foreach ($data as $key => $value) {
            $setValue = 'set' . ucfirst($key);
            if (method_exists($entity, $setValue)) {
                // Chama o método setXyz com o valor correspondente
                $entity->$setValue($value);
            } else {
                throw new \Exception("O método $setValue não existe na entidade " . get_class($entity));
            }
        }

        try {
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
            return $entity;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id, $data)
    {
        $entity = $this->find($id);
        foreach ($data as $key => $value) {
            $setValue = 'set' . ucfirst($key);
            if (method_exists($entity, $setValue)) {
                $entity->$setValue($value);
            }
        }
        try {
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
            return $entity;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->find($id);
            $this->getEntityManager()->remove($user);
            $this->getEntityManager()->flush();
            return $user;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function findById($id)
    {
        return $this->createQueryBuilder('u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}