<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\ConvertedQrCode;

Route::post('/qrcodes', function (Request $request) {
    $text = (string) $request->input('text', '');

    if ($text === '') {
        return response()->json(['message' => 'text is required'], 422);
    }

    $qr = new QrCode($text);
    $writer = new PngWriter();
    $png = $writer->write($qr);
    $bytes = $png->getString();

    $base64 = 'data:image/png;base64,'.base64_encode($bytes);

    $record = ConvertedQrCode::create([
        'text' => $text,
        'image_base64' => $base64,
    ]);

    return response()->json($record, 201);
});

Route::get('/qrcodes', function () {
    return ConvertedQrCode::orderBy('created_at', 'desc')
        ->get(['id','text','image_base64','created_at']);
});
