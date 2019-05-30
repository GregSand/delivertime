<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DeliveryTime", mappedBy="region_id")
     */
    private $deliveryTimes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderLog", mappedBy="region_id")
     */
    private $orderlogs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier", inversedBy="regions")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id", nullable=false)
     */
    private $supplier_id;

    public function __construct()
    {
        $this->deliveryTimes = new ArrayCollection();
        $this->orderlogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|DeliveryTime[]
     */
    public function getDeliveryTimes(): Collection
    {
        return $this->deliveryTimes;
    }

    public function addDeliveryTime(DeliveryTime $deliveryTime): self
    {
        if (!$this->deliveryTimes->contains($deliveryTime)) {
            $this->deliveryTimes[] = $deliveryTime;
            $deliveryTime->setRegionId($this);
        }

        return $this;
    }

    public function removeDeliveryTime(DeliveryTime $deliveryTime): self
    {
        if ($this->deliveryTimes->contains($deliveryTime)) {
            $this->deliveryTimes->removeElement($deliveryTime);
            // set the owning side to null (unless already changed)
            if ($deliveryTime->getRegionId() === $this) {
                $deliveryTime->setRegionId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Orderlog[]
     */
    public function getOrderlogs(): Collection
    {
        return $this->orderlogs;
    }

    public function addOrderlog(Orderlog $orderlog): self
    {
        if (!$this->orderlogs->contains($orderlog)) {
            $this->orderlogs[] = $orderlog;
            $orderlog->setRegionId($this);
        }

        return $this;
    }

    public function removeOrderlog(Orderlog $orderlog): self
    {
        if ($this->orderlogs->contains($orderlog)) {
            $this->orderlogs->removeElement($orderlog);
            // set the owning side to null (unless already changed)
            if ($orderlog->getRegionId() === $this) {
                $orderlog->setRegionId(null);
            }
        }

        return $this;
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
}
