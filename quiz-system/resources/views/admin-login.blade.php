<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>
<body class=" bg-gray-800 flex items-center justify-center min-h-screen">
    <div class=" bg-white p-8 rounded-2xl  shadow-lg w-full max-w-sm">
    <h2 class="text-2xl text-center text-gray-800 mb-6 ">Admin Login </h2>
    @error('user')
    <p class="text-red-500 text-sm mt-1">{{$message}}</p>
     @enderror
    <form action="/admin-login" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="" class="text-gray-600 mb-1 font-bold">Admin name</label>
            <input type="text"placeholder="Enter Admin name" name="name"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="" class="text-gray-600 mb-1 font-bold">Password</label>
            <input type="password"placeholder="Enter Admin password" name="password"
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white" >Login</button>
    </form>
    </div>
</body>
</html>
