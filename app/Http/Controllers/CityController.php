<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Models\Ambulance;
use App\Models\Process;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {

        $cities = City::withTrashed()->get();
        return response()->view('admin.cities.index', compact('cities'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        //
        $city = new City();
        $city->name = $request->input('name');
        $isSaved = $city->save();
        if ($isSaved) {
//            (new Process())->insert_log(request()->ip(), "إضافة مدينة جديدة", $city->id, $city->name);

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
        $city = City::findorFail($id);
        return view('admin.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, $id)
    {
        $city = City::findorFail($id);
        $city->name = $request->name;
        $city->save();
//        (new Process())->insert_log(request()->ip(), "نعديل مدينة مضافة", $city->id, $city->name);

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
        //$post = City::findorFail($id);
        $city = City::find($id);
        $city->delete();
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
        $city = City::where('id', $id)->withTrashed();
        $city->forceDelete();

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
        $city = City::withTrashed()->findorFail($id);
        $city->restore();
//        (new Process())->insert_log(request()->ip(), "استعادة مدينة محذوفة", $city->id, $city->name);

        return back()
            ->with('success', 'تم استعادة العنصر بنجاح');
    }
}
