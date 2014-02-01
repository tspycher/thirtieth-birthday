<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donate
 *
 * @ORM\Table()
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


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
