<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller as Controller;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notes = Note::where("user_id", Auth::id())->get();
        return view('notes.index')->with('notes', $notes)->with('user', Auth::user());
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'photo' => 'required'
        ]);

        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        $photo->move('uploads/notes/', $newPhoto);


        $note = Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'photo' => 'uploads/notes/' . $newPhoto,
        ]);

        return redirect($to = 'notes');
    }

    public function show($id)
    {
        $note = Note::find($id);
        return view('notes.show')->with('note', $note);
    }

    public function edit($id)
    {
        $note = Note::find($id);
        return view('notes.edit')->with('note', $note);
    }

    public function update(Request $request, $id)
    {
        $note = Note::find($id);
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/notes', $newPhoto);
            $note->photo = 'uploads/notes/' . $newPhoto;
        }

        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();
        return redirect($to = 'notes')->with('message', "note updated successfully");
    }

    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete($id);
        return redirect()->back();
    }

    public function hdelete($id)
    {
        $note = Note::withTrashed()->where('id', $id)->first();
        $note->forceDelete();
        return redirect()->back();
    }

    public function notesTrashed()
    {
        $notes = Note::onlyTrashed()->where('user_id', Auth::id())->get();
        return view('notes.trashed')->with('notes', $notes);
    }

    public function restore($id)
    {
        $note = Note::withTrashed()->where('id', $id)->first();
        $note->restore();
        return redirect()->back();
    }
}
