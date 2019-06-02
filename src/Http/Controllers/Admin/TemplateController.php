<?php

namespace Mekaeil\LaravelNotification\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mekaeil\LaravelNotification\Entities\NotificationTemplate;
use Mekaeil\LaravelNotification\Http\Requests\Admin\StoreTemplate;
use Mekaeil\LaravelNotification\Entities\NotificationType;
use Mekaeil\LaravelNotification\Http\Requests\Admin\UpdateTemplate;

class TemplateController extends Controller
{

    public function index(Request $request)
    {
        $pagination = $request->page ?? config('project.base.admin_pagination_count');
        $templates  = NotificationTemplate::paginate($pagination);

        return fresponse(
            [ 'templates' => $templates],
            'لیست تمپلت‌ها'
        );
    }

    public function store(StoreTemplate $request)
    {
        $type = NotificationType::where('name', $request->type)->first();

        $template = NotificationTemplate::create([
            'type_id'       => $type->id,
            'name'          => $request->name,
            'display_name'  => $request->display_name,
            'status'        => $request->status,
            'class_name'    => $request->class_name,
            'can_delete'    => $request->can_delete,
            'data'          => $request->data,
        ]);

        return fresponse(
            ['template' => $template],
            'قالب با موفقیت ایجاد شد.'
        );
    }

    public function update(UpdateTemplate $request, NotificationTemplate $template)
    {
        $type = NotificationType::where('name', $request->type)->first();

        $template->update([
            'type_id'       => $type->id,
            'name'          => $request->name,
            'display_name'  => $request->display_name,
            'status'        => $request->status,
            'class_name'    => $request->class_name,
            'can_delete'    => $request->can_delete,
            'data'          => $request->data,
        ]);

        return fresponse(
            ['template' => $template],
            'قالب با موفقیت ویرایش شد.'
        );
    }

    public function destroy( NotificationTemplate $template)
    {
        $templateName = $template->name;
        $template->delete();

        return fresponse(
            '',
            "قالب $templateName با موفقیت حذف شد."
        );
    }
}
