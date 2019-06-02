<?php

namespace Mekaeil\LaravelNotification\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationChannel extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|unique:notification_channels,name,' . $this->channel->id,
            'display_name'  => 'required|string',
            'description'   => 'nullable',
            'status'        => 'required|boolean',
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
