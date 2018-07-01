<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 17/05/18
 * Time: 12:21
 */

namespace App\LDAP;

use App\Document\User;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use DoL\LdapBundle\Hydrator\HydratorInterface;

class LdapManager implements HydratorInterface
{
    use ContainerAwareTrait;

    /**
     * @param array $ldapEntry
     * @return User
     */
    public function hydrate(array $ldapEntry)
    {
            $user = new User();

            $this->container->get('px.ldap.user_hydrator')->hydrate($ldapEntry, $user);

            $user->setEnabled(true);
            return $user;
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