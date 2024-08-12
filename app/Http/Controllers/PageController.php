<?php

namespace App\Http\Controllers;

use App\Models\Org;
use App\Models\User;
use App\Models\Volunteers;
use App\Models\Volunteer_org;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $volunteers = Volunteers::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('volunteers_id', 'like', '%' . $search . '%');
        })->paginate(10); // Adjust the number for items per page

        return view('dashboard', compact('volunteers'));
    }

    public function show($id)
{
    $volunteer = Volunteers::findOrFail($id);
    $orgs = Org::all(); // Fetch all organizations
    $assignedOrgs = Volunteer_org::where('volunteers_id', $id)->get(); // Get all assigned organizations with hours
    $totalHours = $assignedOrgs->sum('hours');
    $goal = 72; // Example goal

    return view('volunteers.show', compact('volunteer', 'orgs', 'assignedOrgs', 'totalHours', 'goal'));
}


    public function updateHours(Request $request, $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'org_id' => 'required|exists:org,id', // Update here
            'hours' => 'required|numeric|min:0',
        ]);

        // Find the existing volunteer
        $volunteer = Volunteers::findOrFail($id);

        // Check if the volunteer is already associated with the organization
        $volunteerOrg = Volunteer_org::where('volunteers_id', $id)
            ->where('org_id', $validated['org_id'])
            ->first();

        if ($volunteerOrg) {
            // Increment the existing hours by the new value
            $volunteerOrg->hours += $validated['hours'];
            $volunteerOrg->save();
        } else {
            // Create a new record if it doesn't exist
            Volunteer_org::create([
                'volunteers_id' => $id,
                'org_id' => $validated['org_id'],
                'hours' => $validated['hours'],
            ]);
        }

        return redirect()->route('volunteers.show', $id)
            ->with('success', 'Hours updated successfully.');
    }

    public function edit($id)
    {
        $volunteer = Volunteers::findOrFail($id);
        return view('edit', compact('volunteer'));
    }

    // Update the volunteer
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_title' => 'nullable|string|max:255',
            'project_description' => 'nullable|string',
        ]);

        $volunteer = Volunteers::findOrFail($id);
        $volunteer->name = $request->name;
        $volunteer->project_title = $request->project_title;
        $volunteer->project_description = $request->project_description;
        $volunteer->save();

        return redirect()->route('dashboard', $volunteer->id)
            ->with('success', 'Volunteer updated successfully.');
    }

    // Delete the volunteer
    public function destroy($id)
    {
        $volunteer = Volunteers::findOrFail($id);
        $volunteer->delete();

        return redirect()->route('volunteers.index')
            ->with('success', 'Volunteer deleted successfully.');
    }
// volunteer detail
    public function showDetails()
    {
        $volunteers = Volunteers::with('orgs')->paginate(10); // Adjust the number for items per page

        return view('details', compact('volunteers'));

    }
    public function add()
    {
        $totalVolunteers = Volunteers::count();
        $totalAdmins = User::count(); // Adjust 'user_type' as per your database schema

        return view('add', [
            'totalVolunteers' => $totalVolunteers,
            'totalAdmins' => $totalAdmins,
        ]);
    }
    public function add_volunteers()
    {
        return view('add_volunteers');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new volunteer with the name and auto-increment volunteers_id
        $volunteer = Volunteers::create([
            'name' => $request->name,
            'volunteers_id' => Volunteers::max('id') + 1, // Assuming `id` is the auto-incrementing primary key
        ]);

        return redirect()->route('add')->with('success', 'Volunteer added successfully.')->with('volunteer', $volunteer);
    }
    public function addOrg(Request $request, $id)
    {
        $volunteer = Volunteers::findOrFail($id);

        // Validate the request
        $request->validate([
            'org_id' => 'required|exists:org,id',
        ]);

        // Attach the organization to the volunteer
        $volunteer->orgs()->syncWithoutDetaching([$request->input('org_id')]);

        return redirect()->route('volunteers.show', $id)->with('success', 'Organization added successfully.');
    }
}
