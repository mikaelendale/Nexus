<?php

namespace App\Http\Controllers;

use App\Models\Org;
use App\Models\Projects;
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
                ->orWhere('volunteer_id', 'like', '%' . $search . '%');
        })->paginate(10); // Adjust the number for items per page

        return view('dashboard', compact('volunteers'));
    }

    public function show($id)
    {
        $volunteer = Volunteers::findOrFail($id);
        $assignedOrgs = $volunteer->volunteerOrgs; // Get assigned organizations for the volunteer

        // Retrieve projects associated with the volunteer's organizations
        $projects = Projects::where('volunteers_id', $volunteer->id)->get();

        // Existing code to retrieve organizations and hours
        $assignedOrgIds = Volunteer_org::where('volunteers_id', $id)->pluck('org_id')->toArray();
        $volunteerOrgs = Org::whereIn('id', $assignedOrgIds)->get();
        $availableOrgs = Org::whereNotIn('id', $assignedOrgIds)->get();
        $assignedOrgs = Volunteer_org::where('volunteers_id', $id)->get();
        $totalHours = $assignedOrgs->sum('hours');
        $goal = 72;

        return view('show', compact('volunteer', 'volunteerOrgs', 'availableOrgs', 'assignedOrgs', 'totalHours', 'goal', 'projects'));
    }

    public function removeOrg($volunteerId, $orgId)
    {
        // Find the volunteer organization entry
        $volunteerOrg = Volunteer_org::where('volunteers_id', $volunteerId)->where('org_id', $orgId)->first();

        if ($volunteerOrg) {
            $volunteerOrg->delete();
        }

        return redirect()->back()->with('success', 'Organization removed successfully.');
    }

    // VolunteerController.php
    public function submitProject(Request $request, $id)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'project_description' => 'required|string',
        ]);

        // Create a new project
        Projects::create([
            'volunteers_id' => $id,
            'project_name' => $validated['project_name'],
            'description' => $validated['project_description'],
            'org_id' => 5, // Online Volunteer org ID
        ]);

        return redirect()->route('volunteers.show', $id)
            ->with('success', 'Project added successfully.');
    }

    public function updateHours(Request $request, $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'org_id' => 'required|exists:org,id',
            'hours' => 'required|numeric|min:0',
        ]);

        // Find the existing volunteer
        $volunteer = Volunteers::findOrFail($id);

        // Find the current hours for the organization
        $volunteerOrg = Volunteer_org::where('volunteers_id', $id)
            ->where('org_id', $validated['org_id'])
            ->first();

        // Cast hours to integer
        $hoursToAdd = (int) $validated['hours'];

        // Set the maximum hours limit
        $maxHours = 72;

        if ($volunteerOrg) {
            // Calculate the new total hours for the organization
            $newTotalHours = $volunteerOrg->hours + $hoursToAdd;

            // Check if adding the hours would exceed the limit
            if ($newTotalHours > $maxHours) {
                return redirect()->route('volunteers.show', $id)
                    ->withErrors(['hours' => 'The total hours for this organization cannot exceed ' . $maxHours . ' hours.']);
            }

            // Update the existing record
            $volunteerOrg->hours = $newTotalHours;
            $volunteerOrg->save();
        } else {
            // Check if the hours to add exceed the limit
            if ($hoursToAdd > $maxHours) {
                return redirect()->route('volunteers.show', $id)
                    ->withErrors(['hours' => 'The total hours for this organization cannot exceed ' . $maxHours . ' hours.']);
            }

            // Create a new record if it doesn't exist
            Volunteer_org::create([
                'volunteers_id' => $id,
                'org_id' => $validated['org_id'],
                'hours' => $hoursToAdd,
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

    // Delete the volunteer
    public function destroy($id)
    {
        $volunteer = Volunteers::findOrFail($id);
        $volunteer->delete();

        return redirect()->route('details')
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
            'volunteer_id' => Volunteers::max('id') + 1, // Assuming `id` is the auto-incrementing primary key
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
