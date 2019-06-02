<?php

namespace Mekaeil\LaravelNotification\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTemplate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      
        return [
            'type'          => 'required|exists:notification_types,name',
            'name'          => 'required|unique:notification_templates,name,' . $this->template->id,
            'display_name'  => 'required',
            'status'        => 'required|boolean',
            'class_name'    => 'required_without:data',
            'can_delete'    => 'required|boolean',
            'data'          => 'required_without:class_name',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
