<?php

namespace Lavalite\Message\Repositories\Presenter;

use Litepie\Database\Presenter\FractalPresenter;

class MessageListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MessageListTransformer();
    }
}