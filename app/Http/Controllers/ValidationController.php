<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;

class ValidationController extends Controller
{
    public function __invoke(Request $request)
    {
        $groupedById = collect($request->all())
            ->filter(function ($value, $key) {
                return preg_match('/^(rule|value)\-\d+$/', $key);
            })
            ->groupBy(function ($value, $key) {
                return explode('-', $key)[1];
            })->toArray();

        $validate = [];
        $ruleErrors = [];

        foreach ($groupedById as $id => $array) {
            $ruleKey = 'rule-' . $id;
            $rule = $request->input($ruleKey) ?? 'required|string';

            $ruleValidator = Validator::make($request->all(), [$ruleKey => $rule]);

            try {
                $ruleValidator->passes();
                $validate[$ruleKey] = 'required|string';
                $validate['value-' . $id] = $rule;
            } catch (\Exception $e) {
                if (preg_match('/^unique|exists|dimensions|file|mimetypes|mimes/i', $rule)) {
                    $ruleErrors[$ruleKey] = 'Not supported yet.';
                } else {
                    $ruleErrors[$ruleKey] = $e->getMessage();
                }
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
}
