<?php 
// src/AppBundle/Entity/Person.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $personid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $personname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * Get the value of personid
     */ 
    public function getPersonId()
    {
        return $this->personid;
    }

    /**
     * Set the value of personid
     *
     * @return  self
     */ 
    public function setPersonId($personid)
    {
        $this->personid = $personid;

        return $this;
    }

    /**
     * Get the value of personname
     */ 
    public function getPersonName()
    {
        return $this->personname;
    }

    /**
     * Set the value of personname
     *
     * @return  self
     */ 
    public function setPersonName($personname)
    {
        $this->personname = $personname;

        return $this;
    }

    /**
     * Get the value of created
     */ 
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the value of created
     *
     * @return  self
     */ 
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of updated
     */ 
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set the value of updated
     *
     * @return  self
     */ 
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }
}