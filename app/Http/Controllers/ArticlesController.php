<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorearticleRequest;
use App\Http\Requests\UpdatAarticleRequest;
use App\Models\Article;
use App\Models\Categore;
use App\Models\City;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles = Article::withTrashed()->get();
        return response()->view('admin.articles.index', ["articles" => $articles]);
    }

    public function create()
    {
//        $cities=Section::withoutTrashed()
        $categories = Categore::all();
        return view('admin.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        //
        $article = new Article();
        $article->title = $request->input('title');
        $article->details = $request->input('details');
        $article->counter = $request->input('counter');
        $article->categore_id = $request->input('categore_id');

        $article->image = "";
        if ($request->hasFile('image')) {
            $image_path = time() . '.' . $request->image->extension();
            $request->image->move(public_path('article_images'), $image_path);
            $article->image = $image_path;
        }
        $isSaved = $article->save();
        if ($isSaved) {
//            (new Process())->insert_log(request()->ip(), "إضافة اسعاف جديد", $article->id, $article->title);

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
        $article = Article::findorFail($id);
        $categories = Categore::all();
        return view('admin.articles.edit', compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatAarticleRequest $request, $id)
    {
        $article = Article::findorFail($id);
        $article->title = $request->input('title');
        $article->details = $request->input('details');
        $article->counter = $request->input('counter');
        $article->categore_id = $request->input('categore_id');

        $article->image = "";
        if ($request->hasFile('image')) {
            $image_path = time() . '.' . $request->image->extension();
            $request->image->move(public_path('article_images'), $image_path);
            $article->image = $image_path;
        }
        $article->save();
//        (new Process())->insert_log(request()->ip(), "تعديل اسعاف مضاف", $article->id, $article->title);
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
        //$article = Article::findorFail($id);
        $article = Article::find($id);
        $article->delete();
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
        $article = Article::where('id', $id)->withTrashed();
        $article->forceDelete();
//        (new Process())->insert_log(request()->ip(), "حدف نهائي لاسعاف مضاف", $article->id, $article->name);

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
        $article = Article::withTrashed()->findorFail($id);
        $article->restore();
//        (new Process())->insert_log(request()->ip(), "استعادةاسعاف محذوف", $article->id, $article->title);
        return back()
            ->with('success', 'تم استعادة العنصر بنجاح');
    }
}
