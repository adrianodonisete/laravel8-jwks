<?php

use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('home.index');
// });

Route::get('/home', [HomeController::class, 'index']);


Route::get('/token', function () {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://dev-4-6mu9a8.us.auth0.com/oauth/token",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\"client_id\":\"e2qvBcoYK0TUfbkGzbXcZwgysXaWKCkN\",\"client_secret\":\"YBkr1n1eRjBzM3G4IBppDpkjEPsRhQFT4TiVlcyjjKAAwZvArWp5wR2nmS7Ug5kw\",\"audience\":\"https://quickstarts/api\",\"grant_type\":\"client_credentials\"}",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/json"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    // if ($err) {
    //   echo "cURL Error #:" . $err;
    // } else {
    //   echo $response;
    // }

    $array = json_decode($response, true);

    return response()->json($array, 200);
});
