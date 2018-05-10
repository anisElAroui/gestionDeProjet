<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 04/04/18
 * Time: 15:40
 */

namespace App\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document(repositoryClass="App\Repository\ProjectRepository")
 *
 */
class Project
{
    /**
     * @var integer $id
     *
     * @MongoDB\Id(strategy="INCREMENT")
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $description;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectManager;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $poleEbusniss;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $poleEss;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $poleMobile;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $createdAt;

    /**
     * Project constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * @param mixed $projectName
     */
    public function setProjectName($projectName): void
    {
        $this->projectName = $projectName;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getProjectManager()
    {
        return $this->projectManager;
    }

    /**
     * @param mixed $projectManager
     */
    public function setProjectManager($projectManager): void
    {
        $this->projectManager = $projectManager;
    }

    /**
     * @return mixed
     */
    public function getPoleEbusniss()
    {
        return $this->poleEbusniss;
    }

    /**
     * @param mixed $poleEbusniss
     */
    public function setPoleEbusniss($poleEbusniss): void
    {
        $this->poleEbusniss = $poleEbusniss;
    }

    /**
     * @return mixed
     */
    public function getPoleEss()
    {
        return $this->poleEss;
    }

    /**
     * @param mixed $poleEss
     */
    public function setPoleEss($poleEss): void
    {
        $this->poleEss = $poleEss;
    }

    /**
     * @return mixed
     */
    public function getPoleMobile()
    {
        return $this->poleMobile;
    }

    /**
     * @param mixed $poleMobile
     */
    public function setPoleMobile($poleMobile): void
    {
        $this->poleMobile = $poleMobile;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

}