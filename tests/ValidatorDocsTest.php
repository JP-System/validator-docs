<?php

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

uses(TestCase::class);

/**
 * -------------------------------------
 * Rules
 * -------------------------------------
 */

/**
 * CellPhone
 */
test('it_should_check_cellphone_rule', function () {
    $correct = Validator::make(
        ['value_1' => '98899-4444', 'value_2' => '9800-1936'],
        ['value_1' => 'cellphone', 'value_2' => 'cellphone']
    );

    $incorrect = Validator::make(
        ['value' => '900-1926'],
        ['value' => 'cellphone']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * CellPhone With Code
 */
test('it_should_check_cellphone_with_code_rule', function () {
    $correct = Validator::make(
        ['value' => '+55(99)98899-4444'],
        ['value' => 'cellphone_with_code']
    );

    $incorrect = Validator::make(
        ['value' => '+5(99)800-1926'],
        ['value' => 'cellphone_with_code']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * CellPhone With Code No Mask
 */
test('it_should_check_cellphone_with_code_no_mask_rule', function () {
    $correct = Validator::make(
        ['value' => '+5599988994444'],
        ['value' => 'cellphone_with_code_no_mask']
    );

    $incorrect = Validator::make(
        ['value' => '+5998001926'],
        ['value' => 'cellphone_with_code_no_mask']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * CellPhone With DDD
 */
test('it_should_check_cellphone_with_ddd_rule', function () {
    $correct = Validator::make(
        ['value' => '(99)98899-4444'],
        ['value' => 'cellphone_with_ddd']
    );

    $incorrect = Validator::make(
        ['value' => '(99)800-1926'],
        ['value' => 'cellphone_with_ddd']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * CNH
 */
test('it_should_check_cnh_rule', function () {
    $correct = Validator::make(
        ['value' => '96784547943'],
        ['value' => 'cnh']
    );

    $incorrect = Validator::make(
        ['value' => '96784547999'],
        ['value' => 'cnh']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * CNPJ
 */
test('it_should_check_cnpj_rule', function () {
    $correct = Validator::make(
        ['value' => '53.084.587/0001-20'],
        ['value' => 'cnpj']
    );

    $incorrect = Validator::make(
        ['value' => '51.084.587/0001-20'],
        ['value' => 'cnpj']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();

    $values = collect(['00.000.000/0000-00', '11111111111111', '22222222222222', '00.000.000/0000-00', '11.111.111/1111-11', '22.222.222/2222-22']);

    $values->each(function ($cnpj) {
        $validator = Validator::make(
            ['value' => $cnpj],
            ['value' => 'cnpj'],
        );

        expect($validator->fails())->toBeTrue();
    });
});

/**
 * CNS
 */
test('it_should_check_cns_rule', function () {
    $values1 = collect(['272004493990007', '140776230420006', '254446765170004', '912176122180009', '174295560290007', '103409299850000', '773398431180002']);

    $values1->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => ['cns']]
        );

        expect($validator->passes())->toBeTrue();
    });

    $values2 = collect(['072004493990007', '000000000000000', '111111111111111', '222222222222222', '999999999999999', '123456789123456']);

    $values2->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => ['cns']]
        );

        expect($validator->fails())->toBeTrue();
    });
});

/**
 * CPF
 */
test('it_should_check_cpf_rule', function () {
    $correct = Validator::make(
        ['value' => '094.050.986-59'],
        ['value' => 'cpf']
    );

    $incorrect = Validator::make(
        ['value' => '99800-1926'],
        ['value' => 'cpf']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * CPF or CNPJ
 */
test('it_should_check_cpf_or_cnpj_rule', function () {
    $values1 = collect(['981.366.228-09', '56.611.605/0001-73', '49851807000127']);

    $values1->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'cpf_or_cnpj']
        );

        expect($validator->passes())->toBeTrue();
    });

    $values2 = collect(['000.366.228-09', '11.611.605/0001-73', '22851807000127']);

    $values2->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'cpf_or_cnpj']
        );

        expect($validator->fails())->toBeTrue();
    });
});

/**
 * PIS
 */
test('it_should_check_pis_rule', function () {
    $values1 = collect(['690.30244.88-6', '042.33768.05-2', '971.78508.77-5']);

    $values1->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'pis']
        );

        expect($validator->passes())->toBeTrue();
    });

    $values2 = collect(['999.30244.88-6', '777.33768.05-2', '888.78508.77-5']);

    $values2->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'pis']
        );

        expect($validator->fails())->toBeTrue();
    });
});

/**
 * TelePhone
 */
test('it_should_check_telephone_rule', function () {
    $correct = Validator::make(
        ['value' => '3598-4550'],
        ['value' => 'telephone']
    );

    $incorrect = Validator::make(
        ['value' => '99800-1926'],
        ['value' => 'telephone']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * TelePhone With Code
 */
test('it_should_check_telephone_with_code_rule', function () {
    $correct = Validator::make(
        ['value' => '+55(99)3500-4444'],
        ['value' => 'telephone_with_code']
    );

    $incorrect = Validator::make(
        ['value' => '+5(99)9-1926'],
        ['value' => 'telephone_with_code']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * TelePhone With DDD
 */
test('it_should_check_telephone_with_ddd_rule', function () {
    $correct = Validator::make(
        ['value' => '(99)3500-4444'],
        ['value' => 'telephone_with_ddd']
    );

    $incorrect = Validator::make(
        ['value' => '(99)9-1926'],
        ['value' => 'telephone_with_ddd']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * UF
 */
test('it_should_check_uf_rule', function () {
    $values1 = collect(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MS', 'MT', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO', 'EX']);

    $values1->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'uf']
        );

        expect($validator->passes())->toBeTrue();
    });

    $values2 = collect(['FALSE', 'mg', 'sp', 'MO', 'CB']);

    $values2->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'uf']
        );

        expect($validator->fails())->toBeTrue();
    });
});

/**
 * -------------------------------------
 * Formats
 * -------------------------------------
 */

/**
 * CEP
 */
test('it_should_check_format_cep_rule', function () {
    $values1 = collect(['32400-000', '32.400-000', '07.550-000', '30.150-150']);

    $values1->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'format_cep']
        );

        expect($validator->passes())->toBeTrue();
    });

    $values2 = collect(['32400.000', '32.400-0000', '0.400-000', '300.40-000', '300.400-000']);

    $values2->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'format_cep']
        );

        expect($validator->fails())->toBeTrue();
    });
});

/**
 * CNPJ
 */
test('it_should_check_format_cnpj_rule', function () {
    $correct = Validator::make(
        ['value' => '53.084.587/0001-20'],
        ['value' => 'format_cnpj']
    );

    $incorrect = Validator::make(
        ['value' => '51.084.587/000120'],
        ['value' => 'format_cnpj']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * CPF
 */
test('it_should_check_format_cpf_rule', function () {
    $correct = Validator::make(
        ['value' => '094.050.986-59'],
        ['value' => 'format_cpf']
    );

    $incorrect = Validator::make(
        ['value' => '094.050.986-591'],
        ['value' => 'format_cpf']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * CPF or CNPJ
 */
test('it_should_check_format_cpf_or_cnpj_rule', function () {
    $values1 = collect(['981.366.228-09', '000.000.000-00', '56.611.605/0001-73']);

    $values1->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'format_cpf_or_cnpj']
        );

        expect($validator->passes())->toBeTrue();
    });

    $values2 = collect(['0000.366.228-09', '11.6211.605/0001-73', '22851807000127']);

    $values2->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'format_cpf_or_cnpj']
        );

        expect($validator->fails())->toBeTrue();
    });
});

/**
 * PIS
 */
test('it_should_check_format_pis_rule', function () {
    $correct = Validator::make(
        ['value' => '276.96730.83-0'],
        ['value' => 'format_pis']
    );

    $incorrect = Validator::make(
        ['value' => '276.96730.830'],
        ['value' => 'format_pis']
    );

    expect($correct->passes())->toBeTrue();

    expect($incorrect->fails())->toBeTrue();
});

/**
 * Vehicle Plate
 */
test('it_should_check_format_vehicle_plate_rule', function () {
    $values1 = collect(['ABC-1234', 'abc-1234', 'ABC1234', 'aBc1234', 'abc1234', 'BEE4R22', 'FUM-0B05', 'FUM-5L58']);

    $values1->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'format_vehicle_plate']
        );

        expect($validator->passes())->toBeTrue();
    });

    $values2 = collect(['a2c-1234', 'abc-12ed', 'abc 1234', 'ãBC1234', 'ABCD1234', 'ABC12345', 'ab1234', 'ab123a4', 'abc+1234']);

    $values2->each(function ($value) {
        $validator = Validator::make(
            ['value' => $value],
            ['value' => 'format_vehicle_plate']
        );

        expect($validator->fails())->toBeTrue();
    });
});
