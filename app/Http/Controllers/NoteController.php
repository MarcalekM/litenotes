<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(3);
        //dd($notes);
        /*$notes->each(function($note){
            dump($note->title);
        });*/
        return view('notes.index')->with('notes', $notes)->with('title', 'Felhasználói jegyzetek');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:120',
            'text' => 'required|string',
        ]);
        Note::create([
            'title' => $request->title,
            'text' => $request->text,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('notes.index')->with('success', 'Bejegyzés sikeresen hozzáadva.');
        //dd($request);


    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // Ellenőrizzük, hogy a felhasználó valóban hozzáférhet-e a jegyzethez
        if ($note->user_id !== Auth::id()) {
            abort(403); // Hozzáférés megtagadása, ha a jegyzet nem a bejelentkezett felhasználóé
        }
        return view('notes.show', compact('note'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if($note->user_id != Auth::id()){
            return abort(403);
        }
        return view('notes.edit')->with('note', $note);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        // dd($request);
       if($note->user_id != Auth::id()){
        return abort(403);
    }
       $request->validate([
        'title' => 'required|max:120',
        'text' => 'required'
    ]);
        $note->update([
        'title' => $request->title,
        'text' => $request->text
    ]);
        return to_route('notes.show', $note)->with('success', 'A bejegyzés frissítése megtörtént');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if($note->user_id != Auth::id()){
            return abort(403);
        }
        $note->delete();
        return to_route('notes.index')->with('success', 'A bejegyzés törölése sikeres');
    }

}
