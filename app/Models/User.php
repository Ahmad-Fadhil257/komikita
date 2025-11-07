namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
v
    protected $fillable = ['name', 'password', 'profile_image', 'role'];

    protected $hidden = ['password'];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function histories()
    {
        return $this->hasMany(ReadHistory::class);
    }
}
