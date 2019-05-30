<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderLogRepository")
 */
class OrderLog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier", inversedBy="orderlogs")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id", nullable=false)
     */
    private $supplier_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="orderlogs")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id", nullable=false)
     */
    private $region_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_ordered;

    /**
     * @ORM\Column(type="date")
     */
    private $eta_date;

    /**
     * @ORM\Column(type="time")
     */
    private $eta_start_time;

    /**
     * @ORM\Column(type="time")
     */
    private $eta_end_time;

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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

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

    public function getDateOrdered(): ?\DateTimeInterface
    {
        return $this->date_ordered;
    }

    public function setDateOrdered(\DateTimeInterface $date_ordered): self
    {
        $this->date_ordered = $date_ordered;

        return $this;
    }

    public function getEtaDate(): ?\DateTimeInterface
    {
        return $this->eta_date;
    }

    public function setEtaDate(\DateTimeInterface $eta_date): self
    {
        $this->eta_date = $eta_date;

        return $this;
    }

    public function getEtaStartTime(): ?\DateTimeInterface
    {
        return $this->eta_start_time;
    }

    public function setEtaStartTime(\DateTimeInterface $eta_start_time): self
    {
        $this->eta_start_time = $eta_start_time;

        return $this;
    }

    public function getEtaEndTime(): ?\DateTimeInterface
    {
        return $this->eta_end_time;
    }

    public function setEtaEndTime(\DateTimeInterface $eta_end_time): self
    {
        $this->eta_end_time = $eta_end_time;

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
