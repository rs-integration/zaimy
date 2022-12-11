<?php

namespace App\Controller\Api;

use App\Entity\SiteSetting;
use App\Service\SiteSettingService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteSettingsController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private SiteSettingService $siteSettingService;

    public function __construct(SiteSettingService $siteSettingService)
    {
        $this->siteSettingService = $siteSettingService;
    }

    #[Route('/api/site-settings', name: 'save-site-settings', methods: ['POST'])]
    public function saveSiteSettings(Request $request): Response
    {
        $updatedSettings = [];

        foreach ($request->toArray() as $name => $value) {
            if (in_array($name, SiteSetting::DEFAULT_SITE_SETTINGS, true)
                && $value !== null
            ) {
                $updatedSettings[] = $this->siteSettingService->createOrUpdate($name, $value);
            }
        }

        return $this->json($updatedSettings);
    }

    #[Route('/api/site-settings', name: 'get-site-settings', methods: ['GET'])]
    public function getSiteSettings(Request $request): Response
    {
        return $this->json($this->siteSettingService->findBy([]));
    }
}
