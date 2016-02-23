<?php

namespace Lavalite\Message\Http\Controllers;

use App\Http\Controllers\UserController as UserController;
use Former;
use Lavalite\Message\Http\Requests\MessageUserRequest;
use Lavalite\Message\Interfaces\MessageRepositoryInterface;

/**
 *
 */
class MessageUserController extends UserController
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
        $this->model = $message;
        $this->model->pushCriteria(new \Lavalite\Message\Repositories\Criteria\UserCriteria());
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(MessageUserRequest $request)
    {
        dd($this->model->paginate());
        $this->theme->prependTitle(trans('message::message.names').' :: ');

        return $this->theme->of('message::admin.message.index')->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(MessageUserRequest $request, $id)
    {
        $message = $this->model->find($id);

        if (empty($message)) {
            if ($request->wantsJson()) {
                return [];
            }

            return view('message::admin.message.new');
        }

        if ($request->wantsJson()) {
            return $message;
        }

        Form::populate($message);

        return view('message::admin.message.show', compact('message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MessageUserRequest $request)
    {
        $message = $this->model->findOrNew(0);

        Form::populate($message);

        return view('message::admin.message.create', compact('message'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MessageUserRequest $request)
    {
        try {
            $attributes = $request->all();
            $message = $this->model->create($attributes);

            return $this->success(trans('messages.success.created', ['Module' => 'Message']));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function edit(MessageUserRequest $request, $id)
    {
        $message = $this->model->find($id);

        Form::populate($message);

        return view('message::admin.message.edit', compact('message'));
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(MessageUserRequest $request, $id)
    {
        try {
            $attributes = $request->all();
            $message = $this->model->update($attributes, $id);

            return $this->success(trans('messages.success.updated', ['Module' => 'Message']));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(MessageUserRequest $request, $id)
    {
        try {
            $this->model->delete($id);

            return $this->success(trans('messages.success.deleted', ['Module' => 'Message']));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
