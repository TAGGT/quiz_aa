<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\Advice_picture;
use App\Models\Advice_text;

class AdviceController extends Controller
{
    // アドバイスの文章を保存
    public function storeAdviceText(Request $request, $quiz)
    {
        $validated_data = $request->validate([
            'text' => 'required|string',
        ]);

        $advice = Advice_text::create([
            'text' => $validated_data['text'],
            'quiz_id' => $quiz,
            'user_id' => Auth::id(),
        ]);

        return response()->json($advice);
    }

    // アドバイスを取得
    public function getAdvice(Quiz $quiz)
    {
        $advice = Advice_text::where('quiz_id', $quiz->id)->get();
        return response()->json($advice);
    }

}
