<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {

    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // ***********🌚quiz関係ここから******************************************************************
    //　会得

    //　自身が作成したものを取得
    Route::get('/quizzes/home', [QuizController::class, 'getMyQuizBlock']);

    //IDを指定して取得
    Route::get('/quizzes/{quiz_block}', [QuizController::class, 'getQuizBlock']);

    // 10件取得
    Route::get('/answer/{quiz_block}', [QuizController::class, 'getProblem']);

    //　検索
    Route::get('/search', [QuizController::class, 'searchQuizBlock']);


    //　作成
    Route::post('/quizzes', [QuizController::class, 'store']);

    //　更新

    //　削除
    Route::delete('/quizzes/{quiz_block}', [QuizController::class, 'deleteQuizBlock']);


    // *********** 🙆advice関係ここから******************************************************************
    Route::post('/answer/{quiz}/text', [AdviceController::class, 'storeAdviceText']);
    Route::get('/answer/{quiz}/text', [AdviceController::class, 'getAdvice']);

    // `/api/answer/${quizzes[phase].id}/text

    
    // ***********🌛quiz column関係ここから******************************************************************

    //　追加
    Route::post('/columns/{quiz_block}', [QuizController::class, 'storeQuizColumn']);

    //　更新
    Route::put('/columns/{quiz}', [QuizController::class, 'updateQuiz']);

    //　削除
    Route::delete('/columns/{quiz}', [QuizController::class, 'deleteQuiz']);

    // ***********⏺category関係ここから******************************************************************
    Route::get('/categories', [CategoryController::class, 'index']);


});
