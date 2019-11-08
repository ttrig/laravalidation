<?php

namespace Tests\Feature;

use App\Saved;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaveControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_happy_path()
    {
        factory(Saved::class, 15)->create();

        $json = factory(Saved::class)->make()->json;

        $this->post('/save', compact('json'))->assertStatus(200);

        $this->assertDatabaseHas('saved', compact('json'));
    }

    public function test_user_limit()
    {
        factory(Saved::class, 15)->create(['ip' => '127.0.0.1']);

        $json = factory(Saved::class)->make()->json;

        $this->post('/save', compact('json'))
            ->assertStatus(422)
            ->assertSeeText('You saved to many entries to fast, try again later.')
        ;
    }
}
