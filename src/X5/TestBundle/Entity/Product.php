<?php
namespace X5\TestBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * X5\TestBundle\Entity\Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity
 */
class Product
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var text $announce
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer $price
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @var ProductCategory
     *
     * @ORM\ManyToOne(targetEntity="ProductCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_category_id", referencedColumnName="id")
     * })
     */
    private $productCategory;
    
    /**
     * Is used for status of sector - 0 = active / 1 delete
     * @var boolean
     * @ORM\Column(name="is_delete", type="boolean")
     */
    private $isDelete;

     /**
     * Creation date
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_date;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
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
     * Set description
     *
     * @param string $description
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

    /**
     * Set price
     *
     * @param integer $price
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
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Product
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean 
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * Set created_date
     *
     * @param \DateTime $createdDate
     * @return Product
     */
    public function setCreatedDate($createdDate)
    {
        $this->created_date = $createdDate;

        return $this;
    }

    /**
     * Get created_date
     *
     * @return \DateTime 
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

    /**
     * Set productCategory
     *
     * @param \X5\TestBundle\Entity\ProductCategory $productCategory
     * @return Product
     */
    public function setProductCategory(\X5\TestBundle\Entity\ProductCategory $productCategory = null)
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * Get productCategory
     *
     * @return \X5\TestBundle\Entity\ProductCategory 
     */
    public function getProductCategory()
    {
        return $this->productCategory;
    }
}
