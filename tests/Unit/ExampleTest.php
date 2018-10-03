<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cache;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetWindTest()
    {
        $response = $this->json('GET', '/wind/89118');

        $response
            ->assertStatus(200)
            ->assertJson([
                'wind' => true
            ]);

    }

    public function testMockResponse()
    {
        $response = $this->json('GET', '/wind/11111');

        $response
            ->assertStatus(200)
            ->assertJson([
                'error' => true,
            ]);

    }

    public function testCacheLayer()
    {
        $response = ['wind' => ['speed' => '10.5', 'direction' => '15']];
        if (!Cache::has('12345')) Cache::put('12345', json_encode($response), 15);

            $this->json('GET', '/wind/12345')
                ->assertStatus(200)
                ->assertJson([
                    'wind' => true
                ]);

    }
}
