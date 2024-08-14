<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function store(Request $request)
{
    // Log the incoming request data to verify
    \Log::info('Incoming project data:', $request->all());

    $request->validate([
        'project_name' => 'required|string|max:255',
        'description' => 'required|string',
        'volunteer_id' => 'required|exists:volunteers,id',
        'org_id' => 'required|exists:org,id',
    ]);

    // Log the validated data
    \Log::info('Validated project data:', $request->only('project_name', 'description', 'volunteer_id', 'org_id'));

    Projects::create([
        'project_name' => $request->input('project_name'),
        'description' => $request->input('description'),
        'volunteer_id' => $request->input('volunteer_id'),
        'org_id' => $request->input('org_id'), // Capture the selected org_id
    ]);

    return redirect()->back()->with('success', 'Project added successfully!');
}

}
