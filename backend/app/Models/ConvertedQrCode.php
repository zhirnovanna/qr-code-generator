<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConvertedQrCode extends Model
{
    protected $fillable = ['text', 'image_base64', 'filename'];
}
