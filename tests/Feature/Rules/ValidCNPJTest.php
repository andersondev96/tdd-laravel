<?php

namespace Tests\Feature\Rules;

use App\Rules\validCNPJ;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ValidCNPJTest extends TestCase
{
    /** @test */
    public function it_should_check_if_the_cnpj_is_valid_and_active()
    {
        Http::fake([
            'https://brasilapi.com.br/api/cnpj/v1/19131243000197' => Http::response(
                [
                    'cnpj' => '19.131.243/0001-97',
                    'razaoSocial' => 'Empresa Teste',
                    'descricaoSituacaoCadastral' => 'ATIVA'], 200)
        ]);

        // CNPJ

        $rule = new validCNPJ();

        $this->assertTrue(
            $rule->passes('cnpj', '19131243000197')
        );


    }

    /** @test */
    public function return_false_if_cnpj_is_not_found()
    {
        Http::fake([
            'https://brasilapi.com.br/api/cnpj/v1/352287345237345' => Http::response(
                [], 404
            ),

            'https://brasilapi.com.br/api/cnpj/v1/19131243000197' => Http::response(
                [
                    'cnpj' => '19.131.243/0001-97',
                    'descricao_situacao_cadastral' => 'INATIVA'], 200
            ),

        ]);
        $rule = new validCNPJ();
        $this->assertFalse(
            $rule->passes('cnpj', '12345678900')
        );
    }
}
