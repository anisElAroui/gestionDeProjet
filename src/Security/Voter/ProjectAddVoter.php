<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ProjectAddVoter extends Voter
{

    protected function supports($attribute, $subject)
    {
        // lorsque le paramettre de @isGranted = ROLE_ADMIN
        return $attribute === 'ROLE_ADMIN';
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();


        //return true si le role = attribute
        return $user->getRoles()[0] === $attribute;
    }
}
