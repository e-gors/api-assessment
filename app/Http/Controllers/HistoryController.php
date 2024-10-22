<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoryCollection;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user ID
        $histories = $user->histories()->pluck('ip_address'); // Fetch only the ip_address column
        return response()->json([
            'status' => 200,
            'data' => $histories->toArray() // Return as an array
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $user = Auth::user();
        $existingHistory = $user->histories()->where('ip_address', $request->ip)->first();

        if ($existingHistory) {
            return response()->json(['message' => 'IP address already exists.'], 409);
        }

        $history = new History();
        $history->user_id = $user->id; // Assign user ID from authenticated user
        $history->ip_address = $request->ip;
        $history->save();

        return response()->json([
            'status' => 201,
            'data' => $user->histories()
        ]);
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
    public function destroy($ids)
    {
        $user = Auth::user();
        $idsArray = explode(',', $ids); // Assume IDs are passed as a comma-separated string

        $deletedCount = $user->histories()->whereIn('id', $idsArray)->delete();

        return response()->json(['message' => "$deletedCount Histories deleted successfully."]);
    }
}
