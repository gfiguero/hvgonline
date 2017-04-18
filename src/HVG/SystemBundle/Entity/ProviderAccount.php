<?php

namespace HVG\SystemBundle\Entity;

/**
 * ProviderAccount
 */
class ProviderAccount
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $ncuenta;

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
     * @var \HVG\SystemBundle\Entity\Bank
     */
    private $bank;

    /**
     * @var \HVG\SystemBundle\Entity\BankAccountKind
     */
    private $bank_account_kind;

    /**
     * @var \HVG\SystemBundle\Entity\Provider
     */
    private $provider;


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
     * Set ncuenta
     *
     * @param string $ncuenta
     *
     * @return ProviderAccount
     */
    public function setNcuenta($ncuenta)
    {
        $this->ncuenta = $ncuenta;

        return $this;
    }

    /**
     * Get ncuenta
     *
     * @return string
     */
    public function getNcuenta()
    {
        return $this->ncuenta;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ProviderAccount
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
     * @return ProviderAccount
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
     * @return ProviderAccount
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
     * Set bank
     *
     * @param \HVG\SystemBundle\Entity\Bank $bank
     *
     * @return ProviderAccount
     */
    public function setBank(\HVG\SystemBundle\Entity\Bank $bank = null)
    {
        $this->bank = $bank;

        return $this;
    }

    /**
     * Get bank
     *
     * @return \HVG\SystemBundle\Entity\Bank
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set bankAccountKind
     *
     * @param \HVG\SystemBundle\Entity\BankAccountKind $bankAccountKind
     *
     * @return ProviderAccount
     */
    public function setBankAccountKind(\HVG\SystemBundle\Entity\BankAccountKind $bankAccountKind = null)
    {
        $this->bank_account_kind = $bankAccountKind;

        return $this;
    }

    /**
     * Get bankAccountKind
     *
     * @return \HVG\SystemBundle\Entity\BankAccountKind
     */
    public function getBankAccountKind()
    {
        return $this->bank_account_kind;
    }

    /**
     * Set provider
     *
     * @param \HVG\SystemBundle\Entity\Provider $provider
     *
     * @return ProviderAccount
     */
    public function setProvider(\HVG\SystemBundle\Entity\Provider $provider = null)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \HVG\SystemBundle\Entity\Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }
    /**
     * @var \HVG\SystemBundle\Entity\BankAccountKind
     */
    private $bankaccountkind;


}
