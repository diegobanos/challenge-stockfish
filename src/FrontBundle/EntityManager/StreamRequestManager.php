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
    
    /**
     * @var EntityRepository 
     */
    protected $streamRequestRepository;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->streamRequestRepository = $em->getRepository(StreamRequest::class);
    }
    
    public function findStreamRequestById(int $id)
    {
        return $this->streamRequestRepository->find($id);
    }
    
    public function findUnprocessedStreamRequests()
    {
        return $this->streamRequestRepository->findBy(['processed' => false]);
    }
    
    //NOTE: Ideally it would receive a StreamRequest already built
    public function saveStreamRequest(string $status)
    {
        $streamRequest = new StreamRequest;
        
        $streamRequest
            ->setReceivedAt(new DateTime)
            ->setStatus($status)
            ->setProcessed(false)
        ;
        
        $this->em->persist($streamRequest);
        $this->em->flush();
    }
    
    public function markRequestAsProcessed(StreamRequest $request)
    {
        $request->setProcessed(true);
        
        $this->em->merge($request);
        $this->em->flush();
    }
}
