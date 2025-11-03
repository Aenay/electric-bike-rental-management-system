<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Start Rental</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('rentals.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block mb-1">Bike</label>
                            <select name="bike_id" class="w-full rounded border-gray-300">
                                @foreach ($bikes as $b)
                                    <option value="{{ $b->id }}" @selected(old('bike_id')==$b->id)>#{{ $b->id }} - {{ $b->model }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('bike_id')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block mb-1">Start Time</label>
                            <input type="datetime-local" name="start_time" value="{{ old('start_time', now()->format('Y-m-d\TH:i')) }}" class="w-full rounded border-gray-300" />
                            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                        </div>
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('rentals.index') }}" class="px-4 py-2 rounded bg-gray-200">Cancel</a>
                            <button class="px-4 py-2 rounded bg-blue-600 text-white">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


