<x-layout>
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    @if(session('success'))
        <div class="mb-4 text-green-600 text-sm">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-3 bg-red-100 text-red-700 border border-red-300 rounded">
        {{ session('error') }}
    </div>
@endif


    <form method="POST" action="/login" class="space-y-4">
        @csrf

        <div>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                   class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <input type="password" name="password" placeholder="Password"
                   class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            @error('loginError')<p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                Login
            </button>

        </div>

        <div class="text-center text-sm mt-4">
            Don't have an account? <a href="/register" class="text-blue-500 underline">Register</a>
        </div>
    </form>
</x-layout>
