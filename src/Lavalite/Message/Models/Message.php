<?php

namespace Lavalite\Message\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lavalite\Filer\FilerTrait;

class Message extends Model
{
    use FilerTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Initialiaze page modal.
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
        $this->fillable = config('package.message.message.fillable');
        $this->uploads = config('package.message.message.uploadable');
        $this->uploadRootFolder = config('package.message.message.upload_root_folder');
        $this->table = config('package.message.message.table');
    }
}
