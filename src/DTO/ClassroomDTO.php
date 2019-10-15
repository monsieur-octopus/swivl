<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ClassroomDTO
{
    /**
     * @var string
     * @Assert\NotBlank(message="Name can't be empty")
     * @Assert\Type("string")
     * @Assert\Length(min=3, max=128, minMessage="Name must be at least 3 symbols long", maxMessage="Name can be maximun 128 symbols long")
     */
    public $name;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @Assert\NotBlank
     */
    public $createdAt;

    /**
     * @var bool
     * @Assert\Type("bool", message="Field active must be bool")
     */
    public $active;
}