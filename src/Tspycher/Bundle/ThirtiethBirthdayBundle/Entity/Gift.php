<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gift
 *
 * @ORM\Table(name="gifts")
 * @ORM\Entity(repositoryClass="Tspycher\Bundle\ThirtiethBirthdayBundle\Entity\GiftRepository")
 */
class Gift
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
