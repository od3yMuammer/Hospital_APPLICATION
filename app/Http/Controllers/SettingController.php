<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingsRequest;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $settings = Setting::get();
        return response()->view('admin.settings.index', ["settings" => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingsRequest $request)
    {
        //
        $setting = new Setting();
        $setting->facebook = $request->input('facebook');
        $setting->site_name = $request->input('site_name');
        $setting->youtube = $request->input('youtube');
        $setting->whatsapp = $request->input('whatsapp');
        $setting->instagram = $request->input('instagram');
        $setting->telegram = $request->input('telegram');

        $setting->logo = "";
        if ($request->hasFile('logo')) {
            $logo_path = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('Setting_logos'), $logo_path);
            $setting->logo = $logo_path;
        }
        $isSaved = $setting->save();
        if ($isSaved) {
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
        $setting = Setting::findorFail($id);
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingsRequest $request, $id)
    {
        $setting = Setting::findorFail($id);
        $setting->facebook = $request->input('facebook');
        $setting->site_name = $request->input('site_name');
        $setting->youtube = $request->input('youtube');
        $setting->whatsapp = $request->input('whatsapp');
        $setting->instagram = $request->input('instagram');
        $setting->telegram = $request->input('telegram');

        if ($request->hasFile('logo')) {
            $logo_path = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('setting_logos'), $logo_path);
            $setting->logo = $logo_path;
        }
        $setting->save();
        // insert process to log
//        (new Process())->insert_log(request()->ip(), "تعديل إعدادات الموقع", 1, "الاعدادات");
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
        //$setting = Setting::findorFail($id);
        $setting = Setting::find($id);
        $setting->delete();
        return back();
    }

}

