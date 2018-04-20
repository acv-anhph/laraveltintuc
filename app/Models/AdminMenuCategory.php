<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMenuCategory extends Model
{
    protected $table = 'admin_menu_category';

    public function child()
    {
        return $this->hasMany('App\Models\AdminMenuCategory', 'parent_id', 'id');
    }

    public function allChildren()
    {
        return $this->child()->with('allChildren');
    }
}
