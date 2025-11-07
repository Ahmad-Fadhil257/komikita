namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_original',
        'title_indonesia',
        'cover_image',
        'genre_id',
        'type',
        'story_concept',
        'author',
        'status',
        'age_rating'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function histories()
    {
        return $this->hasMany(ReadHistory::class);
    }
}
