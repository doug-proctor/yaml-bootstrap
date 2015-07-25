<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

use Auth;
use Session;
use Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projects = Auth::user()->projects;
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Auth::user()->projects()->save(new Project($request->all()));
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $project = Auth::user()->projects()->find($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $project = Auth::user()->projects()->find($id);
        $project->yaml = $request->yaml;
        $project->save();
        return Redirect::back();
    }

    public function preview($id)
    {
        $project = Auth::user()->projects()->find($id);
        return view('projects.preview', compact('project'));
    }

    public function yaml($id)
    {
        $project = Auth::user()->projects()->find($id);
        return $project->yaml;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
