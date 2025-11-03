<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StationController extends Controller
{
    public function index(): View
    {
        $stations = Station::orderBy('name')->paginate(10);
        return view('stations.index', compact('stations'));
    }

    public function create(): View
    {
        return view('stations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:0'],
        ]);

        Station::create($data);
        return redirect()->route('stations.index')->with('status', 'Station created');
    }

    public function edit(Station $station): View
    {
        return view('stations.edit', compact('station'));
    }

    public function update(Request $request, Station $station): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:0'],
        ]);

        $station->update($data);
        return redirect()->route('stations.index')->with('status', 'Station updated');
    }

    public function destroy(Station $station): RedirectResponse
    {
        $station->delete();
        return redirect()->route('stations.index')->with('status', 'Station deleted');
    }
}


