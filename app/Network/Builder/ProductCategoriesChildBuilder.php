<?php


namespace App\Network\Builder;


class ProductCategoriesChildBuilder
{
    private $id;
    private $name;
    private $code;
    private $master_code;

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
    public function setId($id): ProductCategoriesChildBuilder
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
    public function setName($name): ProductCategoriesChildBuilder
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
    public function setCode($code): ProductCategoriesChildBuilder
    {
        $this->code = $code;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getCategoryMasterCode()
    {
        return $this->master_code;
    }

    /**
     * @param mixed $amount
     */
    public function setCategoryMasterCode($master_code): ProductCategoriesChildBuilder
    {
        $this->master_code = $master_code;
        return $this;
    }

    /**
     * Function clone object
     *
     * @return ProductCategoriesChildBuilder
     */
    public function clone()
    {
        return clone $this;
    }
}
