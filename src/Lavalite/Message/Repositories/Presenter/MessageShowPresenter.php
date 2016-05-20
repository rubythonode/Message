<?php

namespace Lavalite\Message\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class MessageShowPresenter extends FractalPresenter
{

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MessageShowTransformer();
    }
}
