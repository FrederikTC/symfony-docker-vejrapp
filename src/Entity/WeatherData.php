<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;

use App\Repository\WeatherDataRepository;

#[Entity(repositoryClass: WeatherDataRepository::class)]
#[Table(name: "weather_data")]
class WeatherData
{

    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private $id;


    #[Column(type: "string", length: 255)]
    private $stationId;
    

    #[Column(type: "datetime")]
    private $observedAt;
    
    #[Column(type:"string", length:255)]
    private $parameterId;

    #[Column(type:"string", length:255)]
    private $value;

    #[Column(type:"string", length:255)]
    private $coordinates = [];


    public function getStationId(): ?string
    {
        return $this->stationId;
    }

    public function setStationId(string $stationId): self
    {
        $this->stationId = $stationId;
        return $this;
    }

    public function getObservedAt(): ?\DateTimeInterface
    {
        return $this->observedAt;
    }

    public function setObservedAt(\DateTimeInterface $observedAt): self
    {
        $this->observedAt = $observedAt;
        return $this;
    }

    public function getParameterId(): ?string
    {
        return $this->parameterId;
    }

    public function setParameterId(string $parameterId): self
    {
        $this->parameterId = $parameterId;
        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getCoordinates(): ?array
    {
        return $this->coordinates;
    }

    public function setCoordinates(array $coordinates): self
    {
        $this->coordinates = $coordinates;
        return $this;
    }
}