<?php
namespace FrontBundle\StreamRequest;

use FrontBundle\EntityManager\StreamRequestManager;
use FrontBundle\Event\NewStatusEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Processor
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    
    /**
     * @var StreamRequestManager 
     */
    private $streamRequestManager;
    
    public function __construct(StreamRequestManager $streamRequestManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->dispatcher = $eventDispatcher;
        $this->streamRequestManager = $streamRequestManager;
    }
    
    public function processRequests()
    {
        $requests = $this->streamRequestManager->findUnprocessedStreamRequests();
        
        foreach ($requests as $request) {
            $newStatusEvent = new NewStatusEvent(json_decode($request->getStatus()));
            $this->dispatcher->dispatch(NewStatusEvent::NAME, $newStatusEvent);
            //$this->streamRequestManager->markRequestAsProcessed($request);
        }
    }
}
