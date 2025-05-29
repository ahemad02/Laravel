<x-layout>
    <h1 class="text-2xl font-semibold mb-4">Welcome, {{ auth()->user()->name }}</h1>

    <form action="/logout" method="POST">
        @csrf
        <button type="submit"
                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
            Logout
        </button>
    </form>
</x-layout>
