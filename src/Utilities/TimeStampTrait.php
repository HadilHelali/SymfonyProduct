<?php
namespace App\Utilities;
use Doctrine\ORM\Mapping as ORM;
trait TimeStampTrait
{

    /**
     * @var
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    { return $this->createdAt;}

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {   $this->createdAt = $createdAt;  }

    /**
     * @var
     * @ORM\Column(type="datetime")
     */
    private $updtaedAt;

    /**
     * @return mixed
     */
    public function getUpdtaedAt()
    {
        return $this->updtaedAt;
    }

    /**
     * @param mixed $updtaedAt
     */
    public function setUpdtaedAt($updtaedAt): void
    {
        $this->updtaedAt = $updtaedAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function onUpdate()
    {
        $this->updtaedAt = new \DateTime();
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function onPersist()
    {
        $this->updtaedAt = new \DateTime();
    }
}