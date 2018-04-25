<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 07/04/18
 * Time: 22:31
 */

namespace App\Repository;


use Doctrine\ODM\MongoDB\DocumentRepository;

class CharterRepository extends DocumentRepository
{
    /**
     * @param string $field
     * @param string $data
     *
     * @return array|null|object
     */
    public function findOneByProperty($field, $data)
    {
//        $db->setReadPreference(MongoClient::RP_SECONDARY_PREFERRED);
//        $collection = $db->myCollection;
//        return
//            $cursor = $collection->find(array("requirements.is" => $data));
        return
            $this->createQueryBuilder('Charter')
                ->field($field)->equals($data)
                ->getQuery()
                ->getSingleResult();
    }

}