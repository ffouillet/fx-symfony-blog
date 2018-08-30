<?php

namespace Fx\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('FxPortfolioBundle:Project')
            ->findBy([], ['frontendSortOrder' => 'asc', 'realizedAt' => 'DESC' ]);

        $skills = $em->getRepository('FxPortfolioBundle:Skill')
            ->findBy([], ['frontendSortOrder' => 'asc']);

        $tools = $em->getRepository('FxPortfolioBundle:Tool')
            ->findBy([], ['frontendSortOrder' => 'ASC']);

        return $this->render('fx/index.html.twig',
            array('projects' => $projects,
                    'skills' => $skills,
                    'tools'  => $tools));
    }
}
