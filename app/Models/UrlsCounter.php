<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UrlsCounter
 *
 * @property int $shortUrlsCounter
 * @method static Builder|UrlsCounter newModelQuery()
 * @method static Builder|UrlsCounter newQuery()
 * @method static Builder|UrlsCounter query()
 * @property int $id
 * @method static Builder|UrlsCounter whereId($value)
 * @method static Builder|UrlsCounter whereShortUrlsCounter($value)
 * @mixin \Eloquent
 */
class UrlsCounter extends Model
{
    protected  $table = 'urls_counter';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected int $shortUrlsCounter;
}
