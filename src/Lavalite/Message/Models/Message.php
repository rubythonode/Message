<?php

namespace Lavalite\Message\Models;

use Lavalite\Filer\FilerTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    use FilerTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Initialiaze page modal
     *
     * @param $name
     */
    public function __construct()
    {
        parent::__construct();
        $this->initialize();
    }

    /**
     * Initialize the modal variables.
     *
     * @return void
     */
    public function initialize()
    {
        $this->fillable             = config('message.message.fillable');
        $this->uploads              = config('message.message.uploadable');
        $this->uploadRootFolder     = config('message.message.upload_root_folder');
        $this->table                = config('message.message.table');
    }

}
