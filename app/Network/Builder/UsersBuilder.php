<?php


namespace App\Network\Builder;


class UsersBuilder
{
    private $id;
    private $name;
    private $email;
    private $password;

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
    public function setId($id): UsersBuilder
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
    public function setName($name): UsersBuilder
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $amount
     */
    public function setEmail($email): UsersBuilder
    {
        $this->email = $email;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $amount
     */
    public function setPassword($password): UsersBuilder
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Function clone object
     *
     * @return UsersBuilder
     */
    public function clone()
    {
        return clone $this;
    }
}
