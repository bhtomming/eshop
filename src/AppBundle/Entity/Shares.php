<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Shares
 *
 * @ORM\Table(name="shares")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SharesRepository")
 */
class Shares
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="shares")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="ConsumeLog", inversedBy="shares")
     * @JoinColumn(name="consume_id", referencedColumnName="id")
     */
    private $consume;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="shares", type="integer")
     */
    private $shares;

    /**
     * @var float
     *
     * @ORM\Column(name="bonus", type="float", nullable=true)
     */
    private $bonus;



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
     * @return Shares
     */
    public function setUser(? User $user)
    {
        $this->user = $user;
        //$user->addShares($this);
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
     * Set consume
     *
     * @param ConsumeLog $consumeAmount
     *
     * @return Shares
     */
    public function setConsume(? ConsumeLog $consume)
    {
        $this->consume = $consume;

        return $this;
    }

    /**
     * Get consume
     *
     * @return ConsumeLog
     */
    public function getConsume()
    {
        return $this->consume;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Shares
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
     * Set shares
     *
     * @param integer $shares
     *
     * @return Shares
     */
    public function setShares($shares)
    {
        $this->shares = $shares;

        return $this;
    }

    /**
     * Get shares
     *
     * @return int
     */
    public function getShares()
    {
        return $this->shares;
    }

    /**
     * Set bonus
     *
     * @param float $bonus
     *
     * @return Shares
     */
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * Get bonus
     *
     * @return float
     */
    public function getBonus()
    {
        return $this->bonus;
    }

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime('now'));
    }
}

