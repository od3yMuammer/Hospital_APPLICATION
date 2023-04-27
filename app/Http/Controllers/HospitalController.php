<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use App\Models\hospital;
use App\Models\City;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        //
        $hospitals = Hospital::withTrashed()->get();
        return response()->view('admin.hospitals.index', ["hospitals" => $hospitals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $cities=City::withoutTrashed()
        $cities = City::all();
        return view('admin.hospitals.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHospitalRequest $request)
    {
        //
        $hospital = new Hospital();
        $hospital->name = $request->input('name');
        $hospital->address = $request->input('address');
        $hospital->phone = $request->input('phone');
        $hospital->telephone = $request->input('telephone');
        $hospital->map = $request->input('map');
        $hospital->extra = $request->input('extra');
        $hospital->city_id = $request->input('city_id');

        $hospital->image = "";
        if ($request->hasFile('image')) {
            $image_path = time() . '.' . $request->image->extension();
            $request->image->move(public_path('hospital_images'), $image_path);
            $hospital->image = $image_path;
        }
        $isSaved = $hospital->save();
        if ($isSaved) {
//            (new Process())->insert_log(request()->ip(), "إضافة منشور جديد", $hospital->id, $hospital->title);

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
        $hospital = Hospital::findorFail($id);
        $cities = City::all();
        return view('admin.hospitals.edit', compact('hospital','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHospitalRequest $request, $id)
    {
        $hospital = Hospital::findorFail($id);
        $hospital->name = $request->input('name');
        $hospital->address = $request->input('address');
        $hospital->phone = $request->input('phone');
        $hospital->telephone = $request->input('telephone');
        $hospital->map = $request->input('map');
        $hospital->extra = $request->input('extra');
        $hospital->city_id = $request->input('city_id');

        $hospital->image = "";
        if ($request->hasFile('image')) {
            $image_path = time() . '.' . $request->image->extension();
            $request->image->move(public_path('hospital_images'), $image_path);
            $hospital->image = $image_path;
        }
        $hospital->save();
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
        //$hospital = Hospital::findorFail($id);
        $hospital = Hospital::find($id);
        $hospital->delete();
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
        $hospital = Hospital::where('id', $id)->withTrashed();
        $hospital->forceDelete();


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
        $hospital = Hospital::withTrashed()->findorFail($id);
        $hospital->restore();

        return back()
            ->with('success', 'تم استعادة العنصر بنجاح');
    }
}
