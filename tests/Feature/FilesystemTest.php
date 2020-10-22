<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $headers = [
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ];
        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();

        return $this->call('GET', $uri, $parameters, $cookies, [], $server);
    }

    /**
     * Test file not found.
     *
     * @return void
     */
    public function testFileNotFound()
    {
        $response = $this->get($this->apiPrefix . '/', [
            'path' => $this->faker->sentence  . $this->faker->fileExtension,
        ]);

        $response->assertStatus(404);
    }

    public function testNoPathGiven()
    {
        $response = $this->get($this->apiPrefix . '/?path=');

        $response->assertStatus(422);
    }


    public function testPermissionDeniedForRequestedFile()
    {
        $response = $this->get($this->apiPrefix . '/', [
            'path' => '../' . $this->faker->sentence  . $this->faker->fileExtension,
        ]);

        $response->assertStatus(403);
    }

    public function testFileRetrievedSuccessfully()
    {

    }

}
