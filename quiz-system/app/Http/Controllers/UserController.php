<?php
namespace App\Http\Controllers;

use App\Mail\UserForgotPassword;
use App\Mail\VerifyUser;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\MCQ_Record;
use App\Models\Quiz;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function welcome()
    {
        $categories = Category::withCount('quizzes')->get();
        return view('welcome', ['categories' => $categories]);
    }

    public function userQuizList($id, $category)
    {

        $quizData = Quiz::withCount('mcqs')->where('category_id', '=', $id)->get();
        return view('user-quiz-list', ['quizData' => $quizData, 'category' => $category]);
    }

    public function userSignup(Request $request)
    {
        $validate = $request->validate([
            'name'     => 'required | min:3 | max:20',
            'email'    => 'required | email | unique:users',
            'password' => 'required | min:3 | max:20 | confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $link = Crypt::encryptString($request->email);

        $link = url('/verify-user/' . $link);

        Mail::to($request->email)->send(new VerifyUser($link));

        if ($user) {
            Session::put('user', $user);
            if (Session::has('quiz-url')) {
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect($url);
            }
            return redirect('/');
        }

    }

    public function startQuiz($id, $name)
    {

        $quizCount = Mcq::where('quiz_id', $id)->count();
        $mcqs      = Mcq::where('quiz_id', $id)->get();
        Session::put('firstMCQ', $mcqs[0]);
        $quizName = $name;
        return view('start-quiz', ['quizName' => $quizName, 'quizCount' => $quizCount]);

    }

    public function userLogout()
    {
        Session::forget('user');
        return redirect('/');
    }

    public function userSignupQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-signup');
    }

    public function userLogin(Request $request)
    {

        $validate = $request->validate([
            'email'    => 'required | email',
            'password' => 'required | min:3 | max:20',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user', $user);
            if (Session::has('quiz-url')) {
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect($url);
            } else {
                return redirect('/');
            }
        }

        return "User Not Found, Please Check Your Credentials";

    }

    public function userLoginQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-login');
    }

    public function mcq($id, $name)
    {
        $record          = new Record();
        $record->user_id = Session::get('user')->id;
        $record->quiz_id = Session::get('firstMCQ')->quiz_id;
        $record->status  = 1;
        if ($record->save()) {
            $currentQuiz               = [];
            $currentQuiz['totalMcq']   = MCQ::where('quiz_id', Session::get('firstMCQ')->quiz_id)->count();
            $currentQuiz['currentMcq'] = 1;
            $currentQuiz['quizName']   = $name;
            $currentQuiz['quizId']     = Session::get('firstMCQ')->quiz_id;
            $currentQuiz['recordId']   = $record->id;
            Session::put('currentQuiz', $currentQuiz);
            $mcqData = MCQ::find($id);

            return view('mcq-page', ['quizName' => $name, 'mcqData' => $mcqData]);
        } else {
            return "Error";
        }

    }

    public function submitNext(Request $request, $id)
    {
        $currentQuiz = Session::get('currentQuiz');
        $currentQuiz['currentMcq'] += 1;
        $mcqData = MCQ::where([
            ['id', '>', $id],
            ['quiz_id', '=', $currentQuiz['quizId']],

        ])->first();

        $isExist = MCQ_Record::where([
            ['record_id', '=', $currentQuiz['recordId']],
            ['mcq_id', '=', $request->id],
        ])->count();

        if ($isExist < 1) {
            $mcq_record                  = new MCQ_Record();
            $mcq_record->record_id       = $currentQuiz['recordId'];
            $mcq_record->user_id         = Session::get('user')->id;
            $mcq_record->mcq_id          = $request->id;
            $mcq_record->selected_answer = $request->option;

            if ($request->option == MCQ::find($request->id)->correct_answer) {
                $mcq_record->is_correct = 1;
            } else {
                $mcq_record->is_correct = 0;
            }

            $mcq_record->save();

            if (! $mcq_record->save()) {
                return "Error";
            }
        }

        Session::put('currentQuiz', $currentQuiz);

        if (! $mcqData) {
            $resultData     = MCQ_Record::WithMCQ()->where('record_id', $currentQuiz['recordId'])->get();
            $correctAnswers = MCQ_Record::where([
                ['record_id', $currentQuiz['recordId']],
                ['is_correct', '=', 1],
            ])->get();

            $record = Record::find($currentQuiz['recordId']);

            if ($record) {
                $record->status = 2;
                $record->update();
            }

            return view('quiz-result', ['resultData' => $resultData, 'correctAnswers' => count($correctAnswers)]);
        }
        return view('mcq-page', ['quizName' => $currentQuiz['quizName'], 'mcqData' => $mcqData]);
    }

    public function userDetails()
    {
        $quizRecord = Record::WithQuiz()->where('user_id', Session::get('user')->id)->get();
        return view('user-details', ['quizRecord' => $quizRecord]);
    }

    public function quizSearch(Request $request)
    {
        $quizData = Quiz::withCount('mcqs')->where('name', 'like', '%' . $request->search . '%')->get();
        return view('quiz-search', ['quizData' => $quizData, 'search' => $request->search]);
    }

    public function verifyUser($link)
    {
        $orgEmail = Crypt::decryptString($link);
        $user     = User::where('email', $orgEmail)->first();
        if ($user) {
            $user->active = 2;
            if ($user->save()) {
                return redirect('/');
            }
        }
    }

    public function userForgotPassword(Request $request)
    {
        $link = Crypt::encryptString($request->email);
        $link = url('/user-forgot-password/' . $link);
        Mail::to($request->email)->send(new UserForgotPassword($link));
        return redirect('/');
    }

    public function userResetPassword($link)
    {
        $email = Crypt::decryptString($link);
        return view('user-set-forgot-password', ['email' => $email]);
    }

    public function userSetForgotPassword(Request $request)
    {
        $validate = $request->validate([
            'password' => 'required | min:3 | max:20 | confirmed',
        ]);

        $user           = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return redirect('/user-login');
        }

    }

}
