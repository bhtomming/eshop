<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="compnay", type="string", length=255, nullable=true)
     */
    private $compnay;

    /**
     * @var string
     *
     * @ORM\Column(name="titleImg", type="string", length=255, nullable=true)
     */
    private $titleImg;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var int
     * @ORM\Column(name="sales", type="integer")
     */
    private $sales;


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
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set compnay
     *
     * @param string $compnay
     *
     * @return Product
     */
    public function setCompnay($compnay)
    {
        $this->compnay = $compnay;

        return $this;
    }

    /**
     * Get compnay
     *
     * @return string
     */
    public function getCompnay()
    {
        return $this->compnay;
    }

    /**
     * Set titleImg
     *
     * @param string $titleImg
     *
     * @return Product
     */
    public function setTitleImg($titleImg)
    {
        $this->titleImg = $titleImg;

        return $this;
    }

    /**
     * Get titleImg
     *
     * @return string
     */
    public function getTitleImg()
    {
        return $this->titleImg;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function setSales($sale){
        $this->sales = $sale;
        return $this;
    }

    public function getSales(){
        return $this->sales;
    }

    public function __toString()
    {
        return $this->title ? $this->title : '';
    }

    public function __construct()
    {
        $this->setSales(0);
    }
}

