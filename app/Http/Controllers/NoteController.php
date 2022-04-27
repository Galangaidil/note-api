<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $notes = \auth()->user()->notes;

        return response()->json([
            "notes" => $notes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $request->validated();

        $note = Note::create([
            'user_id' => Auth::id(),
            "title" => $request->title,
            "body" => $request->body,
        ]);

        return response()->json([
            "message"=>"Create success",
            "note" => $note
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = \auth()->user()->notes()->where('id', $id)->first();

        if (!$note) {
            return response()->json([
                "message" => "Notes not found!"
            ]);
        }

        return $note;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, $id)
    {
        $note = \auth()->user()->notes()->where('id', $id)->first();

        if (!$note) {
            return response()->json([
                "message" => "Update failed!"
            ]);
        }

        $request->validated();
        $note->title = $request->title;
        $note->body = $request->body;
        $note->save();

        return response()->json([
            "message" => "Update success",
            "note" => $note
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = \auth()->user()->notes()->where('id', $id)->first();

        if (!$note) {
            return response()->json([
                "message" => "Delete failed!"
            ]);
        }

        $note->delete();

        return response()->json([
            "message" => "Delete success"
        ]);
    }
}
