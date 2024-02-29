<?php
declare(strict_types=1);

namespace App\Service;

use App\Models\UrlsCounter;
use App\Models\UrlsInfo;
use Illuminate\Support\Facades\DB;

class UrlShortener
{
    public function __construct(private readonly Bijective $bijective)
    {
    }

    /**
     * @throws \Exception
     */
    public function create(string $longUrl): string
    {
        // Counter should be read & updated together
        DB::beginTransaction();
        $urlsCounter = UrlsCounter::first();
        $initNum = $urlsCounter === null ? 0 : $urlsCounter->shortUrlsCounter;
        $num = NumsHelper::from($initNum);
        $str = $this->bijective->encode($num);

        $longUrlHash = hash('sha256', $longUrl);
        $urlsInfo = UrlsInfo::query()->firstWhere('longUrlHash', '=', $longUrlHash);
        if ($urlsInfo === null) {
            $urlsInfo = new UrlsInfo();
            $urlsInfo->longUrl = $longUrl;
            $urlsInfo->longUrlHash = $longUrlHash;
            $urlsInfo->shortUrl = $str;
            $urlsInfo->save();

            if ($urlsCounter === null) {
                $urlsCounter = new UrlsCounter();
            }
            $urlsCounter->shortUrlsCounter = $num;
            $urlsCounter->save();
        }
        DB::commit();

        return $urlsInfo->shortUrl;
    }

    public function getLongUrl(string $shortUrl): ?string
    {
        $urlsInfo = UrlsInfo::query()->firstWhere('shortUrl', '=', $shortUrl);
        return $urlsInfo?->longUrl;
    }
}
