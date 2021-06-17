<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Petani
 * @package App\Models
 * @property $id
 * @property $no
 * @property $nik
 * @property $nama
 * @property $rencana_tanam
 * @property $kelompok
 */
class Petani extends Model
{
    use UuidModel, SoftDeletes;

    public $table = 'petani';

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

    protected $fillable = ['id', 'no', 'nik', 'nama', 'rencana_tanam', 'kelompok'];

    public function petaniMt() {
        return $this->hasMany(PetaniMt::class, 'petani_id', 'id');
    }
}
