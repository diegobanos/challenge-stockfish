<?php
namespace FrontBundle\Twitter\Stream;

use FrontBundle\EntityManager\StreamRequestManager;
use OauthPhirehose;

class Consumer extends OauthPhirehose
{
    /**
     * @var StreamRequestManager 
     */
    protected $streamRequestManager;
    
    public function enqueueStatus($status)
    {
        $this->streamRequestManager->saveStreamRequest($status);
    }
    
    public function getStreamRequestManager() : StreamRequestManager
    {
        return $this->streamRequestManager;
    }
    
    public function setStreamRequestManager(StreamRequestManager $streamRequestManager)
    {
        $this->streamRequestManager = $streamRequestManager;
    }
}