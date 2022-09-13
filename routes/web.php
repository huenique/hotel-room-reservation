<?php

use Illuminate\Http\Request;
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

const ROOM_RATE = 1500;
const IMAGE_DIR = '../public/images';

Route::get('/', function () {
    return view('reservation');
});

Route::post('/', function (Request $request) {
    $request->validate([
        'checkInDate' => 'required',
        'checkOutDate' => 'required',
        'numberOfRooms' => 'required',
    ]);

    if ($request->numberOfRooms < 1) {
        return view('reservation');
    }

    $numberOfRooms = $request->numberOfRooms;
    $numberOfDays = $request->numberOfDays;

    $images = scandir(IMAGE_DIR);
    $selectedImages = array_slice($images, 2, $numberOfRooms);
    $selectedRooms = array_map(function ($img) {
        return '<img src=images/' . $img . ' alt="Room Image" width="40%">';
    }, $selectedImages);

    $numberOfDays = abs((strtotime($request->checkInDate) - strtotime($request->checkOutDate)) / (60 * 60 * 24));
    $totalAmount = $numberOfRooms * $numberOfDays * ROOM_RATE;
    $discount = $totalAmount * ($numberOfRooms >= 3 ? 0.1 : 0);

    $data = [
        'roomRate' => number_format(ROOM_RATE, 2),
        'numberOfDays' => $numberOfDays,
        'numberOfRooms' => $numberOfRooms,
        'roomFee' => number_format($totalAmount, 2),
        'discount' => number_format($discount, 2),
        'totalAmount' => number_format($totalAmount -= $discount, 2),
        'selectedRooms' => $selectedRooms,
    ];

    return view('reservation', $data);
});
