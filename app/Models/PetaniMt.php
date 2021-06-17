<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PetaniMt
 * @property $id
 * @property $petani_id
 * @property $qty
 * @property $produk
 * @property $mt
 * @property $tahun
 * @property $type
 * @package App\Models
 */
class PetaniMt extends Model
{
    use UuidModel, SoftDeletes;

    const TYPE_STOCK = 'stock';
    const TYPE_ORDER = 'order';

    public $table = 'petani_mt';

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

    protected $fillable = ['id', 'petani_id', 'qty', 'produk', 'mt', 'tahun', 'qty_beli', 'type'];

    public function petani()
    {
        return $this->belongsTo(Petani::class, 'petani_id', 'id');
    }
}
