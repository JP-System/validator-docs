<?php

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

uses(TestCase::class);

test('it_should_check_cpf_rule', function () {
    $correct = Validator::make(
        ['cpf' => '094.050.986-59'],
        ['cpf' => 'cpf']
    );

    $incorrect = Validator::make(
        ['cpf' => '99800-1926'],
        ['cpf' => 'cpf']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

test('it_should_check_cnpj_rule', function () {
    $correct = Validator::make(
        ['cnpj' => '53.084.587/0001-20'],
        ['cnpj' => 'cnpj']
    );

    $incorrect = Validator::make(
        ['cnpj' => '51.084.587/0001-20'],
        ['cnpj' => 'cnpj']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();

    $repeats = collect([
        '00.000.000/0000-00',
        '11111111111111',
        '22222222222222',
        '00.000.000/0000-00',
        '11.111.111/1111-11',
        '22.222.222/2222-22',
    ]);

    $repeats->each(function ($cnpj) {
        $validator = Validator::make(['cnpj' => $cnpj], [
            'cnpj' => 'cnpj',
        ]);

        expect($validator->fails())->toBeTrue();
    });
});
