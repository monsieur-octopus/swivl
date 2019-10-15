<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassroomRepository")
 * @ORM\Table(name="classroom")
 */
class Classroom implements \JsonSerializable
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, unique=true)
     */
    private $name;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function __construct(string $name, \DateTime $createdAt, bool $active)
    {
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->active = $active;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'createdAt'  => $this->createdAt->format('Y-m-d H:i:s'),
            'active'     => $this->active,
        ];
    }
}