<?php

namespace Tests\Feature;

use Tests\TestCase;

class ValidationControllerTest extends TestCase
{
    public function test_disable_middleware_does_not_convert_empty_strings_to_null()
    {
        $this->postJson('/validate?disable-middleware', [
                'rule-1' => 'nullable',
                'value-1' => '',
            ])
            ->assertOk()
            ->assertJsonPath('value-1', '', $strict = true)
        ;
    }

    /**
     * @dataProvider provider
     */
    public function test_validation($data, $messages)
    {
        $response = $this->postJson('/validate', $data);

        if ($messages) {
            $response->assertStatus(422)
                ->assertJsonFragment($messages);
        } else {
            $response->assertOk();
        }
    }

    public function provider()
    {
        return [
            [
                [
                    'rule-1' => 'required|string',
                    'value-1' => 'foobar',
                ],
                [],
            ],
            [
                ['rule-1' => ''],
                ['rule-1' => ['The rule-1 field is required.']],
            ],
            [
                ['rule-1' => 'req'],
                ['rule-1' => ['Method Illuminate\\Validation\\Validator::validateReq does not exist.']],
            ],
            [
                ['rule-1' => 'exists'],
                ['rule-1' => ['Not supported yet.']],
            ],
            [
                [
                    'rule-1' => 'required|string',
                    'value-1' => '',
                ],
                ['value-1' => ['The value-1 field is required.']],
            ],
            [
                [
                    'rule-1' => 'exists',
                    'value-1' => '',
                ],
                ['rule-1' => ['Not supported yet.']],
            ],
        ];
    }
}
