<?php

namespace Lavalite\Message\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class MessageListTransformer extends TransformerAbstract
{
    public function transform(\Lavalite\Message\Models\Message $message)
    {
        return [
            'id'      => $message->eid,
            'from' => $message->from,
            'to' => $message->to,
            'subject'   => $message->subject,
            'message'   => $message->message,
            'read'   => $message->read,
            'type'   => $message->type,
        ];
    }
}

