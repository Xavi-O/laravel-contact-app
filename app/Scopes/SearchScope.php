<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;


class SearchScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if ($search = request('search')) 
        {
            $builder->where('first_name', 'like', "%{$search}%");
            $builder->orWhere('last_name', 'like', "%{$search}%");
            $builder->orWhere('email', 'like', "%{$search}%");
            $builder->orWhereHas('company', function($query) use($search){
                $query->Where('name', 'like', "%{$search}%");
            });
        }
    }
}