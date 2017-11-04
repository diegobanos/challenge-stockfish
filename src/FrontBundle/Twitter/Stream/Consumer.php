<?php
namespace FrontBundle\Twitter\Stream;

use OauthPhirehose;
use function dump;

class Consumer extends OauthPhirehose
{
    public function enqueueStatus($status)
    {
        //TODO: Throw an event with the tweet
        $data = json_decode($status, true);
        dump(date("Y-m-d H:i:s (").strlen($status)."):".print_r($data,true)."\n");
    }
}