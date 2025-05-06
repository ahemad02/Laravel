<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login(Request $request)
    {

        $validation = $request->validate([
            'name'     => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where([
            ['name', '=', $request->name],
            ['password', '=', $request->password],
        ])->first();

        if (! $admin) {
            $validation = $request->validate([
                'user' => 'required',
            ], [
                'user.required' => 'User Does Not Exist',
            ]);
        }

        Session::put('admin', $admin);
        return redirect('dashboard');
    }

    public function dashboard()
    {
        $admin = Session::get('admin');
        if (! $admin) {
            return redirect('admin-login');
        }
        return view('admin', ['name' => $admin->name, 'totalCategories' => \App\Models\Category::count(),
            'totalQuizzes'               => \App\Models\Quiz::count(),
            'totalMcqs'                  => \App\Models\Mcq::count()]);
    }

    public function categories()
    {
        $categories = Category::paginate(5); // You can change 5 to any number per page

        $admin = Session::get('admin');
        if (! $admin) {
            return redirect('admin-login');
        }
        return view('categories', ['name' => $admin->name, 'categories' => $categories]);
    }

    public function logout()
    {
        Session::forget('admin');
        return redirect('admin-login');
    }

    public function addCategory(Request $request)
    {
        $validation = $request->validate([
            'category' => 'required | min:3 | max:30 | unique:categories,name',
        ], [
            'category.unique' => 'Category Already Exists',
        ]);
        $admin             = Session::get('admin');
        $category          = new Category();
        $category->name    = $request->category;
        $category->creator = $admin->name;
        if ($category->save()) {
            Session::flash('category', 'Category' . ' ' . $request->category . ' ' . 'Added Successfully');
        }

        return redirect('admin-categories');

    }

    public function deleteCategory($id)
    {
        $isDeleted = Category::where('id', $id)->delete();
        if ($isDeleted) {
            Session::flash('category', 'Category Deleted Successfully');
            return redirect('admin-categories');
        }
    }

    public function addQuiz()
    {
        $categories = Category::get();
        $admin      = Session::get('admin');
        $totalMCQ   = 0;
        if (! $admin) {
            return redirect('admin-login');
        }
        $quizName    = request('quiz');
        $category_id = request('category_id');
        if ($quizName && $category_id && ! Session::has('quizDetails')) {
            $quiz              = new Quiz();
            $quiz->name        = $quizName;
            $quiz->category_id = $category_id;
            if ($quiz->save()) {
                Session::put('quizDetails', $quiz);
            }
        } else {
            $quiz     = Session::get('quizDetails');
            $totalMCQ = $quiz && Mcq::where('quiz_id', '=', $quiz->id)->count();
        }
        return view('add-quiz', ['name' => $admin->name, 'categories' => $categories, 'totalMCQ' => $totalMCQ]);
    }

    public function addMCQS(Request $request)
    {
        $request->validate([
            'question'       => 'required | min:3 | max:100',
            'a'              => 'required',
            'b'              => 'required',
            'c'              => 'required',
            'd'              => 'required',
            'correct_answer' => 'required',
        ]);
        $mcq                 = new Mcq();
        $quiz                = Session::get('quizDetails');
        $admin               = Session::get('admin');
        $mcq->question       = $request->question;
        $mcq->a              = $request->a;
        $mcq->b              = $request->b;
        $mcq->c              = $request->c;
        $mcq->d              = $request->d;
        $mcq->correct_answer = $request->correct_answer;
        $mcq->quiz_id        = $quiz->id;
        $mcq->admin_id       = $admin->id;
        $mcq->category_id    = $quiz->category_id;
        if ($mcq->save()) {
            if ($request->submit == 'add-more') {
                return redirect(url()->previous());
            } else {
                Session::forget('quizDetails');
                return redirect('admin-categories');
            }
        }

        return "Failed to Add MCQ";

    }

    public function endQuiz()
    {
        Session::forget('quizDetails');
        return redirect('admin-categories');
    }

    public function showQuiz($id, $quizName)
    {
        $admin = Session::get('admin');
        $mcqs  = Mcq::where('quiz_id', '=', $id)->get();
        if (! $admin) {
            return redirect('admin-login');
        }
        return view('show-quiz', ['name' => $admin->name, 'mcqs' => $mcqs, 'quizName' => $quizName]);
    }

    public function quizList($id, $category)
    {
        $admin = Session::get('admin');
        if ($admin) {
            $quizData = Quiz::where('category_id', '=', $id)->get();
            return view('quiz-list', ['name' => $admin->name, 'quizData' => $quizData, 'category' => $category]);
        } else {
            return redirect('admin-login');
        }
    }

}
