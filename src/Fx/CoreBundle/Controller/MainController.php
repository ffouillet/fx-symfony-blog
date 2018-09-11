<?php

namespace Fx\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('FxPortfolioBundle:Project')
            ->findAllProjectsWithRelations(array('images','projectCategories'));

        $projectsCategories = $em->getRepository('FxPortfolioBundle:ProjectCategory')->findAll();

        $skills = $em->getRepository('FxPortfolioBundle:Skill')
            ->findBy([], ['frontendSortOrder' => 'asc']);

        $tools = $em->getRepository('FxPortfolioBundle:Tool')
            ->findBy([], ['frontendSortOrder' => 'ASC']);

        // Gestion formulaire contact.
        $mailErrors = [];

        return $this->render('fx/index.html.twig',
            array('skills' => $skills,
                'tools'  => $tools,
                'projects' => $projects,
                'projectsCategories' => $projectsCategories
                    ));
    }

    public function handleContactFormAction(Request $request)
    {

        if ($request->isXmlHttpRequest()) {

            $mailer = $this->get('fx.email_sender');

            $mailErrors = $mailer->sendMail($request);

            return new JsonResponse($mailErrors);

        }
    }
}
