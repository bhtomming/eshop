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
     * @var float
     *
     * @ORM\Column(name="consumeAmount", type="float")
     */
    private $consumeAmount;

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
     * @ORM\Column(name="bonus", type="float")
     */
    private $bonus;

    /**
     * @var float
     *
     * @ORM\Column(name="afterBonus", type="float")
     */
    private $afterBonus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endAt", type="date")
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
     * @return Shares
     */
    public function setUser(? User $user)
    {
        $this->user = $user;
        $user->addShares($this);
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
     * Set consumeAmount
     *
     * @param float $consumeAmount
     *
     * @return Shares
     */
    public function setConsumeAmount($consumeAmount)
    {
        $this->consumeAmount = $consumeAmount;

        return $this;
    }

    /**
     * Get consumeAmount
     *
     * @return float
     */
    public function getConsumeAmount()
    {
        return $this->consumeAmount;
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

    /**
     * Set afterBonus
     *
     * @param float $afterBonus
     *
     * @return Shares
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

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     *
     * @return Shares
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
    }
}

