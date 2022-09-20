<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrintTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_print()
    {
        $response = $this->postJson('/api/print', [
            'data'=>[
                'file_name'=>'hello',
                'html'=>'<p> Hello, World </p>'
            ]
        ]);

        $response->assertStatus(200);
    }
}
