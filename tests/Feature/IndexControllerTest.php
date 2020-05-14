<?php

namespace Tests\Feature;

use App\Saved;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_happy_path()
    {
        $this->get('/')
            ->assertOk()
            ->assertSeeText(config('app.name'))
        ;
    }

    public function test_happy_path_with_base64()
    {
        $json = '[{"rule":"required|string","value":"","disabled":false}]';
        $base64 = base64_encode($json);

        $this->get('/' . $base64)
            ->assertOk()
            ->assertSee($json, $escaped = false)
        ;
    }

    public function test_happy_path_with_saved()
    {
        $saved = factory(Saved::class)->create();

        $this->get('/' . $saved->hashid)
            ->assertOk()
            ->assertSee($saved->json, $escaped = false)
        ;
    }

    public function test_data_with_neither_base64_or_valid_hash()
    {
        $this->get('/' . 'not-a-base-64-string-or-valid-hash')
            ->assertOk()
            ->assertDontSee('not-a-base-64-string-or-valid-hash')
        ;
    }
}
