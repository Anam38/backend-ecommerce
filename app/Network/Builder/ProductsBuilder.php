<?php


namespace App\Network\Builder;


class ProductsBuilder
{
    private $id;
    private $name;
    private $category;
    private $img;
    private $weight;
    private $stock;
    private $size;
    private $variant;
    private $price;
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
    public function getCategoryCode()
    {
        return $this->category;
    }

    /**
     * @param mixed $amount
     */
    public function setCategoryCode($category): ProductsBuilder
    {
        $this->category = $category;
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
