<?php

namespace Lavalite\Message\Repositories\Eloquent;

use Lavalite\Message\Interfaces\MessageRepositoryInterface;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'Lavalite\\Message\\Models\\Message';
    }
}
