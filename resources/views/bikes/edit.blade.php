<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Bike</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('bikes.update', $bike) }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block mb-1">Model</label>
                            <input name="model" value="{{ old('model', $bike->model) }}" class="w-full rounded border-gray-300" />
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block mb-1">Status</label>
                            <select name="status" class="w-full rounded border-gray-300">
                                @foreach (['available','rented','maintenance'] as $opt)
                                    <option value="{{ $opt }}" @selected(old('status', $bike->status)===$opt)>{{ $opt }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block mb-1">Station</label>
                            <select name="station_id" class="w-full rounded border-gray-300">
                                <option value="">—</option>
                                @foreach ($stations as $s)
                                    <option value="{{ $s->id }}" @selected(old('station_id', $bike->station_id)==$s->id)>{{ $s->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('station_id')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block mb-1">Battery Level</label>
                            <input type="number" name="battery_level" value="{{ old('battery_level', $bike->battery_level) }}" class="w-full rounded border-gray-300" />
                            <x-input-error :messages="$errors->get('battery_level')" class="mt-2" />
                        </div>
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('bikes.index') }}" class="px-4 py-2 rounded bg-gray-200">Cancel</a>
                            <button class="px-4 py-2 rounded bg-blue-600 text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


