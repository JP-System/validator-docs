# 📌 Validator Docs

Este pacote foi inspirado em outros dois pacotes, mas foi criado pela necessidade de uma customização melhor nas messages de validação e na validação dos formatos.

- [geekcom - ValidatorDocs](https://github.com/geekcom/validator-docs)
- [LaravelLegends - PtBrValidator](https://github.com/LaravelLegends/pt-br-validator)

### 🔧 Instalação

Para fazer a instalação do pacote, rode o comando:

```bash
    composer require jp-system/validator-docs
```

### 📦 Customização

Nesse pacote você pode publicar as messages de validação e customizá-las, usando o comando:

```bash
    php artisan vendor:publish --tag="docs"
```

Caso não queira publicar o arquivo de tradução, você poderá criar suas próprias mensagens dentro do arquivo `validation.php`:

```php
    'docs' => [
        'cpf' => 'Este campo deve ser um CPF válido.',
        ...
    ],
```

### 📋 Utilização

| Regras              | Formatos                                                                               | Formatação Opcional |
| ------------------- | -------------------------------------------------------------------------------------- | ------------------- |
| uf                  | **Sem formato**                                                                        | **`null`**          |
| cep                 | **`99999-999`**, **`99.999-999`**                                                      | **`false`**         |
| cnh                 | **Sem formato**                                                                        | **`null`**          |
| cns                 | **Sem formato**                                                                        | **`null`**          |
| cpf                 | **`999.999.999-99`**                                                                   | **`true`**          |
| pis                 | **`999.99999.99-9`**                                                                   | **`true`**          |
| cnpj                | **`99.999.999/9999-99`**                                                               | **`true`**          |
| money               | **`99.999,99`**, **`99,999.99`**                                                       | **`false`**         |
| cellphone           | **`99999-9999`**, **`9999-9999`**                                                      | **`false`**         |
| telephone           | **`9999-9999`**                                                                        | **`false`**         |
| cpf_or_cnpj         | **`999.999.999-99`**, **`99.999.999/9999-99`**                                         | **`true`**          |
| vehicle_plate       | **`AAA-1234`**, **`AAA-1A23`**                                                         | **`false`**         |
| cellphone_with_ddd  | **`(99)99999-9999`**, **`(99)9999-9999`**, **`(99) 99999-9999`**, **`(99) 9999-9999`** | **`false`**         |
| telephone_with_ddd  | **`(99)9999-9999`**                                                                    | **`false`**         |
| cellphone_with_code | **`+99(99)99999-9999`**, **`+99(99)9999-9999`**                                        | **`false`**         |
| telephone_with_code | **`+55(99)9999-9999`**                                                                 | **`false`**         |

Todas as regras podem ser utilizadas a partir da **`Rule`** do próprio Laravel:

```php
    'cpf' => [
        'required',
        'string',
        Rule::cpf(),
    ],
    'cnpj' => [
        'required',
        'string',
        Rule::cnpj()->format(),
    ],
```

As regras em que existe a opção de formatação, mas é opcional, podemos aplicar a formatação de três maneiras:

```php
    'cpf' => [
        'required',
        'string',
        'cpf:format',
    ],
    'cnpj' => [
        'required',
        'string',
        Rule::cnpj()->format(),
    ],
    'cpf_or_cnpj' => [
        'required',
        'string',
        (new CPForCNPJ)->format(),
    ],
```

A regra para dinheiro aceita dois parâmetros, a moeda e a localicação. Utilizamos a classe de suporte Number do próprio Laravel:

```php
    'money_1' => [
        'required',
        'string',
        'money:BRL,pt_BR', // default
    ],
    'money_2' => [
        'required',
        'string',
        Rule::money()->parameters(['USD', 'en_US']),
    ],
```

Caso você precise verificar o formato do dinheiro conforme alguma regra em específica, você pode setar os callbacks no seu AppServiceProvider:

```php
    Money::setLocaleCallback(function ($default) {
        return Auth::user()?->locale ?? $default;
    });

    Money::setCurrencyCallback(function ($default) {
        return Auth::user()?->currency ?? $default;
    });
```

Qualquer melhoria ou correção, poderá abrir um PR ou Issue.

## 🚀 Obrigado!
