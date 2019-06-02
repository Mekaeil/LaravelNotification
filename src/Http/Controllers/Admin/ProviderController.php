<?php

namespace Mekaeil\LaravelNotification\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mekaeil\LaravelNotification\Entities\NotificationProvider;
use Mekaeil\LaravelNotification\Http\Requests\Admin\StoreProvider;
use Mekaeil\LaravelNotification\Entities\NotificationType;
use Mekaeil\LaravelNotification\Http\Requests\Admin\UpdateProvider;

class ProviderController extends Controller
{

    public function index(Request $request)
    {
        $pagination = $request->page ?? config('project.base.admin_pagination_count');
        $providers   = NotificationProvider::paginate($pagination);

        return fresponse(
            ['providers' => $providers],
            'لیست پروایدرها'
        );
    }

    public function store(StoreProvider $request)
    {
        $type = NotificationType::where('name', $request->type)->first();

        $provider = NotificationProvider::create([
            'name'          => $request->name,
            'display_name'  => $request->display_name,
            'type_id'       => $type->id,
            'class_name'    => $request->class_name,
            'status'        => $request->status,
            'data'          => $request->data,
        ]);

        return fresponse(
            $provider,
            'پروایدر با موفقیت ایجاد شد.'
        );
    }

    public function update(UpdateProvider $request, NotificationProvider $provider)
    {
        $type = NotificationType::where('name', $request->type)->first();

        $provider->update([
            'name'          => $request->name,
            'display_name'  => $request->display_name,
            'type_id'       => $type->id,
            'class_name'    => $request->class_name,
            'status'        => $request->status,
            'data'          => $request->data,
        ]);

        return fresponse(
            $provider,
            'پروایدر با موفقیت ویرایش شد.'
        );
    }

    public function destroy(NotificationProvider $provider)
    {
        $providerName = $provider->name;
        $provider->delete();

        return fresponse(
            '',
            "پروایدر $providerName با موفقیت حذف شد."
        );
    }
}
