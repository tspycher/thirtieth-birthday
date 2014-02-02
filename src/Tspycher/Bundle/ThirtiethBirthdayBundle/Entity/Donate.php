<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donate
 *
 * @ORM\Table(name="donations")
 * @ORM\Entity(repositoryClass="Tspycher\Bundle\ThirtiethBirthdayBundle\Entity\DonateRepository")
 */
class Donate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\OneToOne(targetEntity="People", inversedBy="donate") */
    private $people;

    /** @ORM\ManyToOne(targetEntity="Gift", inversedBy="donators") */
    private $gift;

    /**
     * @var
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    /**
     * @var
     * @ORM\Column(name="message", type="text")
     */
    private $message;

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
     * @param mixed $gift
     */
    public function setGift(Gift $gift)
    {
        $this->gift = $gift;
    }

    /**
     * @return mixed
     */
    public function getGift()
    {
        return $this->gift;
    }

    /**
     * @param mixed $people
     */
    public function setPeople($people)
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
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }




}
