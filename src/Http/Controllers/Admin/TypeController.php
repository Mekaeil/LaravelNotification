<?php

namespace Mekaeil\LaravelNotification\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mekaeil\LaravelNotification\Entities\NotificationType;
use Mekaeil\LaravelNotification\Http\Requests\Admin\StoreTemplateType;
use Mekaeil\LaravelNotification\Http\Requests\Admin\UpdateTemplateType;

class TypeController extends Controller
{

    public function index(Request $request)
    {
        $pagination = $request->page ?? config('project.base.admin_pagination_count');
        $types      = NotificationType::paginate($pagination);

        return fresponse(
            ['types' => $types],
            'لیست نوع اعلانات'
        );
    }

    public function store(StoreTemplateType $request)
    {
        $type = NotificationType::create([
            'name'          =>  $request->name,
            'display_name'  => $request->display_name,
        ]);

        return fresponse(
            $type,
            'نوع اعلان با موفقیت ایجاد شد.'
        );
    }

    public function update(UpdateTemplateType $request, NotificationType $type)
    {
        $type->update([
            'name'          =>  $request->name,
            'display_name'  => $request->display_name,
        ]);

        return fresponse(
            $type,
            'نوع اعلان با موفقیت ویرایش شد.'
        );
    }

    public function destroy(NotificationType $type)
    {
        $typeName = $type->name;
        $type->delete();

        return fresponse(
            '',
            "نوع اعلان با نام $typeName با موفقیت حذف شد."
        );

    }

}
