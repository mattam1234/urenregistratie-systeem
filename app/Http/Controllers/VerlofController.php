<?php

namespace App\Http\Controllers;

use App\verlof;
use Illuminate\Http\Request;

class VerlofController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $verlof = auth()->user()->verlof;
        return view('verlof-status')->with('verlof', $verlof);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('verlof.create');
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
        // Check if user owns this verlof record
        if ($verlof->werknemerNummer != auth()->user()->id) {
            return redirect()->route('verlof')->with('error', 'Unauthorized action.');
        }
        return view('verlof.edit', compact('verlof'));
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
        // Check if user owns this verlof record
        if ($verlof->werknemerNummer != auth()->user()->id) {
            return redirect()->route('verlof')->with('error', 'Unauthorized action.');
        }

        $this->validate($request, [
            'reden' => 'required',
            'BeginDatum' => 'required',
            'EindDatum' => 'required',
        ]);

        $verlof->reden = $request->input('reden');
        $verlof->BeginDatum = $request->input('BeginDatum');
        $verlof->EindDatum = $request->input('EindDatum');
        $verlof->save();
        
        return redirect()->route('verlof')->with('success', 'Verlof updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\verlof  $verlof
     * @return \Illuminate\Http\Response
     */
    public function destroy(verlof $verlof)
    {
        // Check if user owns this verlof record
        if ($verlof->werknemerNummer != auth()->user()->id) {
            return redirect()->route('verlof')->with('error', 'Unauthorized action.');
        }
        
        $verlof->delete();
        return redirect()->route('verlof')->with('success', 'Verlof deleted successfully');
    }
}
