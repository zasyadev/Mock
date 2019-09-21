<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Companies;

class Employees extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = ['first_name', 'last_name', 'email','phone'];

    public function company()
    {
        return $this->belongsTo(Companies::class);
    }

    public function getNameAttribute() 
    {
        return $this->first_name.' '.$this->last_name;
    }
}
