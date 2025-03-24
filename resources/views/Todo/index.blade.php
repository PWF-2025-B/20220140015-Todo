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
                    <h3 class="text-lg font-bold mb-4">Daftar Todo</h3>

                    @if ($todos->count())
                        <ul class="list-disc list-inside space-y-2">
                            @foreach ($todos as $todo)
                                <li>
                                    <span class="font-semibold">{{ $todo->title }}</span> - {{ $todo->status }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400 mt-2">Kamu belum punya todo.</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('todo.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Todo Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
