<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;

use Illuminate\Http\Request;

class AnswerQuestionController extends Controller
{
    public function showQuestion($questionId)
    {
        $question = Question::with('answers')->findOrFail($questionId);
        return view('answerQuestion', compact('question'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'question_id' => 'required|exists:questions,id',
                'answer_text' => 'nullable',
                'answer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Retrieve the question based on the question_id sent with the request
            $question = Question::findOrFail($request->question_id);

            // Retrieve the author name from the question
            $answer_author_name = $question->question_author_name;

            // Create a new answer instance
            $answer = new Answer();
            $answer->answer_author_name = $answer_author_name;
            $answer->question_id = $request->question_id;

            if ($request->has('answer_text')) {
                $answer->answer_text = $request->answer_text;
            }else {
                $answer->answer_text = null;
            }

            if ($request->hasFile('answer_image')) {
                $imagePath = $request->file('answer_image');
                $imageName = time() . '.' . $imagePath->getClientOriginalExtension();
                $imagePath->move(public_path('images'), $imageName);
                $answer->answer_image = '/images/' . $imageName;
            } else {
                $answer->answer_image = null;
            }


            $answer->save();

            $question->question_status = 1;

            $question->save();


            return back()->with('success', 'Answer created successfully.');

        } catch (\Exception $e) {
            // Handle the case where the question cannot be found
            return back()->withErrors(['error' => 'The question could not be found.'])->withInput();
        }
    }

}
