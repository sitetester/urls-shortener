<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UrlsInfo
 *
 * @property int $id
 * @property string $longUrl
 * @property string $longUrlHash
 * @property string $shortUrl
 * @method static Builder|UrlsInfo newModelQuery()
 * @method static Builder|UrlsInfo newQuery()
 * @method static Builder|UrlsInfo query()
 * @method static Builder|UrlsInfo whereId($value)
 * @method static Builder|UrlsInfo whereLongUrl($value)
 * @method static Builder|UrlsInfo whereLongUrlHash($value)
 * @method static Builder|UrlsInfo whereShortUrl($value)
 * @mixin \Eloquent
 */
class UrlsInfo extends Model
{
    use HasFactory;

    protected  $table = 'urls_info';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected string $longUrl;
    protected string $longUrlHash;
    protected string $shortUrl;
}
