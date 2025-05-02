<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Create Button --}}
                    <div class="mb-4">
                        <x-create-button href="{{ route('todo.create') }}" />
                    </div>

                    {{-- Flash Messages --}}
                    @if (session('success'))
                        <div class="text-green-600 dark:text-green-400 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('danger'))
                        <div class="text-red-600 dark:text-red-400 mb-4">
                            {{ session('danger') }}
                        </div>
                    @endif

                    {{-- Todo Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm text-left">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 uppercase">
                                <tr>
                                    <th class="px-6 py-3">Title</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($todos as $todo)
                                    <tr>
                                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                                            <a href="{{ route('todo.edit', $todo) }}" class="hover:underline">
                                                {{ $todo->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($todo->is_complete)
                                                <span class="text-green-600 font-semibold">Completed</span>
                                            @else
                                                <span class="text-blue-600 font-semibold">Ongoing</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-4">
                                                {{-- Complete / Uncomplete --}}
                                                @if (!$todo->is_complete)
                                                    <form method="POST" action="{{ route('todo.complete', $todo) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="text-green-600 hover:underline" type="submit">Complete</button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route('todo.uncomplete', $todo) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="text-blue-600 hover:underline" type="submit">Uncomplete</button>
                                                    </form>
                                                @endif

                                                {{-- Delete --}}
                                                <form method="POST" action="{{ route('todo.destroy', $todo) }}" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-600 hover:underline" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-white">
                                            No todos found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Delete All Completed --}}
                    @if (isset($todosCompleted) && $todosCompleted > 0)
                        <div class="mt-6">
                            <form action="{{ route('todo.deleteallcompleted') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button>
                                    Delete All Completed Task
                                </x-primary-button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
