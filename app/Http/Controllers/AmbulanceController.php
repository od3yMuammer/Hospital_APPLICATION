<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAmbulanceRequest;
use App\Http\Requests\UpdatAambulanceRequest;
use App\Models\Ambulance;
use App\Models\City;
use App\Models\Process;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ambulances = ambulance::withTrashed()->get();
        return response()->view('admin.ambulances.index', ["ambulances" => $ambulances]);
    }

    public function create()
    {
//        $cities=Section::withoutTrashed()
        $cities = City::all();
        return view('admin.ambulances.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAmbulanceRequest $request)
    {
        //
        $ambulance = new ambulance();
        $ambulance->driver = $request->input('driver');
        $ambulance->address = $request->input('address');
        $ambulance->phone = $request->input('phone');
        $ambulance->counter = $request->input('counter');
        $ambulance->city_id = $request->input('city_id');

        $ambulance->image = "";
        if ($request->hasFile('image')) {
            $image_path = time() . '.' . $request->image->extension();
            $request->image->move(public_path('ambulance_images'), $image_path);
            $ambulance->image = $image_path;
        }
        $isSaved = $ambulance->save();
        if ($isSaved) {
//            (new Process())->insert_log(request()->ip(), "إضافة اسعاف جديد", $ambulance->id, $ambulance->driver);

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
        $ambulance = ambulance::findorFail($id);
        $cities = City::all();
        return view('admin.ambulances.edit', compact('ambulance','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatAambulanceRequest $request, $id)
    {
        $ambulance = ambulance::findorFail($id);
        $ambulance->driver = $request->input('driver');
        $ambulance->address = $request->input('address');
        $ambulance->phone = $request->input('phone');
        $ambulance->counter = $request->input('counter');
        $ambulance->city_id = $request->input('city_id');

        $ambulance->image = "";
        if ($request->hasFile('image')) {
            $image_path = time() . '.' . $request->image->extension();
            $request->image->move(public_path('ambulance_images'), $image_path);
            $ambulance->image = $image_path;
        }
        $ambulance->save();
//        (new Process())->insert_log(request()->ip(), "تعديل اسعاف مضاف", $ambulance->id, $ambulance->driver);
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
        //$ambulance = ambulance::findorFail($id);
        $ambulance = ambulance::find($id);
        $ambulance->delete();
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
        $ambulance = ambulance::where('id', $id)->withTrashed();
        $ambulance->forceDelete();
//        (new Process())->insert_log(request()->ip(), "حدف نهائي لاسعاف مضاف", $ambulance->id, $ambulance->name);

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
        $ambulance = ambulance::withTrashed()->findorFail($id);
        $ambulance->restore();
//        (new Process())->insert_log(request()->ip(), "استعادةاسعاف محذوف", $ambulance->id, $ambulance->driver);
        return back()
            ->with('success', 'تم استعادة العنصر بنجاح');
    }
}
