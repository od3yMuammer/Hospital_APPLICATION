<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdatAMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $majors = Major::withTrashed()->get();
        return response()->view('admin.majors.index', ["majors" => $majors]);
    }

    public function create()
    {
//
        return view('admin.majors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMajorRequest $request)
    {
        //
        $major = new Major();
        $major->name = $request->input('name');
        $major->picture = "";
        if ($request->hasFile('picture')) {
            $picture_path = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('major_pictures'), $picture_path);
            $major->picture = $picture_path;
        }
        $isSaved = $major->save();
        if ($isSaved) {
//            (new Process())->insert_log(request()->ip(), "إضافة اسعاف جديد", $major->id, $major->driver);

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
        $major = Major::findorFail($id);
        return view('admin.majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMajorRequest $request, $id)
    {
        $major = Major::findorFail($id);
        $major->name = $request->input('name');

        $major->picture = "";
        if ($request->hasFile('picture')) {
            $picture_path = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('major_pictures'), $picture_path);
            $major->picture = $picture_path;
        }
        $major->save();
//        (new Process())->insert_log(request()->ip(), "تعديل اسعاف مضاف", $major->id, $major->driver);
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
        //$major = Major::findorFail($id);
        $major = Major::find($id);
        $major->delete();
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
        $major = Major::where('id', $id)->withTrashed();
        $major->forceDelete();
//        (new Process())->insert_log(request()->ip(), "حدف نهائي لاسعاف مضاف", $major->id, $major->name);

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
        $major = Major::withTrashed()->findorFail($id);
        $major->restore();
//        (new Process())->insert_log(request()->ip(), "استعادةاسعاف محذوف", $major->id, $major->driver);
        return back()
            ->with('success', 'تم استعادة العنصر بنجاح');
    }
}

