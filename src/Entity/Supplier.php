<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupplierRepository")
 */
class Supplier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
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
     * @ORM\OneToMany(targetEntity="App\Entity\ShippingPeriod", mappedBy="supplier_id")
     */
    private $shippingperiods;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DeliveryTime", mappedBy="supplier_id")
     */
    private $deliveryTimes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderLog", mappedBy="supplier_id")
     */
    private $orderlogs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Region", mappedBy="supplier_id")
     */
    private $regions;

    public function __construct()
    {
        $this->shippingperiods = new ArrayCollection();
        $this->deliveryTimes = new ArrayCollection();
        $this->orderlogs = new ArrayCollection();
        $this->regions = new ArrayCollection();
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
     * @return Collection|Shippingperiod[]
     */
    public function getShippingperiods(): Collection
    {
        return $this->shippingperiods;
    }

    public function addShippingperiod(Shippingperiod $shippingperiod): self
    {
        if (!$this->shippingperiods->contains($shippingperiod)) {
            $this->shippingperiods[] = $shippingperiod;
            $shippingperiod->setSupplierId($this);
        }

        return $this;
    }

    public function removeShippingperiod(Shippingperiod $shippingperiod): self
    {
        if ($this->shippingperiods->contains($shippingperiod)) {
            $this->shippingperiods->removeElement($shippingperiod);
            // set the owning side to null (unless already changed)
            if ($shippingperiod->getSupplierId() === $this) {
                $shippingperiod->setSupplierId(null);
            }
        }

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
            $deliveryTime->setSupplierId($this);
        }

        return $this;
    }

    public function removeDeliveryTime(DeliveryTime $deliveryTime): self
    {
        if ($this->deliveryTimes->contains($deliveryTime)) {
            $this->deliveryTimes->removeElement($deliveryTime);
            // set the owning side to null (unless already changed)
            if ($deliveryTime->getSupplierId() === $this) {
                $deliveryTime->setSupplierId(null);
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
            $orderlog->setSupplierId($this);
        }

        return $this;
    }

    public function removeOrderlog(Orderlog $orderlog): self
    {
        if ($this->orderlogs->contains($orderlog)) {
            $this->orderlogs->removeElement($orderlog);
            // set the owning side to null (unless already changed)
            if ($orderlog->getSupplierId() === $this) {
                $orderlog->setSupplierId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Region[]
     */
    public function getRegions(): Collection
    {
        return $this->regions;
    }

    public function addRegion(Region $region): self
    {
        if (!$this->regions->contains($region)) {
            $this->regions[] = $region;
            $region->setSupplierId($this);
        }

        return $this;
    }

    public function removeRegion(Region $region): self
    {
        if ($this->regions->contains($region)) {
            $this->regions->removeElement($region);
            // set the owning side to null (unless already changed)
            if ($region->getSupplierId() === $this) {
                $region->setSupplierId(null);
            }
        }

        return $this;
    }
}
