<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Company;
use App\Entity\Site;
use App\Entity\Statistics;
use App\Repository\SiteRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class SiteService
 * @package App\Service
 */
class SiteService extends BaseService
{
    /**
     * @var SiteRepository
     */
    protected SiteRepository $siteRepository;
    /**
     * @var TagService
     */
    protected TagService $tagService;

    /**
     * SiteService constructor.
     * @param EntityManagerInterface $entityManager
     * @param SiteRepository $siteRepository
     * @param TagService $tagService
     */
    public function __construct(EntityManagerInterface $entityManager, SiteRepository $siteRepository, TagService $tagService)
    {
        parent::__construct($entityManager);
        $this->siteRepository = $siteRepository;
        $this->tagService = $tagService;
    }

    /**
     * @param array $keys
     * @return Site|null
     */
    public function findOneByUrlAndTags(array $keys): ?Site
    {
        $sites = $this->siteRepository->findBy(['url' => $keys['url']]);

        foreach ($sites as $site) {
            if ($site->getTags()->count() == count($keys['tags'])) {
                $tags = [];

                foreach ($site->getTags() as $tag) {
                    $tags[] = $tag->getName();
                }

                if ($tags == $keys['tags']) {
                    return $site;
                }
            }
        }

        return null;
    }

    /**
     * @param Site $site
     * @param array $data
     * @throws \Exception
     */
    public function addStatistics(Site $site, array $data): void
    {
        $statistics = $site->getDateStatistics($data['2']);

        if (!$statistics) {
            $statistics = new Statistics();
        }

        $statistics->setDate(new DateTime($data['2']));
        $statistics->setRevenue(strval($data['3']));
        $statistics->setImpression($data['4']);
        $statistics->setEcpm(strval($data['5']));
        $statistics->setClicks($data['6']);
        $statistics->setCtr(strval($data['7']));
        $statistics->setSite($site);

        $this->entityManager->persist($statistics);
        $this->entityManager->flush();
    }

    /**
     * @param array $data
     * @param Company $company
     * @return Site
     */
    public function createSite(array $data, Company $company): Site
    {
        $site = new Site();
        $site->setName($data['0']);
        $site->setUrl($data[0]);
        $site->setCompany($company);

        $tags = explode(' Â» ', $data['1']);

        foreach ($tags as $tag) {
            $site->addTag($this->tagService->findOrCreate($tag));
        }
        $this->entityManager->persist($site);
        $this->entityManager->flush();

        return $site;
    }
}
