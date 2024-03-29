<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ExampleControllerTest extends TestCase
{
    public function test_unknown_example()
    {
        $this->get('/example/foobar')
            ->assertOk()
            ->assertSee('<template id="initial-rows"></template>', escape: false);
    }

    #[DataProvider('exampleProvider')]
    public function test_happy_path($name, $needle)
    {
        $this->get("/example/$name")
            ->assertOk()
            ->assertSee(htmlentities($needle), escape: false);
    }

    public static function exampleProvider()
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
