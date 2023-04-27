<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoredoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Models\City;
use App\Models\Major;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $doctors = Doctor::withTrashed()->get();
        return response()->view('admin.doctors.index', ["doctors" => $doctors]);
    }

    public function create()
    {
//        $cities=Section::withoutTrashed()
        $cities = City::all();
        $majors = Major::all();
        return view('admin.doctors.create',compact('cities','majors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
    {
        //
        $doctor = new Doctor();
        $doctor->name = $request->input('name');
        $doctor->address = $request->input('address');
        $doctor->phone = $request->input('phone');
        $doctor->address = $request->input('address');
        $doctor->extra = $request->input('extra');
        $doctor->map = $request->input('map');
        $doctor->city_id = $request->input('city_id');
        $doctor->major_id = $request->input('major_id');

        $doctor->photo = "";
        if ($request->hasFile('photo')) {
            $photo_path = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('doctor_photo'), $photo_path);
            $doctor->photo = $photo_path;
        }
        $isSaved = $doctor->save();
        if ($isSaved) {
//            (new Process())->insert_log(request()->ip(), "إضافة اسعاف جديد", $doctor->id, $doctor->driver);

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
        $majors = Major::findorFail($id);
        $cities = City::all();
        return view('admin.doctors.edit', compact('majors','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, $id)
    {
        $doctor = Doctor::findorFail($id);
        $doctor->name = $request->input('name');
        $doctor->address = $request->input('address');
        $doctor->phone = $request->input('phone');
        $doctor->address = $request->input('address');
        $doctor->extra = $request->input('extra');
        $doctor->map = $request->input('map');
        $doctor->city_id = $request->input('city_id');
        $doctor->major_id = $request->input('major_id');

        $doctor->photo = "";
        if ($request->hasFile('photo')) {
            $photo_path = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('doctor_photo'), $photo_path);
            $doctor->photo = $photo_path;
        }
        $doctor->save();
//        (new Process())->insert_log(request()->ip(), "تعديل اسعاف مضاف", $doctor->id, $doctor->driver);
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
        //$doctor = Doctor::findorFail($id);
        $doctor = Doctor::find($id);
        $doctor->delete();
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
        $doctor = Doctor::where('id', $id)->withTrashed();
        $doctor->forceDelete();
//        (new Process())->insert_log(request()->ip(), "حدف نهائي لاسعاف مضاف", $doctor->id, $doctor->name);

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
        $doctor = Doctor::withTrashed()->findorFail($id);
        $doctor->restore();
//        (new Process())->insert_log(request()->ip(), "استعادةاسعاف محذوف", $doctor->id, $doctor->driver);
        return back()
            ->with('success', 'تم استعادة العنصر بنجاح');
    }
}
