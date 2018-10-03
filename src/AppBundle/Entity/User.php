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
     * @ORM\OneToMany(targetEntity="User",mappedBy="referee")
     */
    private $directTeam;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="directTeam")
     * @JoinColumn(name="referee_id", referencedColumnName="id")
     */
    private $referee;


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
     * @param User $referee
     *
     * @return User
     */
    public function setReferee(User $referee)
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
        }
        return $this;
    }

    public function removeDirectTeam(User $user){
        if($this->directTeam->contains($user)){
            $this->directTeam->remove($user);
        }
        return $this;
    }

    public function setDirectTeam(User $user){
        $this->addDirectTeam($user);
    }

    public function getDirectTeam(){
        return $this->directTeam;
    }

    public function __construct(){
        parent::__construct();
        $this->directTeam = new ArrayCollection();
    }
}

