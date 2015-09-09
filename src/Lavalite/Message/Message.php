<?php namespace Lavalite\Message;

class Message
{

    protected $message;

    public function __construct(\Lavalite\Message\Interfaces\MessageRepositoryInterface $message)
    {
        $this->message     = $message;
    }

}
