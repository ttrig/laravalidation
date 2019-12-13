<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class ExampleController extends BaseController
{
    public function __invoke($slug)
    {
        $json = method_exists($this, $method = 'example' . Str::studly($slug))
            ? json_encode($this->$method())
            : null
        ;

        return view('index', compact('json'));
    }

    private function exampleRequired(): array
    {
        return [
            [
                'rule' => 'required',
                'value' => 'foobar',
                'disabled' => false,
            ],
            [
                'rule' => 'required',
                'value' => '',
                'disabled' => false,
            ],
            [
                'rule' => 'required_with:value-1',
                'value' => '',
                'disabled' => false,
            ],
            [
                'rule' => 'required_without:value-1',
                'value' => '',
                'disabled' => false,
            ],
            [
                'rule' => 'required_if:value-1,foobar',
                'value' => '',
                'disabled' => false,
            ],
            [
                'rule' => 'required_unless:value-1,foobar',
                'value' => '',
                'disabled' => false,
            ],
        ];
    }

    private function exampleNullable(): array
    {
        return [
            [
                'rule' => 'nullable',
                'value' => 'foobar',
                'disabled' => false,
            ],
            [
                'rule' => 'nullable',
                'value' => '',
                'disabled' => false,
            ],
            [
                'rule' => 'nullable',
                'value' => null,
                'disabled' => false,
            ],
        ];
    }

    private function exampleFilled(): array
    {
        return [
            [
                'rule' => 'filled',
                'value' => 'foobar',
                'disabled' => false,
            ],
            [
                'rule' => 'filled',
                'value' => '',
                'disabled' => false,
            ],
            [
                'rule' => 'filled',
                'value' => null,
                'disabled' => false,
            ],
        ];
    }

    private function examplePresent(): array
    {
        return [
            [
                'rule' => 'present',
                'value' => 'foobar',
                'disabled' => false,
            ],
            [
                'rule' => 'present',
                'value' => '',
                'disabled' => false,
            ],
            [
                'rule' => 'present',
                'value' => null,
                'disabled' => false,
            ],
        ];
    }

    private function exampleSometimes(): array
    {
        return [
            [
                'rule' => 'sometimes|required',
                'value' => 'foobar',
                'disabled' => false,
            ],
            [
                'rule' => 'sometimes',
                'value' => '',
                'disabled' => false,
            ],
            [
                'rule' => 'sometimes|required',
                'value' => '',
                'disabled' => false,
            ],
            [
                'rule' => 'sometimes',
                'value' => null,
                'disabled' => false,
            ],
        ];
    }

    private function exampleRegex(): array
    {
        return [
            [
                'rule' => 'regex:/^([0-9a-f]{2}:){5}[0-9a-f]{2}$/i',
                'value' => '01:23:45:67:89:AB',
                'disabled' => false,
            ],
            [
                'rule' => 'not_regex:/^bar/i',
                'value' => 'foobar',
                'disabled' => false,
            ],
        ];
    }
}
