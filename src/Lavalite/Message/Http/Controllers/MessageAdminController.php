<?php

namespace Lavalite\Message\Http\Controllers;

use App\Http\Controllers\AdminController as AdminController;
use Former;
use Lavalite\Message\Http\Requests\MessageRequest;
use Lavalite\Message\Interfaces\MessageRepositoryInterface;
use Response;

/**
 *
 */
class MessageAdminController extends AdminController
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
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(MessageRequest $request)
    {
        $this->theme->prependTitle(trans('message::message.names').' :: ');

        return $this->theme->of('message::admin.message.index')->render();
    }

    /**
     * Return list of message as json.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function lists(MessageRequest $request)
    {
        $array = $this->model->json();
        foreach ($array as $key => $row) {
            $array[$key] = array_only($row, config('package.message.message.listfields'));
        }

        return ['data' => $array];
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(MessageRequest $request, $id)
    {
        $message = $this->model->findOrNew($id);

        Former::populate($message);

        return view('message::admin.message.show', compact('message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MessageRequest $request)
    {
        $message = $this->model->findOrNew(0);
        Former::populate($message);

        return view('message::admin.message.create', compact('message'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MessageRequest $request)
    {
        if ($row = $this->model->create($request->all())) {
            return Response::json(['message' => 'Message created sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } else {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
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
    public function edit(MessageRequest $request, $id)
    {
        $message = $this->model->find($id);

        Former::populate($message);

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
    public function update(MessageRequest $request, $id)
    {
        if ($row = $this->model->update($request->all(), $id)) {
            return Response::json(['message' => 'Message updated sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } else {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(MessageRequest $request, $id)
    {
        try {
            $this->model->delete($id);

            return Response::json(['message' => 'Message deleted sucessfully'.$id, 'type' => 'success', 'title' => 'Success'], 201);
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }
}
