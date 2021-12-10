<?php

namespace Tests\Feature;

use Tests\TestCase;

class ValidationControllerTest extends TestCase
{
    public function test_disable_middleware_does_not_convert_empty_strings_to_null()
    {
        $this->postJson('/api/validate?disable-middleware', [
                'rule-1' => 'nullable',
                'value-1' => '',
            ])
            ->assertOk()
            ->assertJsonPath('value-1', '')
        ;
    }

    /**
     * @dataProvider provider
     */
    public function test_validation($data, $errorMessages = [])
    {
        $response = $this->postJson('/api/validate', $data);

        if ($errorMessages) {
            $response->assertUnprocessable()->assertJsonFragment($errorMessages);
        } else {
            $response->assertOk();
        }
    }

    public function provider()
    {
        return [
            'Filled value' => [
                ['rule-1' => 'required', 'value-1' => 'foobar'],
            ],
            'Empty value' => [
                ['rule-1' => 'required', 'value-1' => ''],
                ['value-1' => ['The value-1 field is required.']],
            ],
            'Null value' => [
                ['rule-1' => 'nullable', 'value-1' => null],
            ],
            'Absent value' => [
                ['rule-1' => 'present'],
                ['value-1' => ['The value-1 field must be present.']],
            ],
            'Empty rule' => [
                ['rule-1' => ''],
                ['rule-1' => ['The rule-1 field is required.']],
            ],
            'Invalid rule' => [
                ['rule-1' => 'req'],
                ['rule-1' => ['Method Illuminate\\Validation\\Validator::validateReq does not exist.']],
            ],
            'Unsupported rule without value' => [
                ['rule-1' => 'exists'],
                ['rule-1' => ['Not supported yet.']],
            ],
            'Unsupported rule with value' => [
                ['rule-1' => 'exists', 'value-1' => 'foobar'],
                ['rule-1' => ['Not supported yet.']],
            ],
        ];
    }
}
