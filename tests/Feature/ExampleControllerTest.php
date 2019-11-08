<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleControllerTest extends TestCase
{
    public function test_happy_path()
    {
        $this->get('/example/required')
            ->assertOk()
            ->assertSeeText('"required_unless:value-1,foobar"')
        ;
    }

    public function test_unknown_example()
    {
        $this->get('/example/foobar')
            ->assertOk()
            ->assertSee('<script id="json-rows" type="text/template"></script>')
        ;
    }
}
