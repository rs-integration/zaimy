<?php

namespace App\Service;

use App\Entity\SiteSetting;
use App\Repository\SiteSettingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class SiteSettingService
 * @package App\Service
 *
 * @method SiteSetting|null findOneOrNull(array $criteria)
 * @method SiteSetting findOneOrFail(array $criteria)
 * @method SiteSetting[] findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null)
 */
class SiteSettingService extends AbstractEntityService
{
    /**
     * @var SiteSettingRepository
     */
    protected ObjectRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct(SiteSetting::class, $em);
    }

    /**
     * @param string $name
     * @return string
     */
    public function getSettingValueOrEmpty(string $name): string
    {
        $setting = $this->findOneOrNull(['name' => $name]);

        return $setting === null
            ? ''
            : ($setting->getValue() === null ? '' : $setting->getValue());
    }

    /**
     * @param string $name
     * @param string|null $value
     * @return SiteSetting
     */
    public function createOrUpdate(string $name, ?string $value = null): SiteSetting
    {
        $setting = $this->findOneOrNull(['name' => $name]);

        if ($setting === null) {
            $setting = (new SiteSetting())
                ->setName($name);

            $this->em->persist($setting);
        }

        $setting->setValue($value);

        $this->em->flush();

        return $setting;
    }
}
