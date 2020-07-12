<?php

namespace Tests\Feature\Components;

use Illuminate\Http\Response;
use Tests\TestCase;

class GameFeatureTest extends TestCase
{
    /**
     * @test
     */
    public function play_works(): void
    {
        $response = $this->request('GET', '/api/rock-paper-scissors/play');

        $content = json_decode($response->getContent());

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
            'data' => [],
            'meta' => ['success', 'errors'],
        ]);

        $this->assertTrue($content->meta->success);
        $this->assertEmpty($content->meta->errors);
        $this->assertNotEmpty($content->data);
    }
}
