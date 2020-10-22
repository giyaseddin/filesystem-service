<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilesystemTest extends TestCase
{
    use WithFaker;
    protected $apiPrefix = "api/files/";

    /**
     * Visit the given URI with a GET request.
     *
     * @param string $uri
     * @param array $parameters
     * @param array $headers
     * @return \Illuminate\Testing\TestResponse
     */
    public function get($uri, array $parameters = [], array $headers = [])
    {
        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();

        return $this->call('GET', $uri, $parameters, $cookies, [], $server);
    }

    /**
     * Test file not found.
     *
     * @return void
     */
    public function testFileDoesntExist()
    {
        $response = $this->get($this->apiPrefix . '/', [
            'path' => $this->faker->word,
        ]);

        $response->assertStatus(404);
    }

    public function testFilePathIsRequired()
    {
        $response = $this->get($this->apiPrefix . '/');

        $response->assertStatus(400);
    }

}
