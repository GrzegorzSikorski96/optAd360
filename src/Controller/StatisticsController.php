<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Company;
use App\Service\StatisticsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/statistics")
 */
class StatisticsController extends AbstractController
{
    /**
     * @var StatisticsService
     */
    protected StatisticsService $statisticsService;

    /**
     * StatisticsController constructor.
     * @param StatisticsService $statisticsService
     */
    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * @Route("/company/{id}/fetch", name="fetch_company_statistics", methods={"POST"})
     * @param Company $company
     * @return Response
     */
    public function fetchCompanyStatistics(Company $company): Response
    {
        $this->statisticsService->fetchCompanyStatistics($company);

        return $this->render('company/show.html.twig', [
            'company' => $company,
        ]);
    }
}
