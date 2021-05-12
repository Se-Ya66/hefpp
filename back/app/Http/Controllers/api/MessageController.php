<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        
        // $message = new Message;
        // $user = User::find($id);
        // $request->user()->send()->attach($user);
        // $message->fill($request->all());
        // $message->save();

        $message = new Message;
        $user = User::find($id);
        $message->fill($request->all());
        $message->send_id = $request->user()->id;
        $message->receive_id = $user->id;
        $message->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $send_id = $request->user()->id;
        $query =  Message::where(function($query) use ($send_id, $id) {
            $query->where('send_id',$send_id)
                ->Where('recieve_id', $id); 
        })->orwhere(function($query) use ($send_id, $id) {
            $query->where('recieve_id',$send_id)
                ->Where('send_id', $id);
        });
        $messages = $query->get();
        return $messages;
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }

    public function send(MessageRequest $request, $id)
    {
        $message = new Message;
        $user = User::find($id);
        $message->fill($request->all());
        $message->send_id = $request->user()->id;
        $message->recieve_id = $user->id;
        $message->save();

    }

    public function sendings ($id)
    {
        $user = User::find($id);
        return [
            'user' =>$user->sendings
        ];
    }
}
