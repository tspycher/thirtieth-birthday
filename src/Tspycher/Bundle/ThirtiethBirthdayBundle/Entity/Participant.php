<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * People
 *
 * @ORM\Table(name="participants")
 * @ORM\Entity(repositoryClass="Tspycher\Bundle\ThirtiethBirthdayBundle\Entity\ParticipantRepository")
 */
class Participant
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfSeats", type="integer")
     */
    private $numberOfSeats;

    /** @ORM\OneToOne(targetEntity="People", cascade={"persist"}, inversedBy="participant") */
    private $people;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string")
     */
    private $code;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $people
     */
    public function setPeople(People $people)
    {
        $this->people = $people;
    }

    /**
     * @return mixed
     */
    public function getPeople()
    {
        return $this->people;
    }

    /**
     * Set numberOfSeats
     *
     * @param \int $numberOfSeats
     * @return People
     */
    public function setNumberOfSeats($numberOfSeats)
    {
        $this->numberOfSeats = $numberOfSeats;

        return $this;
    }

    /**
     * Get numberOfSeats
     *
     * @return \int
     */
    public function getNumberOfSeats()
    {
        return $this->numberOfSeats;
    }

    /**
     *
     */
    public function createCode()
    {
        $this->code = strtoupper(dechex(sprintf("%s%s",rand(10000,99999),$this->id)));
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }


}
