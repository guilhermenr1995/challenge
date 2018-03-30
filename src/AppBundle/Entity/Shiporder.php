<?php 
// src/AppBundle/Entity/Shiporder.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="shiporder")
 */
class Shiporder
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $shiporderid;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $orderid;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="shiporder")
     * @ORM\JoinColumn(name="orderperson", referencedColumnName="personid")
     */
    private $orderperson;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * Get the value of shiporderid
     */ 
    public function getShiporderId()
    {
        return $this->shiporderid;
    }

    /**
     * Set the value of shiporderid
     *
     * @return  self
     */ 
    public function setShiporderId($shiporderid)
    {
        $this->shiporderid = $shiporderid;

        return $this;
    }

    /**
     * Get the value of orderid
     */ 
    public function getOrderId()
    {
        return $this->orderid;
    }

    /**
     * Set the value of orderid
     *
     * @return  self
     */ 
    public function setOrderId($orderid)
    {
        $this->orderid = $orderid;

        return $this;
    }

    /**
     * Get the value of orderperson
     */ 
    public function getOrderPerson()
    {
        return $this->orderperson;
    }

    /**
     * Set the value of orderperson
     *
     * @return  self
     */ 
    public function setOrderPerson($orderperson)
    {
        $this->orderperson = $orderperson;

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