<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Models\SalesCommission;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/clients', ClientController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/chart', function () {
        $fields = implode(',',SalesCommission::getColumns());
        $question = 'Gere um grafico de barras com o total de vendas por vendedor';
        exit();
        $config = \OpenAI\Laravel\Facades\OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Considerando os campos ($fields), gere uma configuração json do Vega-lite v5  (sem campo de dados e com descricao) que atenda o seguinte pedido $question. Resposta: ",
            'max_tokens' => 1000,
        ])->choices[0]->text;
    });
});

require __DIR__.'/auth.php';
