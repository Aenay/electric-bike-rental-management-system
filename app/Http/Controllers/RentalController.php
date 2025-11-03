<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Rental;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RentalController extends Controller
{
    public function index(): View
    {
        $rentals = Rental::with(['bike', 'user'])->latest()->paginate(10);
        return view('rentals.index', compact('rentals'));
    }

    public function create(): View
    {
        $bikes = Bike::where('status', 'available')->orderBy('id', 'desc')->get();
        return view('rentals.create', compact('bikes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'bike_id' => ['required', 'exists:bikes,id'],
            'start_time' => ['required', 'date'],
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'active';
        $data['cost'] = 0;

        $rental = Rental::create($data);

        // Set bike status to rented
        $rental->bike->update(['status' => 'rented']);

        return redirect()->route('rentals.index')->with('status', 'Rental started');
    }

    public function edit(Rental $rental): View
    {
        $bikes = Bike::orderBy('id', 'desc')->get();
        return view('rentals.edit', compact('rental', 'bikes'));
    }

    public function update(Request $request, Rental $rental): RedirectResponse
    {
        $data = $request->validate([
            'bike_id' => ['required', 'exists:bikes,id'],
            'start_time' => ['required', 'date'],
            'end_time' => ['nullable', 'date', 'after_or_equal:start_time'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $rental->update($data);

        if ($rental->status === 'completed') {
            $rental->bike->update(['status' => 'available']);
        }

        return redirect()->route('rentals.index')->with('status', 'Rental updated');
    }

    public function destroy(Rental $rental): RedirectResponse
    {
        $rental->delete();
        return redirect()->route('rentals.index')->with('status', 'Rental deleted');
    }
}


