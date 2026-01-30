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
            'BeginDatum' => 'required|date',
            'EindDatum' => 'required|date|after_or_equal:BeginDatum',
        ]);

        // Create leave request
        $verlof = new verlof;
        $verlof->reden = $request->input('reden');
        $verlof->BeginDatum = $request->input('BeginDatum');
        $verlof->EindDatum = $request->input('EindDatum');
        $verlof->werknemerNummer = auth()->user()->id;
        $verlof->save();
        return redirect('home')->with('success', 'Leave request created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\verlof  $verlof
     * @return \Illuminate\Http\Response
     */
    public function show(verlof $verlof)
    {
        // Check if user owns this verlof record
        if ($verlof->werknemerNummer !== auth()->user()->id) {
            return redirect()->route('verlof')->with('error', 'Unauthorized action.');
        }
        return view('verlof.show', compact('verlof'));
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
        if ($verlof->werknemerNummer !== auth()->user()->id) {
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
        if ($verlof->werknemerNummer !== auth()->user()->id) {
            return redirect()->route('verlof')->with('error', 'Unauthorized action.');
        }

        $this->validate($request, [
            'reden' => 'required',
            'BeginDatum' => 'required|date',
            'EindDatum' => 'required|date|after_or_equal:BeginDatum',
        ]);

        $verlof->reden = $request->input('reden');
        $verlof->BeginDatum = $request->input('BeginDatum');
        $verlof->EindDatum = $request->input('EindDatum');
        $verlof->save();
        
        return redirect()->route('verlof')->with('success', 'Leave request updated successfully');
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
        if ($verlof->werknemerNummer !== auth()->user()->id) {
            return redirect()->route('verlof')->with('error', 'Unauthorized action.');
        }
        
        $verlof->delete();
        return redirect()->route('verlof')->with('success', 'Leave request deleted successfully');
    }
}
