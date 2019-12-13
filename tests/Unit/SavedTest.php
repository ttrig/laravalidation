<?php

namespace Tests\Unit;

use App\Saved;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Vinkla\Hashids\Facades\Hashids;

class SavedTest extends TestCase
{
    use RefreshDatabase;

    public function test_scopeHashid_returns_correct_model()
    {
        $saved = factory(Saved::class)->create();

        $result = Saved::hashid($saved->hashid)->firstOrFail();

        $this->assertEquals($saved->id, $result->id);
    }

    public function test_getHashidAttribute_returns_correct_hashid()
    {
        $saved = factory(Saved::class)->create();

        $this->assertNotEmpty($saved->hashid);
        $this->assertEquals(Hashids::decode($saved->hashid)[0], $saved->id);
    }
}
