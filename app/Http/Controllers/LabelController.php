<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = auth()->user()->labels;

        return response()->json([
            "labels" => $labels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "string"]
        ]);

        $label = Label::create([
            "user_id" => auth()->id(),
            "name" => $request->name
        ]);

        return response()->json([
            "message" => "Create success",
            "label" => $label
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
        $label = auth()->user()->labels()->where('id', $id)->first();

        if (!$label) {
            return response()->json([
                "message" => "Label not found"
            ]);
        }

        return $label;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $label = auth()->user()->labels()->where('id', $id)->first();

        if (!$label) {
            return response()->json([
                "message" => "Label not found"
            ]);
        }

        $request->validate([
            "name" => ["required", "string"]
        ]);

        $label->name = $request->name;
        $label->save();

        return response()->json([
            "message" => "update success",
            "label" => $label
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
        $label = auth()->user()->labels()->where('id', $id)->first();

        if (!$label) {
            return response()->json([
                "message" => "Label not found"
            ]);
        }

        $label->delete();

        return response()->json([
            "message" => "Delete succes"
        ]);
    }
}
