<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $messages = Message::all();
        return response()->view('admin.messages.index',compact('messages'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $settings = setting::where('id', 1)->first();
        return response()->view('web.contact',compact('settings'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        //
        $message = new Message();
        $message->sender_name = $request->input('sender_name');
        $message->sender_email = $request->input('sender_email');
        $message->sender_phone = $request->input('sender_phone');
        $message->message_text = $request->input('message_text');
        $message->ip = request()->ip();

        $isSaved = $message->save();
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
        $message = Message::where('id', $id)->first();
        return response()->view('admin.messages.show',compact('message'));
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
        $member = Message::find($id);
//        (new Process())->insert_log(request()->ip(), "حذف رسالة", $id,$member->name);
        $member->delete();
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
        $member = Message::where('id', $id)->withTrashed();
//        (new Process())->insert_log(request()->ip(), "حذف نهائي لرسالة", $id,$member->name);
        $member->forceDelete();


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
        $member = Message::withTrashed()->findorFail($id);
//        (new Process())->insert_log(request()->ip(), "استعادة رسالة", $id,$member->name);
        $member->restore();

        return back()
            ->with('success', 'تم استعادة العنصر بنجاح');
    }
    public function contact()
    {
        $settings = setting::find(1);
        return view('web.contact', compact('settings'));
    }
}
