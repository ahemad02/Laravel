@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">All Posts</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <a href="{{ route('posts.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded mb-4 hover:bg-blue-600">Add New Post</a>

    <table class="w-full table-auto border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-3 py-2 border">#</th>
                <th class="px-3 py-2 border">Title</th>
                <th class="px-3 py-2 border">Body</th>
                <th class="px-3 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $index => $post)
            <tr class="even:bg-gray-50">
                <td class="px-3 py-2 border">{{ $index + 1 }}</td>
                <td class="px-3 py-2 border">{{ $post->title }}</td>
                <td class="px-3 py-2 border">{{ $post->body }}</td>
                <td class="px-3 py-2 border space-x-2">
                    <a href="{{ route('posts.edit', $post->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
