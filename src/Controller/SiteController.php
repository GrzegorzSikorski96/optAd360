<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Site;
use App\Form\SiteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/site")
 */
class SiteController extends AbstractController
{
    /**
     * @Route("/{id}", name="site_show", methods={"GET"})
     * @param Site $site
     * @return Response
     */
    public function show(Site $site): Response
    {
        return $this->render('site/show.html.twig', [
            'daily' => $site->getStatistics()->last(),
            'site' => $site,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="site_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Site $site
     * @return Response
     */
    public function edit(Request $request, Site $site): Response
    {
        $form = $this->createForm(SiteType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('site_show');
        }

        return $this->render('site/edit.html.twig', [
            'site' => $site,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="site_delete", methods={"DELETE"})
     * @param Request $request
     * @param Site $site
     * @return Response
     */
    public function delete(Request $request, Site $site): Response
    {
        if ($this->isCsrfTokenValid('delete' . $site->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($site);
            $entityManager->flush();
        }

        return $this->redirectToRoute('company');
    }
}
