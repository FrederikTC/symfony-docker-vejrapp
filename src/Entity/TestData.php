<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;

use App\Repository\TestDataRepository;

#[Entity]
#[Table(name: "test_data")]
class TestData
{

    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private $id;

    #[Column(type: "string", length: 255)]
    private $stationId;

    public function getStationId(): ?string
    {
        return $this->stationId;
    }

    public function setStationId(string $stationId): self
    {
        $this->stationId = $stationId;
        return $this;
    }
}