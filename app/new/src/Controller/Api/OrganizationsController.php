<?php


namespace App\Controller\Api;


use App\Entity\Organization;
use App\Service\OrganizationService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\returnArgument;

class OrganizationsController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private OrganizationService $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    #[Route('/api/organizations', name: 'get-organizations', methods: ['GET'])]
    public function getOrganizations(Request $request): Response
    {
        return $this->json($this->organizationService->findBy([]));
    }

    #[Route('/api/organizations', name: 'save-organizations', methods: ['PUT'])]
    public function createOrUpdateOrganization(Request $request): Response
    {
        return $this->json(
            $this->organizationService->createOrUpdate($request->toArray())
        );
    }

    #[Route('/api/organizations/{id}', name: 'get-organization', methods: ['GET'])]
    public function getOrganizationById(int $id): Response
    {
        return $this->json(
            $this->organizationService->findOneOrFail(['id' => $id])
        );
    }

    #[Route('/api/organizations/batch', name: 'batch-update-organizations', methods: ['POST'])]
    public function batchUpdate(Request $request): Response
    {
        $this->organizationService->batchUpdate($request->toArray());

        return $this->empty();
    }

    protected function empty(): Response
    {
        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
