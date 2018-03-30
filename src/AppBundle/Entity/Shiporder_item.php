<?php 
// src/AppBundle/Entity/Shiporder_items.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="shiporder_item")
 */
class Shiporder_item
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $itemid;

    /**
     * @ORM\ManyToOne(targetEntity="Shiporder", inversedBy="shiporder_item")
     * @ORM\JoinColumn(name="shiporderid", referencedColumnName="shiporderid")
     */
    private $shiporderid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $note;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * Get the value of itemid
     */ 
    public function getItemId()
    {
        return $this->itemid;
    }

    /**
     * Set the value of itemid
     *
     * @return  self
     */ 
    public function setItemId($itemid)
    {
        $this->itemid = $itemid;

        return $this;
    }

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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

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