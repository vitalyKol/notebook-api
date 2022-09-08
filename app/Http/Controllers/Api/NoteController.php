<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteCollection;
use App\Http\Resources\NoteResource;
use App\Models\Note;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();
        return new NoteCollection(Note::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'fio' => ['required', 'string'],
            'company' => 'string',
            'number' => ['required', 'string'],
            'email' => ['required', 'email'],
            'birthday' => 'date',
            'picture' => 'image',
        ]);
        if($validator->fails()){
            $err = json_encode($validator->errors());
            return response($err, 405)->header('Content-type', 'application/json');
        }
        $note = Note::create($input);
        return new NoteResource($note);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::find($id);
        if(!$note){
            return  response('Note is not found', 404)->header('Content-type', 'application/json');
        }
        return new NoteResource($note);
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
        $note = Note::find($id);
        if(!$note){
            return  response('Note is not found', 404)->header('Content-type', 'application/json');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'fio' => 'string',
            'company' => 'string',
            'number' => 'string',
            'email' => 'email',
            'birthday' => 'date',
            'picture' => 'image',
        ]);
        if($validator->fails()){
            $err = json_encode($validator->errors());
            return response($err, 405)->header('Content-type', 'application/json');
        }

        $note->fill($request->except(['id']));
        $note->save();
        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        if(!$note){
            return  response('Note is not found', 404)->header('Content-type', 'application/json');
        }
        $note->delete();
        return json_encode('Note deleted successfully.');
    }
}
