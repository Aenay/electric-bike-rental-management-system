<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Station;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BikeController extends Controller
{
    public function index(): View
    {
        $bikes = Bike::with('station')->orderBy('id', 'desc')->paginate(10);
        return view('bikes.index', compact('bikes'));
    }

    public function create(): View
    {
        $stations = Station::orderBy('name')->get();
        return view('bikes.create', compact('stations'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'model' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
            'station_id' => ['nullable', 'exists:stations,id'],
            'battery_level' => ['required', 'integer', 'between:0,100'],
        ]);

        Bike::create($data);
        return redirect()->route('bikes.index')->with('status', 'Bike created');
    }

    public function edit(Bike $bike): View
    {
        $stations = Station::orderBy('name')->get();
        return view('bikes.edit', compact('bike', 'stations'));
    }

    public function update(Request $request, Bike $bike): RedirectResponse
    {
        $data = $request->validate([
            'model' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
            'station_id' => ['nullable', 'exists:stations,id'],
            'battery_level' => ['required', 'integer', 'between:0,100'],
        ]);

        $bike->update($data);
        return redirect()->route('bikes.index')->with('status', 'Bike updated');
    }

    public function destroy(Bike $bike): RedirectResponse
    {
        $bike->delete();
        return redirect()->route('bikes.index')->with('status', 'Bike deleted');
    }
}


