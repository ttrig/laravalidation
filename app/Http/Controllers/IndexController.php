<?php

namespace App\Http\Controllers;

use App\Saved;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    public function __invoke($data = null)
    {
        $json = $this->jsonFromBase64($data)
             ?? $this->jsonFromSaved($data)
             ?? $this->jsonFromDefault()
        ;

        return view('index', compact('json'));
    }

    private function jsonFromBase64($encodedString): ?string
    {
        if (! $json = base64_decode($encodedString, $strict = true)) {
            return null;
        }

        if (json_decode($json, false, 10)) {
            return $json;
        }

        return null;
    }

    private function jsonFromSaved(?string $hashId): ?string
    {
        return $hashId ? optional(Saved::hashid($hashId)->first())->json : null;
    }

    private function jsonFromDefault(): string
    {
        return json_encode([
            [
                'rule' => 'filled|string',
                'value' => 'foobar',
                'disabled' => false,
            ],
            [
                'rule' => 'required_with:value-1|ip',
                'value' => request()->ip(),
                'disabled' => false,
            ],
            [
                'rule' => 'nullable|date',
                'value' => now()->toDateString(),
                'disabled' => false,
            ],
            [
                'rule' => 'regex:/^([0-9a-f]{2}:){5}[0-9a-f]{2}$/i',
                'value' => '01:23:45:67:89:AB',
                'disabled' => false,
            ],
            [
                'rule' => 'nullable|in:foo,bar',
                'value' => 'foo',
                'disabled' => true,
            ],
            [
                'rule' => 'invalid-rule',
                'value' => null,
                'disabled' => false,
                'send_value' => false,
            ],
        ]);
    }
}
