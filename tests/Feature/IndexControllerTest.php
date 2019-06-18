<?php

namespace Tests\Feature;

use App\Saved;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    public function test_happy_path()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSeeText(config('app.name'))
        ;
    }

    public function test_happy_path_with_base64()
    {
        $json = '{"rule-1":"required|string","value-1":""}';
        $base64 = base64_encode($json);

        $this->get('/' . $base64)
            ->assertStatus(200)
            ->assertSee($json)
        ;
    }

    public function test_happy_path_with_saved()
    {
        $saved = factory(Saved::class)->create();

        $this->get('/' . $saved->hashid)
            ->assertStatus(200)
            ->assertSee($saved->json)
        ;
    }
}
