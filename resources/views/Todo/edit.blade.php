<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{-- Form untuk Edit Todo --}}
                    <form action="{{ route('todo.update', $todo->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input 
                                id="title" 
                                name="title" 
                                type="text" 
                                class="block mt-1 w-full" 
                                value="{{ old('title', $todo->title) }}" 
                                required 
                                autofocus 
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button type="submit">
                                {{ __('Save') }}
                            </x-primary-button>

                            <x-secondary-button type="button" onclick="window.location='{{ route('todo.index') }}'">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
