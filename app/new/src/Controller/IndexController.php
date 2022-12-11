<?php

namespace App\Controller;

use App\Entity\SiteSetting;
use App\Service\OrganizationService;
use App\Service\SiteSettingService;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SiteSettingService $siteSettingService, OrganizationService $organizationService): Response
    {
        $params = [];

        foreach (SiteSetting::DEFAULT_SITE_SETTINGS as $settingName) {
            $params[$settingName] = $siteSettingService->getSettingValueOrEmpty($settingName);
        }

        $params['cssPaths'] = self::getCssPaths();
        $params['organizations'] = $organizationService->findBy([], ['sort'=> 'ASC']);

        return $this->render('index.html.twig', $params);
    }

    /**
     * @return string[]
     */
    public static function getCssPaths(): array
    {
        return [
            'assets/666a4751/css/font-awesome.min.css',
            'assets/79d88cbe/css/bootstrap.css',
            'css/site.css',
            'css/notificate.css',
            'css/jquery.formstyler.css',
            'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Roboto:400,500,700&amp;subset=cyrillic'
        ];
    }
}
