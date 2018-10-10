<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Businessreport
 *
 * @ORM\Table(name="businessreport")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusinessreportRepository")
 */
class Businessreport
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
     * @var string
     * @ORM\Column(name="no", type="string", length=255)
     */
    private $no;

    /**
     * @var float
     *
     * @ORM\Column(name="turnover", type="float")
     */
    private $turnover;

    /**
     * @var float
     *
     * @ORM\Column(name="smallDish", type="float")
     */
    private $smallDish;

    /**
     * @var float
     *
     * @ORM\Column(name="shares", type="float")
     */
    private $shares;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var float
     *
     * @ORM\Column(name="profit", type="float", nullable=true)
     */
    private $profit;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setNo($no){
        $this->no = $no;
    }

    public function getNo(){
        return $this->no;
    }

    /**
     * Set turnover
     *
     * @param float $turnover
     *
     * @return Businessreport
     */
    public function setTurnover($turnover)
    {
        $this->turnover = $turnover;

        return $this;
    }

    /**
     * Get turnover
     *
     * @return float
     */
    public function getTurnover()
    {
        return $this->turnover;
    }

    /**
     * Set smallDish
     *
     * @param float $smallDish
     *
     * @return Businessreport
     */
    public function setSmallDish($smallDish)
    {
        $this->smallDish = $smallDish;

        return $this;
    }

    /**
     * Get smallDish
     *
     * @return float
     */
    public function getSmallDish()
    {
        return $this->smallDish;
    }

    public function addSmallDish($smallDish){
        $this->smallDish += $smallDish;

        return $this;
    }

    /**
     * Set shares
     *
     * @param float $shares
     *
     * @return Businessreport
     */
    public function setShares($shares)
    {
        $this->shares = $shares;

        return $this;
    }

    /**
     * Get shares
     *
     * @return float
     */
    public function getShares()
    {
        return $this->shares;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Businessreport
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set profit
     *
     * @param float $profit
     *
     * @return Businessreport
     */
    public function setProfit($profit)
    {
        $this->profit = $profit;

        return $this;
    }

    /**
     * Get profit
     *
     * @return float
     */
    public function getProfit()
    {
        return $this->profit;
    }

    public function getPreshare(){
        return number_format($this->smallDish / $this->shares,2);
    }

    public function addTurnover($amount){
        $this->turnover += $amount;
        return $this;
    }

    public function addShares($shares){
        $this->shares += $shares;
        return $this;
    }

    public function subtractShares($shares){
        $this->shares -= $shares;

        return $this;
    }

    public function __construct()
    {
        $day = new \DateTime('now');
        $this->setUpdatedAt($day);
        $this->setNo("MY{$day->format('Ymd')}");
    }
}

