<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ProjectAddVoter extends Voter
{

//    private $decisionManager;
//      // injection de dépendances
//    public function __construct(AccessDecisionManagerInterface $decisionManager)
//    {
//        $this->decisionManager = $decisionManager;
//    }

    protected function supports($attribute, $subject)
    {
        return $attribute === 'ROLE_ADMIN';
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        //return true permet de verifier la permission
        return $user->getRoles()[0] === $attribute;
    }
}
