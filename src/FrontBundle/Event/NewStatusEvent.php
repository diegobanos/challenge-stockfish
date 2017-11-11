<?php
namespace FrontBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class NewStatusEvent extends Event
{
    const NAME = 'status.new';

    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function getUserId() : string
    {
        return $this->status->user->id_str;
    }

    public function getUserName() : string
    {
        return $this->status->user->screen_name;
    }
    
    public function getText() : string
    {
        return $this->status->text;
    }
}