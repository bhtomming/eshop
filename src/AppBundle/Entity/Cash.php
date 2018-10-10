<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Cash
 *
 * @ORM\Table(name="cash")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CashRepository")
 */
class Cash
{
    const UNPASS = 0;
    const PASS = 1;
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="cashed")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @var float
     *
     * @ORM\Column(name="conditions", type="float")
     */
    private $conditions;

    /**
     * @var string
     *
     * @ORM\Column(name="cashType", type="string", length=2)
     */
    private $cashType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="passedAt", type="date", nullable=true)
     */
    private $passedAt;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @JoinColumn(name="auditor_id", referencedColumnName="id")
     */
    private $auditor;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=2)
     */
    private $status;


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
     * @param  $user
     *
     * @return Cash
     */
    public function setUser(? User $user)
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
     * Set amount
     *
     * @param float $amount
     *
     * @return Cash
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Cash
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
     * Set conditions
     *
     * @param float $conditions
     *
     * @return Cash
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return float
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set cashType
     *
     * @param string $cashType
     *
     * @return Cash
     */
    public function setCashType($cashType)
    {
        $this->cashType = $cashType;

        return $this;
    }

    /**
     * Get cashType
     *
     * @return string
     */
    public function getCashType()
    {
        return $this->cashType;
    }

    /**
     * Set passedAt
     *
     * @param \DateTime $passedAt
     *
     * @return Cash
     */
    public function setPassedAt($passedAt)
    {
        $this->passedAt = $passedAt;

        return $this;
    }

    /**
     * Get passedAt
     *
     * @return \DateTime
     */
    public function getPassedAt()
    {
        return $this->passedAt;
    }

    /**
     * Set auditor
     *
     * @param User $auditor
     *
     * @return Cash
     */
    public function setAuditor(? User $auditor)
    {
        $this->auditor = $auditor;

        return $this;
    }

    /**
     * Get auditor
     *
     * @return User
     */
    public function getAuditor()
    {
        return $this->auditor;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Cash
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function __construct()
    {
        $this->setStatus(self::UNPASS);
        $this->conditions = 500;
        $this->setCreatedAt(new \DateTime('now'));
    }
}

