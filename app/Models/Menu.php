<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use UuidModel;

    public $table = 'menus';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    protected $fillable = ['name', 'slug', 'parent_id', 'icon'];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_roles', 'menu_id', 'role_id');
    }

    public function roleMenus()
    {
        return $this->hasMany(MenuRole::class);
    }
}
