<?php

namespace HVG\SystemBundle\Entity;

/**
 * Provider
 */
class Provider
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $rut;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $expert_name;

    /**
     * @var \DateTime
     */
    private $contract_start;

    /**
     * @var \DateTime
     */
    private $contract_end;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $deletedAt;

    /**
     * @var \HVG\SystemBundle\Entity\BankAccount
     */
    private $bank_account;


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
     * Set name
     *
     * @param string $name
     *
     * @return Provider
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set rut
     *
     * @param string $rut
     *
     * @return Provider
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get rut
     *
     * @return string
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Provider
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
     * Set mail
     *
     * @param string $mail
     *
     * @return Provider
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set expertName
     *
     * @param string $expertName
     *
     * @return Provider
     */
    public function setExpertName($expertName)
    {
        $this->expert_name = $expertName;

        return $this;
    }

    /**
     * Get expertName
     *
     * @return string
     */
    public function getExpertName()
    {
        return $this->expert_name;
    }

    /**
     * Set contractStart
     *
     * @param \DateTime $contractStart
     *
     * @return Provider
     */
    public function setContractStart($contractStart)
    {
        $this->contract_start = $contractStart;

        return $this;
    }

    /**
     * Get contractStart
     *
     * @return \DateTime
     */
    public function getContractStart()
    {
        return $this->contract_start;
    }

    /**
     * Set contractEnd
     *
     * @param \DateTime $contractEnd
     *
     * @return Provider
     */
    public function setContractEnd($contractEnd)
    {
        $this->contract_end = $contractEnd;

        return $this;
    }

    /**
     * Get contractEnd
     *
     * @return \DateTime
     */
    public function getContractEnd()
    {
        return $this->contract_end;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Provider
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Provider
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Provider
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set bankAccount
     *
     * @param \HVG\SystemBundle\Entity\BankAccount $bankAccount
     *
     * @return Provider
     */
    public function setBankAccount(\HVG\SystemBundle\Entity\BankAccount $bankAccount = null)
    {
        $this->bank_account = $bankAccount;

        return $this;
    }

    /**
     * Get bankAccount
     *
     * @return \HVG\SystemBundle\Entity\BankAccount
     */
    public function getBankAccount()
    {
        return $this->bank_account;
    }
}
