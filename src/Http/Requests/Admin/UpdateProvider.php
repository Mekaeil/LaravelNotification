<?php

namespace Mekaeil\LaravelNotification\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProvider extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|unique:notification_providers,name,' . $this->provider->id,
            'display_name'  => 'required',
            'type'          => 'required|exists:notification_types,name',
            'class_name'    => 'nullable',
            'status'        => 'required|boolean',
            'data'          => 'nullable|array',    
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
