<?php


namespace App\Network\Builder;


class ProductsBuilder
{
    private $id;
    private $name;
    private $category_master;
    private $category_child;
    private $img;
    private $weight;
    private $stock;
    private $size;
    private $variant;
    private $price;
    private $popular = 0;
    private $new = 0;
    private $discount;
    private $description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $amount
     */
    public function setId($id): ProductsBuilder
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $amount
     */
    public function setName($name): ProductsBuilder
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getCategoryCodeMaster()
    {
        return $this->category_master;
    }

    /**
     * @param mixed $amount
     */
    public function setCategoryCodeMaster($category_master): ProductsBuilder
    {
        $this->category_master = $category_master;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getCategoryCodeChild()
    {
        return $this->category_child;
    }

    /**
     * @param mixed $amount
     */
    public function setCategoryCodeChild($category_child): ProductsBuilder
    {
        $this->category_child = $category_child;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $amount
     */
    public function setImg($img): ProductsBuilder
    {
        $this->img = $img;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $amount
     */
    public function setWeight($weight): ProductsBuilder
    {
        $this->weight = $weight;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $amount
     */
    public function setStock($stock): ProductsBuilder
    {
        $this->stock = $stock;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $amount
     */
    public function setSize($size): ProductsBuilder
    {
        $this->size = $size;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @param mixed $amount
     */
    public function setVariant($variant): ProductsBuilder
    {
        $this->variant = $variant;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $amount
     */
    public function setPrice($price): ProductsBuilder
    {
        $this->price = $price;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPopular()
    {
        return $this->popular;
    }

    /**
     * @param mixed $amount
     */
    public function setPopular($popular): ProductsBuilder
    {
        $this->popular = $popular;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * @param mixed $amount
     */
    public function setNew($new): ProductsBuilder
    {
        $this->new = $new;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $amount
     */
    public function setDiscount($discount): ProductsBuilder
    {
        $this->discount = $discount;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $amount
     */
    public function setDescription($description): ProductsBuilder
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Function clone object
     *
     * @return ProductsBuilder
     */
    public function clone()
    {
        return clone $this;
    }
}
