<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function taskIndex()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function taskStore()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
