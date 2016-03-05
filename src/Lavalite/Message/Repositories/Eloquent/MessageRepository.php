<?php

namespace Lavalite\Message\Repositories\Eloquent;

use Lavalite\Message\Interfaces\MessageRepositoryInterface;
use Litepie\Database\Eloquent\BaseRepository;
use User;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
         return config('package.message.message.model');
    }

    public function deleteMultiple($ids)
    {
        return $this->model->whereIn('id',$ids)->delete();
    }


     public function unread()
    {
        
        return $this->model->with('user')->whereStatus("Inbox")->where("read","=",NULL)->orderBy('id','DESC')->get();
    }

   /* public function unreadCount()
    { 
        return $this->model->with('user')->whereTo(User::users('email'))->whereSubStatus('unread')->count();
    }*/

	public function msgCount($slug)
    {
      
            return $this->model->with('user')
                                             ->whereStatus($slug)
                                             ->where("read","=",NULL)
                                             ->orderBy('id','DESC')
                                             ->count();
    }


    public function messages()
    {

        return $this->model->with('user')->whereTo(User::users('email'))->whereStatus('Sent')->orderBy('id','DESC')->take(10)->get();
    }

    public function search($status, $slug)
    {
        
        return $this->model->with('user')->where(function($query) use ($slug){
                                                if ($slug != 'none') {
                                                    $query->orWhere('subject','LIKE','%'.$slug.'%');
                                                    $query->orWhere('message','LIKE','%'.$slug.'%');
                                                    $query->orWhere('created_at','LIKE','%'.$slug.'%');
                                                }
                                             })
                                         ->whereStatus($status)
                                         ->orderBy('id','DESC')
                                         ->paginate(10);
    }

    public function findByStatus($status)
    {

        return $this->model->with('user')->whereStatus($status)->orderBy('id','DESC')->paginate(10);
    }

    public function inbox()
    {
        return $this->model->with('user')->whereTo(User::users('email'))->whereStatus('Sent')->orderBy('id','DESC')->paginate(10);
    }

    public function getDetails($id)
    {

        return $this->model->with('user')->whereId($id)->first();
    }

}
