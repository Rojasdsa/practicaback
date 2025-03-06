<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Retal;

class RetalesTest extends TestCase
{

    public function test_index_da_respuesta_200(): void
    {
        Retal::newFactory()->create();

        $response = $this->getJson('api/retales');

        $response->assertStatus(200);
    }
}
