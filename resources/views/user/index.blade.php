<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Search Bar --}}
                <div class="mb-4 flex items-center">
                    <form method="GET" action="{{ route('user.index') }}" class="flex w-full gap-2">
                        <input type="text" name="search" placeholder="Search by name or email ..." value="{{ request('search') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-primary-button type="submit">Search</x-primary-button>
                    </form>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Todo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->todos_count }}
                                        <span class="text-sm text-gray-400">({{ $user->completed_todos_count }})</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($user->todos_count > 0)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                        @if ($user->is_admin)
                                            <form method="POST" action="{{ route('user.removeadmin', $user->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-blue-600 font-semibold">Remove Admin</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('user.makeadmin', $user->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-red-600 font-semibold">Make Admin</button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('user.destroy', $user->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 font-semibold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
