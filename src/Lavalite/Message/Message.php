<?php

namespace Lavalite\Message;

class Message
{
    protected $message;

    public function __construct(\Lavalite\Message\Interfaces\MessageRepositoryInterface $message)
    {
        $this->message = $message;
    }

    /**
     * Display message of the user.
     *
     * @return void
     *
     * @author
     **/
    public function display($view)
    {
        return view('message::admin.message.'.$view);
    }
    public function messages()
    {
        return  $this->message->messages();
    }

    public function count($slug)
    {
        return  $this->message->msgCount($slug);
    }

    public function unreadCount()
    {
        return  $this->message->unreadCount();
    }

    public function unread()
    {
        return  $this->message->unread();
    }
}
