<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'question_lesson' => 'required',
                'question_subject' => 'required',
                'question_text' => 'required',
                'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Jetstream ile giriş yapmış kullanıcının adını al
            $question_author_name = auth()->user()->name;

            $question = new Question();
            $question->question_author_name = $question_author_name;
            $question->question_lesson = $request->question_lesson;
            $question->question_subject = $request->question_subject;
            $question->question_text = $request->question_text;

            // Eğer resim eklenmişse
            if ($request->hasFile('question_image')) {
                $imagePath = $request->file('question_image');
                $imageName = time() . '.' . $imagePath->getClientOriginalExtension();
                $imagePath->move(public_path('images'), $imageName);
                $question->question_image = '/images/' . $imageName;
            } else {
                // Eğer resim eklenmemişse boş olarak ata
                $question->question_image = null;
            }

            $question->save();

            return redirect()->route('index')->with('success', 'Question created successfully.');
        } catch (\Exception $e) {
            // Hata oluştuğunda hata mesajını göster
            dd($e->getMessage());
        }
    }


    public function show($id)
    {
        $question = Question::findOrFail($id);
        return view('questions.show', compact('question'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question_author_name' => 'required',
            'question_lesson' => 'required',
            'question_subject' => 'required',
            'question_text' => 'required',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $question = Question::findOrFail($id);
        $question->question_author_name = $request->question_author_name;
        $question->question_lesson = $request->question_lesson;
        $question->question_subject = $request->question_subject;
        $question->question_text = $request->question_text;

        if ($request->hasFile('question_image')) {
            $imagePath = $request->file('question_image');
            $imageName = time() . '.' . $imagePath->getClientOriginalExtension();
            $imagePath->move(public_path('images'), $imageName);
            $question->question_image = '/images/' . $imageName;
        }

        $question->save();

        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }
}
