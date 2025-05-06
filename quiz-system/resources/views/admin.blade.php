<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

<x-navbar name="{{ $name }}" />

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Categories -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <h2 class="text-gray-700 text-xl font-semibold">Categories</h2>
            <p class="text-2xl font-bold text-blue-500 mt-2">{{ $totalCategories }}</p>
        </div>

        <!-- Total Quizzes -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <h2 class="text-gray-700 text-xl font-semibold">Quizzes</h2>
            <p class="text-2xl font-bold text-green-500 mt-2">{{ $totalQuizzes }}</p>
        </div>

        <!-- Total MCQs -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <h2 class="text-gray-700 text-xl font-semibold">Total MCQs</h2>
            <p class="text-2xl font-bold text-purple-500 mt-2">{{ $totalMcqs }}</p>
        </div>

        <!-- Admin Name -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <h2 class="text-gray-700 text-xl font-semibold">Welcome</h2>
            <p class="text-2xl font-bold text-gray-800 mt-2">{{ucfirst( $name )}}</p>
        </div>
    </div>

    <div class="mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Quick Links</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="/admin-categories" class="bg-blue-600 text-white py-3 px-6 rounded-lg text-center hover:bg-blue-700 transition">Add Category</a>
            <a href="/add-quiz" class="bg-green-600 text-white py-3 px-6 rounded-lg text-center hover:bg-green-700 transition">Add Quiz</a>
            <a href="/admin-logout" class="bg-red-600 text-white py-3 px-6 rounded-lg text-center hover:bg-red-700 transition">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
