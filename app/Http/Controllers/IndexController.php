<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    // Ana sayfayı görüntüler
    public function index()
    {
        // Tüm soruları alır
        $questions = Question::all();

        // Soruları view'a geçirir
        return view('index', ['questions' => $questions]);
    }

    // Soru sorma sayfasını görüntüler
    public function ask(Request $request)
    {
        if (!Auth::check()) {
            // Giriş yapmamışsa giriş sayfasına yönlendir
            return redirect()->route('login')->with('error', 'Please login to ask a question.');
        }
        // Form submit edildiğinde veritabanına soruyu kaydet
        if ($request->isMethod('post')) {
            // QuestionController içindeki store metodunu çağırarak işlemi gerçekleştir
            $questionController = new QuestionController();
            return $questionController->store($request);
        }
        // Eğer post metoduyla gelmediyse, sadece ask view'ını göster
        return view('ask');
    }

    public function answerQuestion(Request $request, $questionId)
    {
        // Doğrudan AnswerQuestionController'ın showQuestion metoduna yönlendir
        return redirect()->route('answer.show', ['questionId' => $questionId]);
    }
}
