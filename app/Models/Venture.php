<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venture extends Model {
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function users() {
        return $this->morphMany(User::class, 'typeable');
    }

    public function scopeFilter($query, array $filters) {
        $query->when(
            $filters['search-business'] ?? false,
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        );
    }

    public function getRouteKeyName() {
        return 'name';
    }
}
