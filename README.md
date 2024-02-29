# Validator Docs

Este pacote foi inspirado em outros dois pacotes, mas foi criado pela necessidade de uma customização melhor nas messages de validação.

- [geekcom - ValidatorDocs](https://github.com/geekcom/validator-docs)
- [LaravelLegends - PtBrValidator](https://github.com/LaravelLegends/pt-br-validator)

### 🔧 Customização

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

Qualquer melhoria ou correção, poderá abrir um PR ou Issue.

## 🚀 Obrigado!
