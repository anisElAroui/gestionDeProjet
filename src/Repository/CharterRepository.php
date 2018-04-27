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
    public function findAttributeById( $data){

//        db.Charter.aggregate( [
//        // désimbriquer une liste
//    {$unwind : "$stakeholders"},
//        // donner la condition
//    { $match : {
//
//        "stakeholders._id" : ObjectId("5ad605c7f4856d268866f628")
//
//    }},
//      //faire la projection
//    { $project : {
//
//        "stakeholders._id":1,"_id":0,"stakeholders.name":1,"stakeholders.role":1,'stakeholders.email':1,'stakeholders.phoneNumber':1
//
//    }}
//
//] )
        $m = $this->container->get('doctrine_mongodb.odm.default_connection');
        $db = $m->selectDatabase('symfony');
        $cursor = $db->Charter->find(['stakeholders' => ['_id'=>'ObjectId('.$data.')']]);

        return $cursor;
    }

    public function findStakeholder($data){
        return
            $this->createAggregationBuilder(\Documents\Charter::class)
                ->unwind('$stakeholders')
                ->match()
                    ->field('_id')
                    ->equals('ObjectId('.$data.')')
                ->project()
                    ->includeFields(['name', 'role','email', 'phoneNumber'])
                ->getQuery()
                ->getSingleResult();
//        $query = [
//
//            'stakeholders._id' => 'ObjectId('.$data.')',
//            'deleted' => false
//        ];
//
//        $pipeline = array(
//            [
//                '$unwind' => [
//                    'path' => '$stakeholders',
//                    'preserveNullAndEmptyArrays' => true
//                ]
//            ],
//            [
//                '$match' => [
//                    'stakeholders._id' => 'ObjectId('.$data.')'
//                ]
//            ],
//            [
//                '$project' => [
//                    'stakeholders._id'=>1,
//                    '_id'=>0,
//                    'stakeholders.name'=>1,
//                    'stakeholders.role'=>1,
//                    'stakeholders.email'=>1,
//                    'stakeholders.phoneNumber'=>1
//
//                        ]
//            ]
//            );
//        $result = $this->dm->getDocumentCollection('App\Document\Charter\Charter')->aggregate($pipeline);
//
//        return $result;
    }


}