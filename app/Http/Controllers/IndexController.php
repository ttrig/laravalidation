<?php

namespace App\Http\Controllers;

use App\Saved;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    public function __invoke(Request $request, $someValue = null)
    {
        $json = $this->jsonFromBase64($someValue)
             ?? $this->jsonFromSaved($someValue)
             ?? $this->jsonFromDefault()
        ;

        return view('index', compact('json'));
    }

    private function jsonFromBase64($encodedString): ?string
    {
        try {
            $json = base64_decode($encodedString);
        } catch (\Exception $_) {
            return null;
        }

        if (json_decode($json, false, 10)) {
            return $json;
        }

        return null;
    }

    private function jsonFromSaved($hashId): ?string
    {
        return $hashId ? optional(Saved::hashid($hashId)->first())->json : null;
    }

    private function jsonFromDefault(): string
    {
        return json_encode([
            [
                'rule' => 'required|string',
                'value' => 'foobar',
                'disabled' => false,
            ],
            [
                'rule' => 'required_with:value-1|numeric',
                'value' => '',
                'disabled' => false,
            ],
            [
                'rule' => 'invalid-rule',
                'value' => '',
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
                'value' => null,
                'disabled' => true,
            ],
        ]);
    }
}
