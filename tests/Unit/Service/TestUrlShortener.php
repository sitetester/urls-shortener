<?php
declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Service\Bijective;
use App\Service\UrlShortener;
use Illuminate\Foundation\Testing\TestCase;

class TestUrlShortener extends TestCase
{
    private UrlShortener $urlShortener;

    protected function setUp(): void
    {
        parent::setUp();
        $this->urlShortener = new UrlShortener(new Bijective());
    }

    public function createApplication()
    {
        $app = require __DIR__ . '/../../../bootstrap/app.php';
        $app->loadEnvironmentFrom('.env.testing');
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        return $app;
    }

    /**
     * @throws \Exception
     */
    public function test_create_short_url()
    {
        $longUrl = "https://www.phplab.info/categories/laravel/how-to-specify-a-separate-database-for-unit-testing-on-laravel-5";
        self::assertNotEmpty($this->urlShortener->create($longUrl));
    }

    /**
     * @throws \Exception
     */
    public function test_short_url_is_created_once()
    {
        $longUrl = "https://www.php.net/manual/en/";
        $shortUrl = $this->urlShortener->create($longUrl);
        self::assertEquals($shortUrl, $this->urlShortener->create($longUrl));
    }

    /**
     * @throws \Exception
     */
    public function test_can_create_short_urls_for_2_different_long_urls()
    {
        self::assertNotEmpty(
            $this->urlShortener->create("https://www.php.net/releases/8.1/en.php")
        );

        self::assertNotEmpty(
            $this->urlShortener->create("https://www.php.net/releases/8.2/en.php")
        );
    }

    /**
     * @throws \Exception
     */
    public function test_can_give_back_long_url()
    {
        $longUrl = "https://www.php.net/releases/8.1/en.php";
        $shortUrl = $this->urlShortener->create($longUrl);
        self::assertEquals($longUrl, $this->urlShortener->getLongUrl($shortUrl));
    }
}
