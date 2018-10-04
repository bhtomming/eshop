<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Commission
 *
 * @ORM\Table(name="commission")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommissionRepository")
 */
class Commission
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="commission")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var float
     *
     * @ORM\Column(name="directConsume", type="float", nullable=true)
     */
    private $directConsume;

    /**
     * @var float
     *
     * @ORM\Column(name="indirectConsume", type="float", nullable=true)
     */
    private $indirectConsume;

    /**
     * @var float
     *
     * @ORM\Column(name="directCommision", type="float", nullable=true)
     */
    private $directCommision;

    /**
     * @var float
     *
     * @ORM\Column(name="indirectCommission", type="float", nullable=true)
     */
    private $indirectCommission;

    /**
     * @var float
     *
     * @ORM\Column(name="directProportion", type="float", nullable=true)
     */
    private $directProportion;

    /**
     * @var float
     *
     * @ORM\Column(name="indirectProportion", type="float", nullable=true)
     */
    private $indirectProportion;

    /**
     * @var float
     *
     * @ORM\Column(name="teamProportion", type="float", nullable=true)
     */
    private $teamProportion;

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
     * @return Commission
     */
    public function setUser(? User $user)
    {
        $this->user = $user;
        $user->addCommission($this);

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
     * Set directConsume
     *
     * @param float $directConsume
     *
     * @return Commission
     */
    public function setDirectConsume($directConsume)
    {
        $this->directConsume = $directConsume;

        return $this;
    }

    /**
     * Get directConsume
     *
     * @return float
     */
    public function getDirectConsume()
    {
        return $this->directConsume;
    }

    /**
     * Set indirectConsume
     *
     * @param float $indirectConsume
     *
     * @return Commission
     */
    public function setIndirectConsume($indirectConsume)
    {
        $this->indirectConsume = $indirectConsume;

        return $this;
    }

    /**
     * Get indirectConsume
     *
     * @return float
     */
    public function getIndirectConsume()
    {
        return $this->indirectConsume;
    }

    /**
     * Set directCommision
     *
     * @param float $directCommision
     *
     * @return Commission
     */
    public function setDirectCommision($directCommision)
    {
        $this->directCommision = $directCommision;

        return $this;
    }

    /**
     * Get directCommision
     *
     * @return float
     */
    public function getDirectCommision()
    {
        return $this->directCommision;
    }

    /**
     * Set indirectCommission
     *
     * @param float $indirectCommission
     *
     * @return Commission
     */
    public function setIndirectCommission($indirectCommission)
    {
        $this->indirectCommission = $indirectCommission;

        return $this;
    }

    /**
     * Get indirectCommission
     *
     * @return float
     */
    public function getIndirectCommission()
    {
        return $this->indirectCommission;
    }

    /**
     * Set directProportion
     *
     * @param float $directProportion
     *
     * @return Commission
     */
    public function setDirectProportion($directProportion)
    {
        $this->directProportion = $directProportion;

        return $this;
    }

    /**
     * Get directProportion
     *
     * @return float
     */
    public function getDirectProportion()
    {
        return $this->directProportion;
    }

    /**
     * Set indirectProportion
     *
     * @param float $indirectProportion
     *
     * @return Commission
     */
    public function setIndirectProportion($indirectProportion)
    {
        $this->indirectProportion = $indirectProportion;

        return $this;
    }

    /**
     * Get indirectProportion
     *
     * @return float
     */
    public function getIndirectProportion()
    {
        return $this->indirectProportion;
    }

    /**
     * Set teamProportion
     *
     * @param float $teamProportion
     *
     * @return Commission
     */
    public function setTeamProportion($teamProportion)
    {
        $this->teamProportion = $teamProportion;

        return $this;
    }

    /**
     * Get teamProportion
     *
     * @return float
     */
    public function getTeamProportion()
    {
        return $this->teamProportion;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Commission
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

