<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoreRequest;
use App\Http\Requests\UpdatecategoreRequest;
use App\Models\Categore;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Categore::withTrashed()->get();
        return response()->view('admin.categories.index', ["categories" => $categories]);
    }

    public function create()
    {
//
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoreRequest $request)
    {
        //
        $categore = new Categore();
        $categore->name = $request->input('name');
        $categore->picture = "";
        if ($request->hasFile('picture')) {
            $picture_path = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('categore_pictures'), $picture_path);
            $categore->picture = $picture_path;
        }
        $isSaved = $categore->save();
        if ($isSaved) {
//            (new Process())->insert_log(request()->ip(), "إضافة اسعاف جديد", $categore->id, $categore->driver);

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
        $categore = Categore::findorFail($id);
        return view('admin.categories.edit', compact('categore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoreRequest $request, $id)
    {
        $categore = Categore::findorFail($id);
        $categore->name = $request->input('name');

        $categore->picture = "";
        if ($request->hasFile('picture')) {
            $picture_path = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('categore_pictures'), $picture_path);
            $categore->picture = $picture_path;
        }
        $categore->save();
//        (new Process())->insert_log(request()->ip(), "تعديل اسعاف مضاف", $categore->id, $categore->driver);
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
        //$categore = Categore::findorFail($id);
        $categore = Categore::find($id);
        $categore->delete();
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
        $categore = Categore::where('id', $id)->withTrashed();
        $categore->forceDelete();
//        (new Process())->insert_log(request()->ip(), "حدف نهائي لاسعاف مضاف", $categore->id, $categore->name);

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
        $categore = Categore::withTrashed()->findorFail($id);
        $categore->restore();
//        (new Process())->insert_log(request()->ip(), "استعادةاسعاف محذوف", $categore->id, $categore->driver);
        return back()
            ->with('success', 'تم استعادة العنصر بنجاح');
    }
}
