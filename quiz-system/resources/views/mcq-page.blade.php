<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MCQ Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar ></x-user-navbar>
    @if(session('message'))
<p class="text-green-500">{{'message'}}</p>
@endif
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
    <h1 class="text-2xl text-center text-green-800 mb-6 font-bold ">
       {{$quizName}}
    </h1>
    <h2 class="text-2xl text-center text-green-800 mb-6 font-bold ">
       Total Question {{session('currentQuiz')['totalMcq']}}
    </h2>

    <h3 class="text-2xl text-center text-green-800 mb-6 font-bold ">
      Question  {{session('currentQuiz')['currentMcq']}} of {{session('currentQuiz')['totalMcq']}}
    </h3>

    <div class="mt-2 p-4 bg-white shadow-2xl rounded-xl w-140">

    <h3 class="text-green-900 font-bold text-xl mb-1 ">{{$mcqData->question}}</h3>
    <form action="/submit-next/{{$mcqData->id}}" method="post" class="space-y-4">
        @csrf
        <input type="hidden" name="id" value="{{$mcqData->id}}">
<label for="option1" class="flex border p-3 mt-2 rounded-2xl shadow-2xl hover:bg-blue-50 cursor-pointer">
    <input class="form-radio text-blue-500" type="radio" name="option" id="option1" value="a">
    <span class="text-green-900 pl-2">{{$mcqData->a}}</span>
</label>
<label for="option2" class="flex border p-3 mt-2 rounded-2xl shadow-2xl hover:bg-blue-50 cursor-pointer">
    <input class="form-radio text-blue-500" type="radio" name="option" id="option2" value="b">
    <span class="text-green-900 pl-2">{{$mcqData->b}}</span>
</label>
<label for="option3" class="flex border p-3 mt-2 rounded-2xl shadow-2xl hover:bg-blue-50 cursor-pointer">
    <input class="form-radio text-blue-500" type="radio" name="option" id="option3" value="c">
    <span class="text-green-900 pl-2">{{$mcqData->c}}</span>
</label>
<label for="option4" class="flex border p-3 mt-2 rounded-2xl shadow-2xl hover:bg-blue-50 cursor-pointer">
    <input class="form-radio text-blue-500" type="radio" name="option" id="option4" value="d">
    <span class="text-green-900 pl-2">{{$mcqData->d}}</span>
</label>
<button class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white  cursor-pointer hover:bg-blue-600">
    Submit Answer and Next
</button>
    </form>

    </div>

</div>
<x-footer-user></x-footer-user>
</body>
</html>
