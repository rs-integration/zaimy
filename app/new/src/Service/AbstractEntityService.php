<?php


namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Exception;

abstract class AbstractEntityService
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    protected ObjectRepository $repository;

    /**
     * @var class-string
     */
    protected $entityClass;

    /**
     * AbstractEntityService constructor.
     *
     * @template T
     *
     * @param class-string<T>        $entityClass
     * @param EntityManagerInterface $entityManager
     */
    public function __construct($entityClass, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository($entityClass);

        $this->repository = $repository;

        $this->entityClass      = $entityClass;
        $this->em               = $entityManager;
    }

    /**
     * @param array<string, mixed> $criteria
     * @return object
     * @throws Exception
     */
    public function findOneOrFail(array $criteria): object
    {
        $object = $this->repository->findOneBy($criteria);

        if ($object === null) {
            throw new Exception('Setting with criterias not found');
        }

        return $object;
    }

    /**
     * @param array<string, mixed> $criteria
     * @return object|null
     */
    public function findOneOrNull(array $criteria): ?object
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return array<object>
     */
    public function findBy(
        array $criteria,
        ?array $orderBy = null,
        ?int $limit = null,
        ?int $offset = null
    ): array
    {
        return $this->repository->findBy(
            $criteria,
            $orderBy,
            $limit,
            $offset
        );
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function find(int $id): ?object
    {
        return $this->repository->find($id);
    }
}
