<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Note as NoteResources;

class NoteController extends BaseController
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->get();
        return $this->sendResponse(NoteResources::collection($notes), 'All notes shown successfully');
    }

    public function show($id)
    {
        $note = Note::find($id);
        if (is_null($note)) {
            return $this->sendError('Note not found');
        }
        return $this->sendResponse(new NoteResources($note), 'Note found');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/notes/', $newPhoto);
            $input['photo'] = 'uploads/notes/' . $newPhoto;
        }

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $user = Auth::user();
        $input['user_id'] = $user->id;
        $note = Note::create($input);
        return $this->sendResponse(new NoteResources($note), 'Note created successfully');
    }

    public function update(Request $request, Note $note)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();
        return $this->sendResponse(new NoteResources($note), 'Note updated successfully');
    }

    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete($id);
        return $this->sendResponse(new NoteResources($note), 'Note deleted successfully');
    }
}
