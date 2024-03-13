<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Quiz;
use App\Models\Quiz_block;
use App\Models\Category;
use App\Models\Advice_picture;
use App\Models\Advice_text;



class QuizController extends Controller
{
    //　保存
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $quiz_block = Quiz_block::create([
            'user_id' => Auth::id(),
            "category_id" => $validated_data["category_id"],
            "name" => $validated_data["name"],
            "description" => $validated_data["description"],
        ]);

        $quiz_block->load('user');


        
        return response()->json($quiz_block);
    }

    //　削除
    public function deleteQuizBlock(Quiz_block $quiz_block)
    {
        $quiz_block->delete();

        // return response()->json($quiz_block);
    }

    //　IDを指定して取得
    public function getQuizBlock(Quiz_block $quiz_block)
    {
        // $quiz_block = Quiz_block::find($quiz_block);
        $quiz_block->load('quizzes');

        return response()->json($quiz_block);
    }

    //　20件取得
    public function getProblem(Quiz_block $quiz_block)
    {
        $quiz_block->load('quizzes');

        $quizzes = $quiz_block->quizzes->shuffle()->take(20);

        return response()->json($quizzes);
    }

    //　自身が作成したものを取得
    public function getMyQuizBlock()
    {
        $user = Auth::user();
        $user->load('quiz_blocks');

        return response()->json($user->quiz_blocks);
    }
    
    public function storeQuizColumn(Quiz_block $quiz_block, Request $request)
    {
        $validated_data = $request->validate([
            'text'      => 'required',
            'answer'    => 'required',
            'choice1'   => 'required',
            'choice2'   => 'required',
            'choice3'   => 'required',
        ]);

        $quiz = Quiz::create([
            'quiz_block_id' => $quiz_block->id,
            'text'          => $validated_data['text'],
            'answer'        => $validated_data['answer'],
            'choice1'       => $validated_data['choice1'],
            'choice2'       => $validated_data['choice2'],
            'choice3'       => $validated_data['choice3'],
        ]);


        return response()->json($quiz);
    }

    public function updateQuiz(Quiz $quiz, Request $request)
    {
        $validated_data = $request->validate([
            'text' => 'required',
            'answer' => 'required',
            'choice1' => 'required',
            'choice2' => 'required',
            'choice3' => 'required',
        ]);

        $quiz->update([
            'text' => $validated_data['text'],
            'answer' => $validated_data['answer'],
            'choice1' => $validated_data['choice1'],
            'choice2' => $validated_data['choice2'],
            'choice3' => $validated_data['choice3'],
        ]);

        return response()->json($quiz);
    }

    public function deleteQuiz(Quiz $quiz)
    {
        $quiz->delete();
    }

    public function searchQuizBlock(Request $request)
    {
        $validated_data = $request->validate([
            'category_id' => 'integer',
            'keyword' => 'nullable|string',
        ]);

        if($validated_data['category_id'] !== -1){
            $quiz_blocks = Quiz_block::where('category_id', $validated_data['category_id']);
        }
        
        if($validated_data['keyword']){
            $quiz_blocks = Quiz_block::where('name', 'like', "%{$validated_data['keyword']}%");
        }

        $quiz_blocks = $quiz_blocks->get();

        return response()->json($quiz_blocks);

    }
}
