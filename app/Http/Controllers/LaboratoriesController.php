<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaboratorieRequest;
use App\Http\Requests\UpdateLaboratorieRequest;
use App\Models\City;
use App\Models\Laboratorie;
use Illuminate\Http\Request;

class LaboratoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $laboratories = Laboratorie::withTrashed()->get();
        return response()->view('admin.laboratories.index', ["laboratories" => $laboratories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $cities=City::withoutTrashed();
        $cities = City::all();
        return view('admin.laboratories.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaboratorieRequest $request)
    {
        //
        $laboratorie = new Laboratorie();
        $laboratorie->name = $request->input('name');
        $laboratorie->address = $request->input('address');
        $laboratorie->phone = $request->input('phone');
        $laboratorie->telephone = $request->input('telephone');
        $laboratorie->map = $request->input('map');
        $laboratorie->extra = $request->input('extra');
        $laboratorie->city_id = $request->input('city_id');


        $isSaved = $laboratorie->save();
        if ($isSaved) {
//            (new Process())->insert_log(request()->ip(), "إضافة منشور جديد", $laboratorie->id, $laboratorie->title);

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
        $laboratorie = Laboratorie::findorFail($id);
        $cities = City::all();
        return view('admin.laboratories.edit', compact('laboratorie','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLaboratorieRequest $request, $id)
    {
        $laboratorie = Laboratorie::findorFail($id);
        $laboratorie->name = $request->input('name');
        $laboratorie->address = $request->input('address');
        $laboratorie->phone = $request->input('phone');
        $laboratorie->telephone = $request->input('telephone');
        $laboratorie->map = $request->input('map');
        $laboratorie->extra = $request->input('extra');
        $laboratorie->city_id = $request->input('city_id');

        $laboratorie->save();
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
        //$laboratorie = Laboratorie::findorFail($id);
        $laboratorie = Laboratorie::find($id);
        $laboratorie->delete();
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
        $laboratorie = Laboratorie::where('id', $id)->withTrashed();
        $laboratorie->forceDelete();


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
        $laboratorie = Laboratorie::withTrashed()->findorFail($id);
        $laboratorie->restore();

        return back()
            ->with('success', 'تم استعادة العنصر بنجاح');
    }
}
