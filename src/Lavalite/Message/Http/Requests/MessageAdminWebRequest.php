<?php

namespace Lavalite\Message\Http\Requests;

use App\Http\Requests\Request;

class MessageAdminWebRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(\Illuminate\Http\Request $request)
    {
        $message = $this->route('message');

        if (is_null($message)) {
            // Determine if the user is authorized to access message module,
            return $request->user('admin.web')->canDo('message.message.view');
        }

        if ($request->isMethod('POST') || $request->is('*/create')) {
            // Determine if the user is authorized to create an entry,
            return $request->user('admin.web')->can('create', $message);
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
            // Determine if the user is authorized to update an entry,
            return $request->user('admin.web')->can('update', $message);
        }

        if ($request->isMethod('DELETE')) {
            // Determine if the user is authorized to delete an entry,
            return $request->user('admin.web')->can('delete', $message);
        }

        // Determine if the user is authorized to view the module.
        return $request->user('admin.web')->can('view', $message);
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
                'to' => 'required',

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
