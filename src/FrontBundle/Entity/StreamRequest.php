<?php
namespace FrontBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="stream_request")
 * @ORM\Entity
 */
class StreamRequest
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var DateTime
     * 
     * @ORM\Column(type="datetime", name="received_at")
     */
    private $receivedAt;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="json_array", name="status") 
     */
    private $status;
    
    /**
     * @var bool
     * 
     * @ORM\Column(type="boolean", name="processed") 
     */
    private $processed;
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setReceivedAt(DateTime $receivedAt) : StreamRequest
    {
        $this->receivedAt = $receivedAt;
        return $this;
    }
    
    public function setStatus(string $status) : StreamRequest
    {
        $this->status = $status;
        return $this;
    }
    
    public function setProcessed(bool $processed) : StreamRequest
    {
        $this->processed = $processed;
        return $this;
    }
}
