<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Service\UrlShortener;
use Ariaieboy\LaravelSafeBrowsing\LaravelSafeBrowsing;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ShortUrlController extends Controller
{
    public function __construct(private UrlShortener $urlShortener)
    {
    }

    public function index(): Response
    {
        return Inertia::render('ShortUrl', [
            'isSafeUrl' => true
        ]);
    }

    public function show(string $shortUrl): RedirectResponse
    {
        $longUrl = $this->urlShortener->getLongUrl($shortUrl);
        if ($longUrl === null) {
            abort(404);
        }

        return Redirect::to($longUrl, 301);
    }

    /**
     * Example unsafe URLs
     * https://testsafebrowsing.appspot.com/s/malware.html
     * https://testsafebrowsing.appspot.com/s/unwanted.html
     * https://testsafebrowsing.appspot.com/s/phishing.html
     * All: https://testsafebrowsing.appspot.com
     *
     * @throws BindingResolutionException
     * @throws \Exception
     */
    public function create(Request $request, LaravelSafeBrowsing $laravelSafeBrowsing, UrlShortener $urlShortener): Response
    {
        $request->validate([
            'long_url' => 'required|url',
        ]);

        $longUrl = $request->input('long_url');

        $threatType = $laravelSafeBrowsing->isSafeUrl($longUrl, true);
        if (gettype($threatType) === 'string') {
            return Inertia::render('ShortUrl', [
                'isSafeUrl' => false,
                'threatType' => $threatType
            ]);
        } elseif ($threatType === false) {
            return Inertia::render('ShortUrl', [
                'isSafeUrl' => false,
                'threatType' => ''
            ]);
        }

        $shortUrl = $urlShortener->create($longUrl);

        // finally show the generated short URL
        return Inertia::render('ShortUrl', [
            'short_url' => config('app.short_url_domain') . $shortUrl,
            'isSafeUrl' => true
        ]);
    }
}
