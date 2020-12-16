<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * A mission is assigned a capsule.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function capsule()
    {
        return $this->belongsTo(Capsule::class);
    }
}
