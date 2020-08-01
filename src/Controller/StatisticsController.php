<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Statistics;
use App\Form\StatisticsType;
use App\Repository\StatisticsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/statistics")
 */
class StatisticsController extends AbstractController
{
    /**
     * @Route("/", name="statistics_index", methods={"GET"})
     * @param StatisticsRepository $statisticsRepository
     * @return Response
     */
    public function index(StatisticsRepository $statisticsRepository): Response
    {
        return $this->render('statistics/index.html.twig', [
            'statistics' => $statisticsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="statistics_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $statistic = new Statistics();
        $form = $this->createForm(StatisticsType::class, $statistic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($statistic);
            $entityManager->flush();

            return $this->redirectToRoute('statistics_index');
        }

        return $this->render('statistics/new.html.twig', [
            'statistic' => $statistic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="statistics_show", methods={"GET"})
     * @param Statistics $statistic
     * @return Response
     */
    public function show(Statistics $statistic): Response
    {
        return $this->render('statistics/show.html.twig', [
            'statistic' => $statistic,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="statistics_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Statistics $statistic
     * @return Response
     */
    public function edit(Request $request, Statistics $statistic): Response
    {
        $form = $this->createForm(StatisticsType::class, $statistic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('statistics_index');
        }

        return $this->render('statistics/edit.html.twig', [
            'statistic' => $statistic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="statistics_delete", methods={"DELETE"})
     * @param Request $request
     * @param Statistics $statistic
     * @return Response
     */
    public function delete(Request $request, Statistics $statistic): Response
    {
        if ($this->isCsrfTokenValid('delete' . $statistic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($statistic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('statistics_index');
    }
}
