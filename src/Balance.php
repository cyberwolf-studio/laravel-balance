<?php

namespace Batv45\Balance;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Balance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'balanceable_type',
        'balanceable_id',
        'amount',
        'referenceable_type',
        'referenceable_id',
        'description',
    ];

    protected $casts = [
        'amount' => 'integer'
    ];

    /**
     * Balance constructor.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('balance.table', 'balance_history'));
    }

    public function scopeSumBalance($query): void
    {
        $query->select(DB::raw('balance_history.*,(SUM(T2.amount)) as balance'))
            ->from('balance_history')
            ->join('balance_history AS T2','T2.id','<=','balance_history.id')
            ->groupBy('balance_history.id');
    }

    /**
     * Get the balance amount transformed to currency.
     *
     * @return float|int
     */
    public function getAmountAttribute()
    {
        return $this->attributes['amount'];
    }

    /**
     * Get the parent of the balance record.
     *
     * @return MorphTo
     */
    public function balanceable()
    {
        return $this->morphTo();
    }

    /**
     * Obtain the model for which the balance sheet movement was made
     *
     * @return MorphTo
     */
    public function referenceable()
    {
        return $this->morphTo();
    }
}
