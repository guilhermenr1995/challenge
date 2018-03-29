<?php 
// src/AppBundle/Entity/Shiporder.php
namespace AppBundle\Entity;

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

    private $orderperson;

    private $shipto;

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
    public function getShiporderid()
    {
        return $this->shiporderid;
    }

    /**
     * Set the value of shiporderid
     *
     * @return  self
     */ 
    public function setShiporderid($shiporderid)
    {
        $this->shiporderid = $shiporderid;

        return $this;
    }

    /**
     * Get the value of orderid
     */ 
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * Set the value of orderid
     *
     * @return  self
     */ 
    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;

        return $this;
    }

    /**
     * Get the value of orderperson
     */ 
    public function getOrderperson()
    {
        return $this->orderperson;
    }

    /**
     * Set the value of orderperson
     *
     * @return  self
     */ 
    public function setOrderperson($orderperson)
    {
        $this->orderperson = $orderperson;

        return $this;
    }

    /**
     * Get the value of shipto
     */ 
    public function getShipto()
    {
        return $this->shipto;
    }

    /**
     * Set the value of shipto
     *
     * @return  self
     */ 
    public function setShipto($shipto)
    {
        $this->shipto = $shipto;

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