<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeliveryTimeRepository")
 */
class DeliveryTime
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier", inversedBy="deliveryTimes")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id", nullable=false)
     */
    private $supplier_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="deliveryTimes")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id", nullable=false)
     */
    private $region_id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $days_to_deliver;

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

    public function getRegionId(): ?region
    {
        return $this->region_id;
    }

    public function setRegionId(?region $region_id): self
    {
        $this->region_id = $region_id;

        return $this;
    }

    public function getDaysToDeliver(): ?int
    {
        return $this->days_to_deliver;
    }

    public function setDaysToDeliver(int $days_to_deliver): self
    {
        $this->days_to_deliver = $days_to_deliver;

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
