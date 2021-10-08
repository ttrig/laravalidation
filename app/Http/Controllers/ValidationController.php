<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ValidationController extends Controller
{
    public function __invoke(Request $request)
    {
        $validate = [];
        $ruleErrors = [];
        $unsupportedRules = '/^unique|exists|dimensions|file|mimetypes|mimes/i';

        foreach ($this->getRuleIds($request) as $id) {
            $ruleKey = "rule-$id";
            $rule = $request->input($ruleKey) ?? 'required|string';

            /** @var \Illuminate\Validation\Validator */
            $ruleValidator = Validator::make($request->all(), [$ruleKey => $rule]);

            try {
                $ruleValidator->passes();
                $validate[$ruleKey] = 'required|string';
                $validate["value-$id"] = $rule;
            } catch (\Exception $e) {
                $ruleErrors[$ruleKey] = preg_match($unsupportedRules, $rule)
                    ? 'Not supported yet.'
                    : $e->getMessage();
            }
        }

        $validator = Validator::make($request->all(), $validate);

        $validator->after(function ($validator) use ($ruleErrors) {
            foreach ($ruleErrors as $field => $error) {
                $validator->errors()->add($field, $error);
            }
        });

        return $validator->validate();
    }

    private function getRuleIds(Request $request): array
    {
        return collect($request->all())
            ->filter(fn ($value, $key) => preg_match('/^rule\-\d+$/', $key))
            ->map(fn ($value, $key) => explode('-', $key)[1])
            ->values()
            ->toArray();
    }
}
