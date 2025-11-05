<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Maintenance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaintenanceController extends Controller
{
    public function index(): View
    {
        $maintenances = Maintenance::with('bike')->latest()->paginate(10);
        return view('maintenance.index', compact('maintenances'));
    }

    public function create(): View
    {
        $bikes = Bike::orderBy('id', 'desc')->get();
        return view('maintenance.create', compact('bikes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'bike_id' => ['required', 'exists:bikes,id'],
            'issue' => ['required', 'string', 'max:255'],
            'repair_date' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        Maintenance::create($data);
        
        // Automatically update bike status to maintenance
        $bike = Bike::find($data['bike_id']);
        $bike->update(['status' => 'maintenance']);
        
        return redirect()->route('maintenance.index')->with('status', 'Maintenance created');
    }

    public function edit(Maintenance $maintenance): View
    {
        $bikes = Bike::orderBy('id', 'desc')->get();
        return view('maintenance.edit', compact('maintenance', 'bikes'));
    }

    public function update(Request $request, Maintenance $maintenance): RedirectResponse
    {
        $data = $request->validate([
            'bike_id' => ['required', 'exists:bikes,id'],
            'issue' => ['required', 'string', 'max:255'],
            'repair_date' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $maintenance->update($data);
        
        // Update bike status based on maintenance status
        $bike = Bike::find($data['bike_id']);
        if ($data['status'] === 'completed') {
            $bike->update(['status' => 'available']);
        } else {
            $bike->update(['status' => 'maintenance']);
        }
        
        return redirect()->route('maintenance.index')->with('status', 'Maintenance updated');
    }

    public function destroy(Maintenance $maintenance): RedirectResponse
    {
        // Restore bike status when maintenance is deleted
        $bike = Bike::find($maintenance->bike_id);
        $bike->update(['status' => 'available']);
        
        $maintenance->delete();
        return redirect()->route('maintenance.index')->with('status', 'Maintenance deleted');
    }
}


