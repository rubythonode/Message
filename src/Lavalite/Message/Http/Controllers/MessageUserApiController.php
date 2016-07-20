<?php

namespace Lavalite\Message\Http\Controllers;

use App\Http\Controllers\UserApiController as UserController;
use Lavalite\Message\Http\Requests\MessageUserApiRequest;
use Lavalite\Message\Interfaces\MessageRepositoryInterface;
use Lavalite\Message\Models\Message;

/**
 * User API controller class.
 */
class MessageUserApiController extends UserController
{
    /**
     * Initialize message controller.
     *
     * @param type MessageRepositoryInterface $message
     *
     * @return type
     */
    public function __construct(MessageRepositoryInterface $message)
    {
        $this->repository = $message;
        parent::__construct();
    }

    /**
     * Display a list of message.
     *
     * @return json
     */
    public function index(MessageUserApiRequest $request)
    {
        $messages  = $this->repository
            ->pushCriteria(new \Lavalite\Message\Repositories\Criteria\MessageUserCriteria())
            ->setPresenter('\\Lavalite\\Message\\Repositories\\Presenter\\MessageListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $messages['code'] = 2000;
        return response()->json($messages) 
            ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display message.
     *
     * @param Request $request
     * @param Model   Message
     *
     * @return Json
     */
    public function show(MessageUserApiRequest $request, Message $message)
    {

        if ($message->exists) {
            $message         = $message->presenter();
            $message['code'] = 2001;
            return response()->json($message)
                ->setStatusCode(200, 'SHOW_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Show the form for creating a new message.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(MessageUserApiRequest $request, Message $message)
    {
        $message         = $message->presenter();
        $message['code'] = 2002;
        return response()->json($message)
            ->setStatusCode(200, 'CREATE_SUCCESS');
    }

    /**
     * Create new message.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(MessageUserApiRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $message          = $this->repository->create($attributes);
            $message          = $message->presenter();
            $message['code']  = 2004;

            return response()->json($message)
                ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }

    }

    /**
     * Show message for editing.
     *
     * @param Request $request
     * @param Model   $message
     *
     * @return json
     */
    public function edit(MessageUserApiRequest $request, Message $message)
    {
        if ($message->exists) {
            $message         = $message->presenter();
            $message['code'] = 2003;
            return response()-> json($message)
                ->setStatusCode(200, 'EDIT_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }
    }

    /**
     * Update the message.
     *
     * @param Request $request
     * @param Model   $message
     *
     * @return json
     */
    public function update(MessageUserApiRequest $request, Message $message)
    {
        try {

            $attributes = $request->all();

            $message->update($attributes);
            $message         = $message->presenter();
            $message['code'] = 2005;

            return response()->json($message)
                ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the message.
     *
     * @param Request $request
     * @param Model   $message
     *
     * @return json
     */
    public function destroy(MessageUserApiRequest $request, Message $message)
    {

        try {

            $t = $message->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('message::message.name')]),
                'code'     => 2006
            ])->setStatusCode(202, 'DESTROY_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4006,
            ])->setStatusCode(400, 'DESTROY_ERROR');
        }
    }
}
