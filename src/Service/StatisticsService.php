<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class StatisticsService
 * @package App\Service
 */
class StatisticsService extends BaseService
{
    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $client;
    /**
     * @var SiteService
     */
    private SiteService $siteService;

    /**
     * StatisticsService constructor.
     * @param EntityManagerInterface $entityManager
     * @param HttpClientInterface $client
     * @param SiteService $siteService
     */
    public function __construct(EntityManagerInterface $entityManager, HttpClientInterface $client, SiteService $siteService)
    {
        parent::__construct($entityManager);
        $this->client = $client;
        $this->siteService = $siteService;
    }

    /**
     * @param Company $company
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws Exception
     */
    public function fetchCompanyStatistics(Company $company): void
    {
        $response = $this->client->request(
            'GET',
            $company->getUrl()
        )->toArray();

        foreach ($response['data'] as $data) {
            $site = $this->siteService->findOneByUrlAndTags(['url' => $data['0'], 'tags' => explode(' Â» ', $data['1'])]);

            if ($site) {
                $this->siteService->addStatistics($site, $data);
            } else {
                $site = $this->siteService->createSite($data, $company);
                $this->siteService->addStatistics($site, $data);
            }
        }
    }
}
