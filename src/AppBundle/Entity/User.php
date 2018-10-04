<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    const LEVLE_1 = '代理商';
    const LEVLE_2 = '总代理商';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="realname", type="string", length=255, nullable=true)
     */
    private $realname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true, unique=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true, unique=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="alipay", type="string", length=255, nullable=true)
     */
    private $alipay;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", nullable=true)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="bank", type="string", length=255, nullable=true)
     */
    private $bank;

    /**
     * @var string
     *
     * @ORM\Column(name="bankCard", type="string", length=50, nullable=true)
     */
    private $bankCard;

    /**
     * @var int
     *
     * @ORM\Column(name="direct", type="integer", nullable=true)
     */
    private $direct;

    /**
     * @var int
     *
     * @ORM\Column(name="indirect", type="integer", nullable=true)
     */
    private $indirect;

    /**
     * @ORM\OneToMany(targetEntity="User",mappedBy="referee")
     */
    private $directTeam;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="directTeam")
     * @JoinColumn(name="referee_id", referencedColumnName="id")
     */
    private $referee;

    /**
     * @ORM\OneToMany(targetEntity="Cash", mappedBy="user")
     */
    private $cashed;

    /**
     * @ORM\OneToMany(targetEntity="Commission", mappedBy="user")
     */
    private $commission;

    /**
     * @ORM\OneToMany(targetEntity="ConsumeLog", mappedBy="user")
     */
    private $consume;

    /**
     * @ORM\OneToMany(targetEntity="RechargeLog", mappedBy="user")
     */
    private $recharge;

    /**
     * @ORM\OneToMany(targetEntity="Shares", mappedBy="user")
     */
    private $shares;

    /**
     * @var string
     * @ORM\Column(name="level", type="string", length=255, nullable=true)
     */
    private $level;


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
     * Set realname
     *
     * @param string $realname
     *
     * @return User
     */
    public function setRealname($realname)
    {
        $this->realname = $realname;

        return $this;
    }

    /**
     * Get realname
     *
     * @return string
     */
    public function getRealname()
    {
        return $this->realname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set alipay
     *
     * @param string $alipay
     *
     * @return User
     */
    public function setAlipay($alipay)
    {
        $this->alipay = $alipay;

        return $this;
    }

    /**
     * Get alipay
     *
     * @return string
     */
    public function getAlipay()
    {
        return $this->alipay;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return User
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
     * Set bank
     *
     * @param string $bank
     *
     * @return User
     */
    public function setBank($bank)
    {
        $this->bank = $bank;

        return $this;
    }

    /**
     * Get bank
     *
     * @return string
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set bankCard
     *
     * @param string $bankCard
     *
     * @return User
     */
    public function setBankCard($bankCard)
    {
        $this->bankCard = $bankCard;

        return $this;
    }

    /**
     * Get bankCard
     *
     * @return string
     */
    public function getBankCard()
    {
        return $this->bankCard;
    }

    /**
     * Set referee
     *
     * @param  $referee
     *
     * @return User
     */
    public function setReferee(? User $referee)
    {
        $this->referee = $referee;

        return $this;
    }

    /**
     * Get referee
     *
     * @return User
     */
    public function getReferee()
    {
        return $this->referee;
    }

    public function setAddress($address){
        $this->address = $address;
        return $this;
    }

    public function getAddress(){
        return $this->address;
    }

    public function addDirectTeam(User $user){
        if(!$this->directTeam->contains($user)){
            $this->directTeam->add($user);
            $user->setReferee($this);
            $this->direct++;
            $parent = $this->getReferee();
            if($parent){
                $parent->setIndirect($parent->getIndirect() + 1);
            }
        }
        return $this;
    }

    public function removeDirectTeam(User $user){
        if($this->directTeam->contains($user)){
            $this->directTeam->remove($user);
            $user->setReferee(null);
            $this->direct--;
            $parent = $this->getReferee();
            if($parent){
                $parent->setIndirect($parent->getIndirect() - 1);
            }
        }
        return $this;
    }

    public function setDirectTeam(User $user){
        $this->addDirectTeam($user);
    }

    public function getDirectTeam(){
        return $this->directTeam;
    }

    public function addCashed(? Cash $cash){
        if(!$this->cashed->contains($cash)){
            $this->cashed->add($cash);
        }
        return $this;
    }

    public function removeCashed(? Cash $cash){
        if($this->cashed->contains($cash)){
            $this->cashed->remove($cash);
        }
        return $this;
    }

    public function getCashed(){
        return $this->cashed;
    }

    public function addCommission(? Commission $commission){
        if(!$this->commission->contains($commission)){
            $this->commission->add($commission);
        }
        return $this;
    }

    public function removeCommission(? Commission $commission){
        if($this->commission->contains($commission)){
            $this->commission->remove($commission);
        }
        return $this;
    }

    public function getCommission(){
        return $this;
    }

    public function addConsume(? ConsumeLog $consume){
        if(!$this->consume->contains($consume)){
            $this->consume->add($consume);
        }
        return $this;
    }

    public function removeConsume(? ConsumeLog $consume){
        if($this->consume->contains($consume)){
            $this->consume->remove($consume);
        }
        return $this;
    }

    public function getConsume(){
        return $this->consume;
    }

    public function addRecharge(? RechargeLog $recharge){
        if(!$this->recharge->contains($recharge)){
            $this->recharge->add($recharge);
        }
        return $this;
    }

    public function removeRecharge(RechargeLog $recharge){
        if($this->recharge->contains($recharge)){
            $this->recharge->remove($recharge);
        }
        return $this;
    }

    public function getRecharge(){
        return $this->recharge;
    }

    public function addShares(? Shares $shares){
        if(!$this->shares->contains($shares)){
            $this->shares->add($shares);
        }
        return $this;
    }

    public function removeShares(Shares $shares){
        if($this->shares->contains($shares)){
            $this->shares->remove($shares);
        }
        return $this;
    }

    public function getShares(){
        return $this->shares;
    }

    /**
     * Set direct
     *
     * @param integer $direct
     *
     * @return User
     */
    public function setDirect($direct)
    {
        $this->direct = $direct;
        if($direct >= 20 && 60 > $direct){
            $this->setLevel(self::LEVLE_1);
        }
        if(60 <= $direct){
            $this->setLevel(self::LEVLE_2);
        }

        return $this;
    }

    /**
     * Get direct
     *
     * @return int
     */
    public function getDirect()
    {
        return $this->direct;
    }

    /**
     * Set indirect
     *
     * @param integer $indirect
     *
     * @return User
     */
    public function setIndirect($indirect)
    {
        $this->indirect = $indirect;

        return $this;
    }

    /**
     * Get indirect
     *
     * @return int
     */
    public function getIndirect()
    {
        return $this->indirect;
    }

    public function setLevel(? string $level){
        $this->level = $level;
        return $this;
    }

    public function getLevel(){
        return $this->level;
    }

    public function __construct(){
        parent::__construct();
        $this->amount = 0;
        $this->setDirect(0);
        $this->setIndirect(0);
        $this->directTeam = new ArrayCollection();
        $this->cashed = new ArrayCollection();
        $this->commission = new ArrayCollection();
        $this->consume = new ArrayCollection();
        $this->recharge = new ArrayCollection();
        $this->shares = new ArrayCollection();
    }
}

