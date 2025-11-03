<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">New Maintenance</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('maintenance.store') }}" class="space-y-4">
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
                            <label class="block mb-1">Issue</label>
                            <input name="issue" value="{{ old('issue') }}" class="w-full rounded border-gray-300" />
                            <x-input-error :messages="$errors->get('issue')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block mb-1">Repair Date</label>
                            <input type="date" name="repair_date" value="{{ old('repair_date') }}" class="w-full rounded border-gray-300" />
                            <x-input-error :messages="$errors->get('repair_date')" class="mt-2" />
                        </div>
                        <div>
                            <label class="block mb-1">Status</label>
                            <select name="status" class="w-full rounded border-gray-300">
                                @foreach (['open','in_progress','done'] as $opt)
                                    <option value="{{ $opt }}" @selected(old('status')===$opt)>{{ $opt }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('maintenance.index') }}" class="px-4 py-2 rounded bg-gray-200">Cancel</a>
                            <button class="px-4 py-2 rounded bg-blue-600 text-white">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


