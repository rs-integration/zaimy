<?php


namespace App\Service;


use App\Entity\Organization;
use App\Repository\OrganizationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class OrganizationService
 * @package App\Service
 *
 * @method Organization|null findOneOrNull(array $criteria)
 * @method Organization findOneOrFail(array $criteria)
 * @method Organization[] findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null)
 * @method Organization|null find(int $id)
 */
class OrganizationService extends AbstractEntityService
{
    /**
     * @var OrganizationRepository
     */
    protected ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct(Organization::class, $entityManager);
    }

    /**
     * @param array $fields
     * @return Organization
     * @throws \Exception
     */
    public function createOrUpdate(array $fields): Organization
    {
        /** @var Organization $organization */
        if (array_key_exists('id', $fields)
            && ($organization = $this->find($fields['id'])) === null
        ) {
            throw new \Exception('Entity not found');
        }

        return $this->applyDataFromFields($organization ?? new Organization(), $fields);
    }

    /**
     * @param array $orgsParam
     */
    public function batchUpdate(array $orgsParam): void
    {
        $orgsParamById = [];

        foreach ($orgsParam as $orgParams) {
            $orgsParamById[$orgParams['id']] = $orgParams;
        }

        $allOrganizations = $this->repository->findBy([
            'id' => array_keys($orgsParamById)
        ]);

        foreach ($allOrganizations as $organization) {
            if ($orgParams = $orgsParamById[$organization->getId()]) {
                $this->applyDataFromFields($organization, $orgParams);
            }
        }
    }

    /**
     * @param Organization $organization
     * @param array $fields
     * @return Organization
     */
    private function applyDataFromFields(Organization $organization, array $fields): Organization
    {
        foreach ($fields as $name => $value) {
            if ($value !== null
                && $name !== 'id'
                && method_exists($organization, $method = 'set' . ucfirst($name))
            ) {
                $organization->{$method}($value);
            }
        }

        if ($organization->getId() === null) {
            $organization
                ->setSort(
                    $this->repository->getMaxSortNum() + 1
                );
            $this->em->persist($organization);
        }

        $this->em->flush();
        return $organization;
    }
}
