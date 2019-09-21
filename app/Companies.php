<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employees;

class Companies extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

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

    protected $fillable = ['name', 'email', 'logo'];

    public function employees()
    {
        return $this->hasMany(Employees::class, 'company_id', 'id');
    }
}
