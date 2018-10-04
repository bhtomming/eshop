<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * RechargeLog
 *
 * @ORM\Table(name="recharge_log")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RechargeLogRepository")
 */
class RechargeLog
{
    const ALIPAY = 0;
    const WEIPAY = 1;
    const UNIONPAY = 2;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="recharge")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="rechargeType", type="string", length=2)
     */
    private $rechargeType;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="afterAmount", type="string", length=255)
     */
    private $afterAmount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;


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
     * @return RechargeLog
     */
    public function setUser($user)
    {
        $this->user = $user;

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
     * Set rechargeType
     *
     * @param string $rechargeType
     *
     * @return RechargeLog
     */
    public function setRechargeType($rechargeType)
    {
        $this->rechargeType = $rechargeType;

        return $this;
    }

    /**
     * Get rechargeType
     *
     * @return string
     */
    public function getRechargeType()
    {
        return $this->rechargeType;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return RechargeLog
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

    /**
     * Set afterAmount
     *
     * @param string $afterAmount
     *
     * @return RechargeLog
     */
    public function setAfterAmount($afterAmount)
    {
        $this->afterAmount = $afterAmount;

        return $this;
    }

    /**
     * Get afterAmount
     *
     * @return string
     */
    public function getAfterAmount()
    {
        return $this->afterAmount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RechargeLog
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

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime('now'));
    }
}

