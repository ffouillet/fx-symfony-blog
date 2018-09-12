<?php

namespace Fx\CoreBundle\Service;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Fx\UserBundle\Entity\User;

class FxEncodedPasswordGenerator {

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $user = new User;

        $plainPassword = 'ocprojet5correcteur';
        $encoded = $encoder->encodePassword($user, $plainPassword);

        dump($encoded);
    }

}