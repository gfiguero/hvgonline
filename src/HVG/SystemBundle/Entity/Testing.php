<?php

namespace HVG\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Testing
 * @Vich\Uploadable
 */
class Testing
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $a_string;

    /**
     * @var integer
     */
    private $a_integer;

    /**
     * @var boolean
     */
    private $a_boolean;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set aString
     *
     * @param string $aString
     *
     * @return Testing
     */
    public function setAString($aString)
    {
        $this->a_string = $aString;

        return $this;
    }

    /**
     * Get aString
     *
     * @return string
     */
    public function getAString()
    {
        return $this->a_string;
    }

    /**
     * Set aInteger
     *
     * @param integer $aInteger
     *
     * @return Testing
     */
    public function setAInteger($aInteger)
    {
        $this->a_integer = $aInteger;

        return $this;
    }

    /**
     * Get aInteger
     *
     * @return integer
     */
    public function getAInteger()
    {
        return $this->a_integer;
    }

    /**
     * Set aBoolean
     *
     * @param boolean $aBoolean
     *
     * @return Testing
     */
    public function setABoolean($aBoolean)
    {
        $this->a_boolean = $aBoolean;

        return $this;
    }

    /**
     * Get aBoolean
     *
     * @return boolean
     */
    public function getABoolean()
    {
        return $this->a_boolean;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Testing
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
     * @return Testing
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
     * @return Testing
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
     * @var float
     */
    private $a_float;

    /**
     * @var \DateTime
     */
    private $a_date;

    /**
     * @var \DateTime
     */
    private $a_time;

    /**
     * @var \DateTime
     */
    private $a_datetime;

    /**
     * @var string
     */
    private $a_text;

    /**
     * @var string
     */
    private $a_file;


    /**
     * Set aFloat
     *
     * @param float $aFloat
     *
     * @return Testing
     */
    public function setAFloat($aFloat)
    {
        $this->a_float = $aFloat;

        return $this;
    }

    /**
     * Get aFloat
     *
     * @return float
     */
    public function getAFloat()
    {
        return $this->a_float;
    }

    /**
     * Set aDate
     *
     * @param \DateTime $aDate
     *
     * @return Testing
     */
    public function setADate($aDate)
    {
        $this->a_date = $aDate;

        return $this;
    }

    /**
     * Get aDate
     *
     * @return \DateTime
     */
    public function getADate()
    {
        return $this->a_date;
    }

    /**
     * Set aTime
     *
     * @param \DateTime $aTime
     *
     * @return Testing
     */
    public function setATime($aTime)
    {
        $this->a_time = $aTime;

        return $this;
    }

    /**
     * Get aTime
     *
     * @return \DateTime
     */
    public function getATime()
    {
        return $this->a_time;
    }

    /**
     * Set aDatetime
     *
     * @param \DateTime $aDatetime
     *
     * @return Testing
     */
    public function setADatetime($aDatetime)
    {
        $this->a_datetime = $aDatetime;

        return $this;
    }

    /**
     * Get aDatetime
     *
     * @return \DateTime
     */
    public function getADatetime()
    {
        return $this->a_datetime;
    }

    /**
     * Set aText
     *
     * @param string $aText
     *
     * @return Testing
     */
    public function setAText($aText)
    {
        $this->a_text = $aText;

        return $this;
    }

    /**
     * Get aText
     *
     * @return string
     */
    public function getAText()
    {
        return $this->a_text;
    }

    /**
     * Set aFile
     *
     * @param string $aFile
     *
     * @return Testing
     */
    public function setAFile($aFile)
    {
        $this->a_file = $aFile;

        return $this;
    }

    /**
     * Get aFile
     *
     * @return string
     */
    public function getAFile()
    {
        return $this->a_file;
    }

    /**
     * @var File $file
     */

    /**
     * @Vich\UploadableField(mapping="testing", fileNameProperty="afile")
     * @var File
     */
    private $file;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return Testing
     */
    
    public function setFile(File $file = null)
    {
        $this->file = $file;

        if ($file) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * @var string
     */
    private $a_decimal;


    /**
     * Set aDecimal
     *
     * @param string $aDecimal
     *
     * @return Testing
     */
    public function setADecimal($aDecimal)
    {
        $this->a_decimal = $aDecimal;

        return $this;
    }

    /**
     * Get aDecimal
     *
     * @return string
     */
    public function getADecimal()
    {
        return $this->a_decimal;
    }
}
