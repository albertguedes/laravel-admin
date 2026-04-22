<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\BlogApiService;
use Tests\TestCase;

class BlogApiServiceTest extends TestCase
{
    public function test_service_can_be_instantiated(): void
    {
        $service = new BlogApiService;
        $this->assertInstanceOf(BlogApiService::class, $service);
    }

    public function test_set_credentials_returns_self(): void
    {
        $service = new BlogApiService;
        $result = $service->setCredentials('http://example.com', 'token');
        $this->assertInstanceOf(BlogApiService::class, $result);
    }
}
