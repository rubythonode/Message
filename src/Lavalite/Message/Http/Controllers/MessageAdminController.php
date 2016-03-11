<?php

namespace Lavalite\Message\Http\Controllers;

use App\Http\Controllers\AdminController as AdminController;
use Form;
use Lavalite\Message\Http\Requests\MessageAdminRequest;
use Lavalite\Message\Interfaces\MessageRepositoryInterface;
use Lavalite\Message\Models\Message;
use User;
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
    public function index(MessageAdminRequest $request)
    {
        // $messages  = $this->model->setPresenter('\\Lavalite\\Message\\Repositories\\Presenter\\MessageListPresenter')->paginate(NULL, ['*']);
        $this   ->theme->prependTitle(trans('message::message.names').' :: ');
        $view   = $this->theme->of('message::admin.message.index')->render();

        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Message']);
        // $this->responseData = $messages['data'];
        // $this->responseMeta = $messages['meta'];
        $this->responseView = $view;
        $this->responseRedirect = '';
        return $this->respond($request);
    }

  
    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(MessageAdminRequest $request,Message $message)
    {    
        if (!$message->exists) {
            $this->responseCode = 404;
            $this->responseMessage = trans('messages.success.notfound', ['Module' => 'Message']);
            $this->responseData = $message;
            $this->responseView = view('message::admin.message.new');
            return $this -> respond($request);
        }
        $messages['data'] = $this->model->findByStatus($status);
        $messages['caption'] = $status;


        Form::populate($message);
        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Message']);
        $this->responseData = $message;
        // $this->responseView = view('message::admin.message.show', compact('message'));
        $this->responseView = view('message::admin.message.show', compact('messages'));
        return $this -> respond($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MessageAdminRequest $request)
    {
        $message = $this->model->newInstance([]);

        Form::populate($message);

        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Message']);
        $this->responseData = $message;
        $this->responseView = view('message::admin.message.create', compact('message'));
        return $this -> respond($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MessageAdminRequest $request)
    { 
       try {
            $attributes = $request->all();
            $attributes['user_id'] =User::users('id');
            $message = $this->model->create($attributes);
            if($message->to == User::users('email')){
              $attributes['status'] ="Inbox";
              $message1 = $this->model->create($attributes);
            }

            $flag = 0;
            foreach (User::usersWithRole('admin') as $key => $value) {
                if ($value->email == $request->get('to')){
                    $flag = 1;
                    break;
                } 
            }

            if ($flag == 0) {
                // Event::fire('message.sendMail', [$attributes]);
                return;
            } 

            $this->responseCode = 201;
            $this->responseMessage = trans('messages.success.created', ['Module' => 'Message']);
            $this->responseData = $message;
            $this->responseMeta = '';
            $this->responseRedirect = trans_url('/admin/message/message/'.$message->getRouteKey());
            $this->responseView = view('message::admin.message.create', compact('message'));

            return $this -> respond($request);

        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            return $this -> respond($request);
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
    public function edit(MessageAdminRequest $request, Message $message)
    {
        Form::populate($message);
        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Message']);
        $this->responseData = $message;
        $this->responseView = view('message::admin.message.edit', compact('message'));

        return $this -> respond($request);
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(MessageAdminRequest $request, Message $message)
    { 
        try {

            $attributes = $request->all();
            $message->update($attributes);

            $this->responseCode = 204;
            $this->responseMessage = trans('messages.success.updated', ['Module' => 'Message']);
            $this->responseData = $message;
            $this->responseMeta = '';

            $this->responseRedirect = trans_url('/admin/message/message/'.$message->getRouteKey());
            return $this -> respond($request);

        } catch (Exception $e) {

            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            $this->responseRedirect = trans_url('/admin/message/message/'.$message->getRouteKey());

            return $this -> respond($request);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(MessageAdminRequest $request, Message $message)
    {
            try {
                if (!empty($request->get('arrayIds'))) {
                    $ids = $request->get('arrayIds');
                    $t = $this->model->deleteMultiple($ids);
                    return $t;
                }else{
                    $t = $message->delete();
                }

            $this->responseCode = 202;
            $this->responseMessage = trans('messages.success.deleted', ['Module' => 'Message']);
            $this->responseData = $message;
            $this->responseMeta = '';
            $this->responseRedirect = trans_url('/admin/message/message/0');

            return $this -> respond($request);

        } catch (Exception $e) {

            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            $this->responseRedirect = trans_url('/admin/message/message/'.$message->getRouteKey());

            return $this -> respond($request);

        }
    }




    public function inbox(MessageAdminRequest $request)
    {
        $messages['data'] = $this->model->inbox();

        return view('message::admin.message.show', compact('messages'));
    }

    public function search(MessageAdminRequest $request, $slug = 'none', $status = 'Inbox')
    {

        $messages['data'] = $this->model->search($status, $slug);

        return view('message::admin.message.search', compact('messages'));
    }

    public function updateStatus(MessageAdminRequest $request, Message $message, $status)
    {

        try {
            $Ids = $request->get('data');
            $attributes['status'] = $status;
            if($Ids != null)
            foreach ($Ids as $key => $id)
            //$record = $this->records->findOrFail($id);
            //$record = fill($attributes)->save();
                $this->model->update($attributes,$id);
            return ;
        } catch (Exception $e) {
          
            return $this->error($e->getMessage());
        }
        
    }

   
   public function showMessage($status)
    { 
        $messages['data'] = $this->model->findByStatus($status);
        $messages['caption'] = $status;
        return view('message::admin.message.show', compact('messages'));
    }

     public function getDetails($caption,$id)
    { 
        $message = $this->model->getDetails($id);
        $message['caption'] =$caption;
        return view('message::admin.message.details', compact('message'));
    }

    public function reply($id)
    { 
        $message = $this->model->getDetails($id);
        return view('message::admin.message.reply',compact('message'));
    }

    public function forward($id)
    { 
        $message = $this->model->getDetails($id);
        
        return view('message::admin.message.forward',compact('message'));
    }
   /*   public function compose()
    { 
        return view('message::admin.message.compose');
    }*/
    public function changeSubStatus(MessageAdminRequest $request, Message $message)
    { 
       try {
            $id = $request->get('id');
            $sub = $request->get('star');
            $attributes['star'] = $sub;
            $this->model->update($attributes,$id);
            return;
          }
       catch (Exception $e) 
          {
          
            return $this->error($e->getMessage());
          }

    }

}
