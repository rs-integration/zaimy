<?php


namespace App\Controller;


use App\Entity\SiteSetting;
use App\Service\SiteSettingService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private SiteSettingService $siteSettingService;

    public function __construct(SiteSettingService $siteSettingService)
    {
        $this->siteSettingService = $siteSettingService;
    }

    #[Route('/admin', name: 'admin')]
    public function admin(string $message = ''): Response
    {
        $params = ['message' => $message];

        foreach (SiteSetting::DEFAULT_SITE_SETTINGS as $settingName) {
            $params[$settingName] = $this->siteSettingService->getSettingValueOrEmpty($settingName);
        }

        $params['menuPoints'] = $this->getMenuPoints();
        $params['cssPaths']   = IndexController::getCssPaths();

        return $this->render('admin/index.html.twig', $params);
    }

    private function getMenuPoints(): array
    {
        return [
            [
                'action' => 'site-settings',
                'label' => 'Настройки сайта'
            ],
            [
                'action' => 'organizations',
                'label' => 'Организации'
            ],
        ];
    }
}
