<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;


class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = [
            'status' => 'success',
            'message' => 'Data donations berhasil diambil',
            'data' => Donation::all(),
        ];

        return response()->json($data);
        // return Donation::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $input = request()->all();
        User::create($input);
        return $input;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $val = $request->validate([
            'amount' => 'required',
            'funding_id' => 'required|exists:users,id',
            'user_id' => 'required|exists:users,id',
        ]);
       
        $donation = Donation::create($val);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data donation berhasil ditambahkan',
            'data' => $donation,

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data donation berhasil diambil',
            'data' => $donation,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data donation berhasil diedit',
            'data' => $donation,


        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donation $donation)
    {

        $val = $request->validate([
            'amount' => 'required',
            'funding_id' => 'required|exists:users,id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $donation->update($val);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data donation berhasil diupdate',
            'data' => $donation,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();
       
        return response()->json([
            'status' => 'success',
            'message' => 'Data donation berhasil dihapus',
        ]);

    }
}