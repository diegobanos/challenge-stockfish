<?php
namespace FrontBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use FrontBundle\Model\StreamRequest as BaseStreamRequest;

/**
 * @ORM\Table(name="stream_request")
 * @ORM\Entity
 */
class StreamRequest extends BaseStreamRequest
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var DateTime
     * 
     * @ORM\Column(type="datetime", name="received_at")
     */
    protected $receivedAt;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="json_array", name="status") 
     */
    protected $status;
    
    /**
     * @var bool
     * 
     * @ORM\Column(type="boolean", name="processed") 
     */
    protected $processed;
    
    public function setReceivedAt(DateTime $receivedAt)
    {
        $this->receivedAt = $receivedAt;
        return $this;
    }
    
    public function setStatus(string $status)
    {
        $this->status = $status;
        return $this;
    }
    
    public function setProcessed(bool $processed)
    {
        $this->processed = $processed;
        return $this;
    }
}

