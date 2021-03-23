<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table          = 'vexsol_countrys';
    protected $primaryKey     = 'COUNTRY_CODE';
    public    $timestamps     = false;
    public $incrementing = false;
    /**,
     * define which attributes are mass assignable (for security)
     *
     * @var array
     */
    protected $fillable = [];
    
}
