<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;
use App\Scopes\SearchScope;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'address', 'company_id', 'user_id'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }

    protected static function booted()
    {
        static::addGlobalScope(new FilterScope);
        static::addGlobalScope(new SearchScope);
    }
}
/*
["first_name" => "John", "last_name" => "Doe", "email" => "johndoe@test.com", "address" => "john address"]
["first_name" => "Jane", "last_name" => "Roe", "email" => "janeroe@test.com", "address" => "jane address"]
[$contact1, $contact2]
*/