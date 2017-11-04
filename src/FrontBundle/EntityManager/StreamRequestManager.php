<?php
namespace FrontBundle\EntityManager;

use DateTime;
use Doctrine\ORM\EntityManager;
use FrontBundle\Entity\StreamRequest;

class StreamRequestManager
{
    /**
     * @var EntityManager 
     */
    protected $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    //NOTE: Ideally it would receive a StreamRequest already built
    public function saveStreamRequest(string $status, bool $andFlush = true)
    {
        $streamRequest = new StreamRequest;
        
        $streamRequest
            ->setReceivedAt(new DateTime)
            ->setStatus($status)
            ->setProcessed(false)
        ;
        
        $this->em->persist($streamRequest);
        
        if ($andFlush) {
            $this->em->flush();
        }
    }
}

