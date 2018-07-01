<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CharterCreateVoter extends Voter
{
    private $decisionManager;
      // injection de dépendances
    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {
        return $attribute === 'ROLE_PM';
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        // ROLE_ADMIN can do anything
        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        //return true permet de verifier la permission
        return $user->getRoles()[0] === $attribute;

    }
}
