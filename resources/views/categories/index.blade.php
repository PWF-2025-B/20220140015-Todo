@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-semibold mb-4">Todo Category</h1>

    <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        CREATE
    </a>

    <table class="min-w-full mt-4 border border-gray-300 rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Todos Count</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr class="border-t border-gray-200">
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $category->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $category->todos_count ?? 0 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:underline mr-3">Edit</a>

                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline"
                              onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center px-6 py-4 text-gray-600">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
