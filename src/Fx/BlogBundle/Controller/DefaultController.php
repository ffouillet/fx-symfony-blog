<?php

namespace Fx\BlogBundle\Controller;

use Fx\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends Controller
{
    public function indexAction(UserPasswordEncoderInterface $encoder)
    {
    	$user = new User();
    	$plainPassword = 'ryanpass';
    	$encoded = $encoder->encodePassword($user, $plainPassword);

    	dump($encoded);

        return $this->render('fx/blog/index.html.twig');
    }
}
