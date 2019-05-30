<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShippingPeriodRepository")
 */
class ShippingPeriod
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier", inversedBy="shippingperiods")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id", nullable=false)
     */
    private $supplier_id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $delivery_day;

    /**
     * @ORM\Column(type="time")
     */
    private $start_time;

    /**
     * @ORM\Column(type="time")
     */
    private $end_time;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplierId(): ?supplier
    {
        return $this->supplier_id;
    }

    public function setSupplierId(?supplier $supplier_id): self
    {
        $this->supplier_id = $supplier_id;

        return $this;
    }

    public function getDeliveryDay(): ?int
    {
        return $this->delivery_day;
    }

    public function setDeliveryDay(int $deliveryDay): self
    {
        $this->delivery_day = $deliveryDay;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeInterface $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    public function setEndTime(\DateTimeInterface $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
