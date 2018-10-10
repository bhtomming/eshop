<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * ConsumeLog
 *
 * @ORM\Table(name="consume_log")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConsumeLogRepository")
 */
class ConsumeLog
{
    const PAYING = 0;
    const PAYEND = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="consume")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     *
     */
    private $product;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var Shares
     * @ORM\OneToMany(targetEntity="Shares", mappedBy="consume",cascade={"persist","remove"})
     */
    private $shares;

    /**
     * @var float
     *
     * @ORM\Column(name="afterBonus", type="float", nullable=true)
     */
    private $afterBonus;

    /**
     * @var boolean
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endAt", type="datetime", nullable=true)
     */
    private $endAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return ConsumeLog
     */
    public function setUser(? User $user)
    {
        $this->user = $user;
        //$user->addConsume($this);

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set product
     *
     * @param Product $product
     *
     * @return ConsumeLog
     */
    public function setProduct(? Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ConsumeLog
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return ConsumeLog
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return ConsumeLog
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    public function setShares(? Shares $shares){
        $this->addShares($shares);
        return $this;
    }

    public function addShares(? Shares $shares){
        if(!$this->shares->contains($shares)){
            $shares->setConsume($this);
            $this->shares->add($shares);
        }
        return $this;
    }

    public function removeShares(? Shares $shares){
        if($this->shares->contains($shares)){
            $this->shares->remove($shares);
            $shares->setConsume(null);
        }
        return $this;
    }

    public function getShares(){
        return $this->shares;
    }

    /**
     * Set afterBonus
     *
     * @param float $afterBonus
     *
     * @return ConsumeLog
     */
    public function setAfterBonus($afterBonus)
    {
        $this->afterBonus = $afterBonus;

        return $this;
    }

    /**
     * Get afterBonus
     *
     * @return float
     */
    public function getAfterBonus()
    {
        return $this->afterBonus;
    }

    public function setStatus($status){
        $this->status = $status;
        if($status == self::PAYEND){
            $this->setEndAt(new \DateTime('now'));
        }
        return $this;
    }

    public function getStatus(){
        return $this->status;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     *
     * @return ConsumeLog
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime('now'));
        $this->setStatus(self::PAYING);
        $this->shares = new ArrayCollection();
    }
}

