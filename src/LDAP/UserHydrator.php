<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 15/05/18
 * Time: 12:13
 */

namespace App\LDAP;

use App\Document\User;
use DoL\LdapBundle\Hydrator\HydratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserHydrator
{

    /**
     * @param array $ldapEntry
     * @param User $user
     * @throws \Exception
     */
    public function hydrate(array $ldapEntry,User $user)
    {
//        $user = new \App\Document\User();
//        $user->setUsername($ldapEntry['uid'][0]);
//        $user->setEmail($ldapEntry['email'][0]);
//        $user->setRole($ldapEntry['memberof'][0]);

        if ($ldapEntry['samaccountname'][0] == $this->container->getParameter('cn=admin,dc=ldap,dc=com')) {
            $user->addRole('ROLE_SUPER_ADMIN');
        } elseif (array_key_exists('memberof', $ldapEntry)) {
            if ($this->isAdmin($ldapEntry['memberof']))
                $user->addRole('ROLE_ADMIN');
            elseif ($this->isAgent($ldapEntry['memberof']))
                $user->addRole('ROLE_AGENT');
            else
                $user->addRole('ROLE_USER');
        }
//        return $user;
    }

    /**
     * @param array $groups
     * @return bool
     */
    private function isAdmin(array $groups)
    {
        return $this->checkGroup($groups, $this->container->getParameter('pmo'));
    }

    /**
     * @param array $groups
     * @return bool
     */
    private function isAgent(array $groups)
    {
        return $this->checkGroup($groups, $this->container->getParameter('pm'));
    }


    /**
     * @param array $groups
     * @param $admin
     * @return bool
     */
    private function checkGroup(array $groups, $admin)
    {
        foreach ($groups as $group) {
            if (strpos($group, $admin) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Init the attribute map with Ldap server configuration.
     *
     * @param array $attributeMap
     */
    public function setAttributeMap(array $attributeMap)
    {
        // TODO: Implement setAttributeMap() method.
    }
}