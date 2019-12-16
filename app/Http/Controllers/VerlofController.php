<?php

namespace App\Http\Controllers;

use App\verlof;
use App\User;
use Illuminate\Http\Request;

class VerlofController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = User::find('id');
        $verlof = Verlof::where('','');
        return view('verlof-status');
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
        $this->validate($request, [
            'reden' => 'required',
            'BeginDatum' => 'required',
            'EindDatum' => 'required',
        ]);

        // Create Post
        $post = new verlof;
        $post->reden = $request->input('reden');
        $post->BeginDatum = $request->input('BeginDatum');
        $post->EindDatum = $request->input('EindDatum');
        $post->werknemerNummer = auth()->user()->id;
        $post->save();
        return redirect('home')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\verlof  $verlof
     * @return \Illuminate\Http\Response
     */
    public function show(verlof $verlof)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\verlof  $verlof
     * @return \Illuminate\Http\Response
     */
    public function edit(verlof $verlof)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\verlof  $verlof
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, verlof $verlof)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\verlof  $verlof
     * @return \Illuminate\Http\Response
     */
    public function destroy(verlof $verlof)
    {
        //
    }
}
