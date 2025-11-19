<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'comic_id'];

    // Tabel bookmarks hanya memiliki `created_at` (tidak ada `updated_at`).
    // Mengatur UPDATED_AT ke null agar Eloquent tidak mencantumkan kolom `updated_at` pada insert/update.
    public const UPDATED_AT = null;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comic()
    {
        return $this->belongsTo(Comics::class);
    }
}
