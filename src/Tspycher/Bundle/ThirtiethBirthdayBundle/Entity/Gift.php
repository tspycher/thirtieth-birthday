<?php

namespace Tspycher\Bundle\ThirtiethBirthdayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\VirtualProperty;



/**
 * Gift
 *
 * @ORM\Table(name="gifts")
 * @ORM\Entity(repositoryClass="Tspycher\Bundle\ThirtiethBirthdayBundle\Entity\GiftRepository")
 * @ExclusionPolicy("all")
 */
class Gift
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /** @ORM\OneToMany(targetEntity="Donate", mappedBy="gift") */
    private $donators;

    /**
     * @var
     * @ORM\Column(name="price", type="integer")
     * @Expose
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Expose
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_url", type="string", length=255)
     * @Expose
     */
    private $pictureUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     * @Expose
     */
    private $url;

    function __construct()
    {
        $this->donators = new ArrayCollection();
    }

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
     * @return mixed
     */
    public function getDonators()
    {
        return $this->donators;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $pictureUrl
     */
    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
    }

    /**
     * @return string
     */
    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Returns difference between donated and price of gift
     *
     * @return mixed
     * @VirtualProperty()
     */
    public function getOpen() {
        $x = $this->price;
        foreach($this->donators as $d) {
            $x -= $d->getAmount();
        }
        return $x;
    }

    /**
     * Returns difference between donated and price of gift
     *
     * @return mixed
     * @VirtualProperty()
     */
    public function getOpenPercent() {
        return round(100 / $this->price * $this->getDonated(),0);
    }
    /**
     * Returns amount of donated value
     *
     * @return int
     * @VirtualProperty()
     */
    public function getDonated() {
        $x = 0;
        foreach($this->donators as $d) {
            $x += $d->getAmount();
        }
        return $x;
    }

    /**
     * Returns number of donators
     *
     * @return int
     */
    public function getDonatorsCount() {
        return $this->donators->count();
    }

    /**
     * Returns array with donation statistics
     *
     * @return array
     */
    public function getDonationStats() {
        return array("donated" => $this->getDonated(), "donators" => $this->getDonatorsCount(), "open" => $this->getOpen());
    }
}
