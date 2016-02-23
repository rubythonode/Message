<?php

namespace Lavalite\Message\Http\Requests;

use App\Http\Requests\Request;
use Gate;

class MessageAdminRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(\Illuminate\Http\Request $request)
    {
        $message = $this->route('message');
        // Determine if the user is authorized to access message module,
        if (is_null($message)) {
            return $request->user()->canDo('message.message.view');
        }

        // Determine if the user is authorized to create an entry,
        if ($request->isMethod('POST') || $request->is('*/create')) {
            return Gate::allows('create', $message);
        }

        // Determine if the user is authorized to update an entry,
        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
            return Gate::allows('update', $message);
        }

        // Determine if the user is authorized to delete an entry,
        if ($request->isMethod('DELETE')) {
            return Gate::allows('delete', $message);
        }

        // Determine if the user is authorized to view the module.
        return Gate::allows('view', $message);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(\Illuminate\Http\Request $request)
    {
        // validation rule for create request.
        if ($request->isMethod('POST')) {
            return [
                'to'    => 'required',
              
            ];
        }

        // Validation rule for update request.
        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            return [
            ];
        }

        // Default validation rule.
        return [

        ];
    }
}
