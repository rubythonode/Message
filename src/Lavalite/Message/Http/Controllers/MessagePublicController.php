<?php

namespace Lavalite\Message\Http\Controllers;

use App\Http\Controllers\PublicController as CMSPublicController;

class MessagePublicController extends CMSPublicController
{
    /**
     * Constructor.
     *
     * @param type \Lavalite\Message\Interfaces\MessageRepositoryInterface $message
     *
     * @return type
     */
    public function __construct(\Lavalite\Message\Interfaces\MessageRepositoryInterface $message)
    {
        $this->model = $message;
        parent::__construct();
    }

    /**
     * Show message's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index($slug)
    {
        $data['message'] = $this->model->all();

        return $this->theme->of('message::public.message.index', $data)->render();
    }

    /**
     * Show message.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $data['message'] = $this->model->getMessage($slug);

        return $this->theme->of('message::public.message.show', $data)->render();
    }
}
