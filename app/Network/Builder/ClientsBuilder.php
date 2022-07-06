<?php


namespace App\Network\Builder;


class ClientsBuilder
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $phone;
    private $gender;
    private $address;
    private $birth;

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
    public function setId($id): ClientsBuilder
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $amount
     */
    public function setUsername($username): ClientsBuilder
    {
        $this->username = $username;
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
    public function setEmail($email): ClientsBuilder
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
    public function setPassword($password): ClientsBuilder
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $amount
     */
    public function setPhone($phone): ClientsBuilder
    {
        $this->phone = $phone;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $amount
     */
    public function setGender($gender): ClientsBuilder
    {
        $this->gender = $gender;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $amount
     */
    public function setAddress($address): ClientsBuilder
    {
        $this->address = $address;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param mixed $amount
     */
    public function setBirth($birth): ClientsBuilder
    {
        $this->birth = $birth;
        return $this;
    }

    /**
     * Function clone object
     *
     * @return ClientsBuilder
     */
    public function clone()
    {
        return clone $this;
    }
}
