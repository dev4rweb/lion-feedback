<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function showDialog(Request $request)
    {
        try {
            $currentUser = User::findOrFail($request['currentUserId']);
            $user = User::findOrFail($request['userId']);
            $inMsg = Message::where('from', $user->id)
                ->where('to', $currentUser->id)->get();
            $outMsg = Message::where('from', $currentUser->id)
                ->where('to', $user->id)->get();

            $messages = $inMsg->merge($outMsg);
            $messages = $messages->sortBy('created_at');
            $response['success'] = true;
            $response['message'] = 'Messages dialog';
            $response['currentUser'] = $currentUser;
            $response['user'] = $user;
            $response['models'] = $messages;
        } catch (\Exception $exception) {
            $response['success'] = false;
            $response['message'] = $exception->getMessage();
        }

        return response()->json($response);
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
}
