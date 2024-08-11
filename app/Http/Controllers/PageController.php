<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Volunteers;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index(Request $request)
    {
        $volunteers = Volunteers::all();
        return view('dashboard', compact('volunteers'));
    }

    public function show($id)
    {
        $volunteer = Volunteers::findOrFail($id);
        return view('show', compact('volunteer'));
    }

    public function updateHours(Request $request, Volunteers $volunteer)
    {
        // Validate incoming request data
        $request->validate([
            'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'hours' => 'required|numeric|min:-30',
        ]);

        // Calculate current hours for the selected day
        $currentHours = (int) $volunteer->{$request->input('day')} ?? 0;

        // Calculate hours being added
        $hoursToAdd = (int) $request->input('hours');

        // Calculate new total hours after addition
        $newHours = $currentHours + $hoursToAdd;

        // Calculate total hours across all days
        $totalHours = 0;
        foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day) {
            if ($day == $request->input('day')) {
                $totalHours += $newHours; // Add the new hours for the selected day
            } else {
                $totalHours += (int) $volunteer->{$day};
            }
        }

        // Check if the new total hours exceed 72
        if ($totalHours > 72) {
            return redirect()->back()->withErrors(['hours' => 'Total hours cannot exceed 72.'])->withInput();
        }

        // Update the specific day's hours
        $volunteer->{$request->input('day')} = $newHours;

        // Update the total hours
        $volunteer->total = $totalHours;

        // Save the updated volunteer
        $volunteer->save();

        // Optionally, you can set a success message
        $message = 'Hours for ' . ucfirst($request->input('day')) . ' updated successfully.';

        // Redirect back with a success message
        return redirect()->back()->with('success', $message);
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

    public function showDetails($request)
    {
        $search = $request->input('search');

        $volunteers = Volunteers::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('volunteer_id', 'like', '%' . $search . '%');
        })->paginate(10); // Adjust the number for items per page

        return view('dashboard', compact('volunteers'));

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

        // Create a new volunteer with the name and auto-increment volunteer_id
        $volunteer = Volunteers::create([
            'name' => $request->name,
            'volunteer_id' => Volunteers::max('id') + 1, // Assuming `id` is the auto-incrementing primary key
        ]);

        return redirect()->route('add')->with('success', 'Volunteer added successfully.')->with('volunteer', $volunteer);
    }

}
