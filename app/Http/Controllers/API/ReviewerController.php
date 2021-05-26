<?php

namespace App\Http\Controllers\API;
use App\Reviewer;
use App\Usulan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ReviewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reviewer::allJoin_id();
    }

    public function index_reviewer()
    {
        return Reviewer::getReviewer();
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
        return Reviewer::create([
            'status_catatan' => $request['catatan'],
            'id_usulan' => $request['id'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function show(Reviewer $reviewer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function edit(Reviewer $reviewer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reviewer = Reviewer::findOrFail($id);

        $reviewer->update([
            'status_catatan' => $request['status_catatan'],
            'id_usulan' => $request['id'],
        ]);

        $usulan = Usulan::findOrFail($id);

        $usulan->update([
            'status' => $request['status'],
            'id' => $request['id'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reviewer $reviewer)
    {
        //
    }
}
