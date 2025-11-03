<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Maintenance</h2>
            <a href="{{ route('maintenance.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Add</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('status') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">Bike</th>
                                    <th class="px-4 py-2 text-left">Issue</th>
                                    <th class="px-4 py-2 text-left">Repair Date</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($maintenances as $m)
                                    <tr>
                                        <td class="px-4 py-2">#{{ $m->bike_id }} - {{ $m->bike?->model }}</td>
                                        <td class="px-4 py-2">{{ $m->issue }}</td>
                                        <td class="px-4 py-2">{{ optional($m->repair_date)->format('Y-m-d') ?: '—' }}</td>
                                        <td class="px-4 py-2">{{ $m->status }}</td>
                                        <td class="px-4 py-2 text-right space-x-2">
                                            <a href="{{ route('maintenance.edit', $m) }}" class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-700">Edit</a>
                                            <form action="{{ route('maintenance.destroy', $m) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Delete this record?')" class="px-3 py-1 rounded bg-red-600 text-white">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $maintenances->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


