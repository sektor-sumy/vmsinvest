<?php
namespace X5\TestBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * X5\TestBundle\Entity\ProductCategory
 *
 * @ORM\Table(name="product_category")
 * @ORM\Entity
 */
class ProductCategory
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

    function __toString()
    {
      return $this->getTitle();
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ProductCategory
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
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return ProductCategory
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
     * @return ProductCategory
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
}
