<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model {
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function users() {
        return $this->morphMany(User::class, 'typeable');
    }

    public function joinRequests(){
        return $this->morphMany(JoinRequest::class, 'typeable');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filters) {
        $query->when(
            $filters['search-business'] ?? false,
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        );

        // $query->when(
        //     $filters['category'] ?? false,
        //     fn ($query, $category) =>
        //     $query->whereHas(
        //         'category',
        //         fn ($query) =>
        //         $query->where('slug', $category)
        //     )
        // );
    }
}
