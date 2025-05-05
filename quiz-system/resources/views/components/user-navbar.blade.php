
<nav class=" bg-white shadow-md px-4 py-3">
      <div class="flex justify-between item-center">
      <div class="text-2xl text-green-900 hover:text-blue-500 cursor-pointer">
            Quiz System
        </div>
        <div class=" space-x-4">
        <a class="text-green-900 hover:text-blue-500 text-2xl" href="/">Home</a>
            <a class="text-green-900 hover:text-blue-500 text-2xl" href="/">Categories</a>

            @if(session('user'))

            <a class="text-green-900 hover:text-blue-500 text-2xl" href="/user-details">Welcome ({{ucfirst(session('user')->name)}})</a>
            <a class="text-green-900 hover:text-blue-500 text-2xl" href="/user-logout">Logout</a>

            @else
            <a class="text-green-900 hover:text-blue-500 text-2xl" href="/user-login">Login</a>
            <a class="text-green-900 hover:text-blue-500 text-2xl" href="/user-signup">Signup</a>

            @endif


            <a class="text-green-900 hover:text-blue-500 text-2xl" href="/">Blog</a>
        </div>
      </div>
    </nav>
