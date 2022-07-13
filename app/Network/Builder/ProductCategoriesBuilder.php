<?php


namespace App\Network\Builder;


class ProductCategoriesBuilder
{
    private $id;
    private $name;
    private $code;
    private $img;

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
    public function setId($id): ProductCategoriesBuilder
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
    public function setName($name): ProductCategoriesBuilder
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $amount
     */
    public function setCode($code): ProductCategoriesBuilder
    {
        $this->code = $code;
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
    public function setImg($img): ProductCategoriesBuilder
    {
        $this->img = $img;
        return $this;
    }

    /**
     * Function clone object
     *
     * @return ProductCategoriesBuilder
     */
    public function clone()
    {
        return clone $this;
    }
}
