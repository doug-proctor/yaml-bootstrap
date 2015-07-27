<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
	public function home() {
		return view('pages.home');
	}

	public function view($hash)
	{
		$project = \App\Project::where('hash', $hash)->first();
		return view('projects.preview', compact('project'));
	}
}
