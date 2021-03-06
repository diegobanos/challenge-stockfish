<?php
namespace FrontBundle\Twitter\Stream;

use FrontBundle\EntityManager\StreamRequestManager;
use Phirehose;

class Reader
{
    /**
     * @var Consumer 
     */
    private $consumer;
    
    /**
     * @var string 
     */
    private $chessAccount;
    
    public function __construct($consumerKey, $consumerSecret, $oauthToken, $oauthSecret, $chessAccount, StreamRequestManager $streamRequestManager)
    {
        define('TWITTER_CONSUMER_KEY', $consumerKey);
        define('TWITTER_CONSUMER_SECRET', $consumerSecret);
        define('OAUTH_TOKEN', $oauthToken);
        define('OAUTH_SECRET', $oauthSecret);
        $this->chessAccount = $chessAccount;
        $this->consumer = new Consumer($oauthToken, $oauthSecret, Phirehose::METHOD_FILTER);
        $this->consumer->setStreamRequestManager($streamRequestManager);
    }
    
    public function readStream()
    {
        $this->consumer->setTrack([$this->chessAccount]);
        $this->consumer->consume();
    }
}

