<?php

namespace Fx\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('FxPortfolioBundle:Project')
            ->findAll([], ['frontendSortOrder' => 'ASC', 'realizedAt' => 'DESC' ]);

        $skills = $em->getRepository('FxPortfolioBundle:Skill')
            ->findAll([], ['frontendSortOrder' => 'ASC', 'level' => 'DESC' ]);

        $tools = $em->getRepository('FxPortfolioBundle:Tool')
            ->findAll([], ['frontendSortOrder' => 'ASC', 'level' => 'DESC' ]);

        return $this->render('fx/index.html.twig',
            array('projects' => $projects,
                    'skills' => $skills));
    }
}
