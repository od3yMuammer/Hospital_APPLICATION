<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::withTrashed()->get();
        return response()->view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        //
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('new_password'));
        $admin->remember_token = $request->input('_token');


        $isSaved = $admin->save();
        if ($isSaved) {
            // insert process to log
//            (new Process())->insert_log(request()->ip(), "إضافة مدير جديد", $admin->id, $admin->name);

            return back()
                ->with('success', 'تمت العملية بنجاح');
        } else {
            return back()
                ->with('danger', 'لم تتم العملية');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admin = Admin::findorFail($id);
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        //
        $admin = Admin::findorFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->new_password);
        $admin->save();
        // insert process to log
//        (new Process())->insert_log(request()->ip(), "تعديل بيانات مدير", $admin->id, $admin->name);


        return back()
            ->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // insert process to log
        $admin = Admin::find($id);
//        (new Process())->insert_log(request()->ip(), "حذف بيانات مدير", $admin->id, $admin->name);
        $admin->delete();
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $admin = Admin::withTrashed()->findorFail($id);
        // insert process to log
//        (new Process())->insert_log(request()->ip(), "حذف نهائي لبيانات مدير", $id,$admin->name);
        $admin->forceDelete();
        return back()
            ->with('error', 'تم حذف العنصر نهائيًا');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $admin = Admin::withTrashed()->findorFail($id);
        $admin->restore();
        // insert process to log
//        (new Process())->insert_log(request()->ip(), "استعادة بيانات مدير", $id, $admin->name);

        return back()
            ->with('success', 'تم استعادة العنصر بنجاح');
    }
}
