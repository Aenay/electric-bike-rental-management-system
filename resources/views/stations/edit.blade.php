<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Station</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('stations.update', $station) }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block mb-1">Name</label>
                            <input name="name" value="{{ old('name', $station->name) }}" class="w-full rounded border-gray-300" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block mb-1">Location</label>
                            <input name="location" value="{{ old('location', $station->location) }}" class="w-full rounded border-gray-300" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block mb-1">Capacity</label>
                            <input type="number" name="capacity" value="{{ old('capacity', $station->capacity) }}" class="w-full rounded border-gray-300" />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                        </div>
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('stations.index') }}" class="px-4 py-2 rounded bg-gray-200">Cancel</a>
                            <button class="px-4 py-2 rounded bg-blue-600 text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


