<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleControllerTest extends TestCase
{
    public function test_unknown_example()
    {
        $this->get('/example/foobar')
            ->assertOk()
            ->assertSee('json=""', escape: false)
        ;
    }

    /**
     * @dataProvider exampleProvider
     */
    public function test_happy_path($name, $needle)
    {
        $this->get("/example/$name")
            ->assertOk()
            ->assertSee(htmlentities($needle), escape: false)
        ;
    }

    public function exampleProvider()
    {
        return [
            ['required', '"required_unless:value-1,foobar",'],
            ['exclude', '"exclude_if:value-1,foo'],
            ['nullable', '"nullable",'],
            ['filled', '"filled",'],
            ['present', '"present",'],
            ['sometimes', '"sometimes",'],
            ['regex', '"regex:\/'],
        ];
    }
}
