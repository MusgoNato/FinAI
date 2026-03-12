<?php

namespace App\Http\Controllers\services;

use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\VarDumper\VarDumper;

class ApiGroqCloudService extends Controller
{
    //
    protected $base_url;
    protected $api_key;


    public function __construct() 
    {
        $this->base_url = config('services.api_groq.base');
        $this->api_key = config('services.api_groq.key');
    }

    public function getInsight(string $context)
    {
        $user_id = auth()->id();
        $ai_message = Cache::remember("ai_insight_{$user_id}", now()->addhours(6), function () use ($context) {
            $response = Http::withToken($this->api_key)
            ->post($this->base_url, [
                'model' => "llama-3.3-70b-versatile",
                'instructions' => "
                    Você é um consultor financeiro pessoal.

                    Responda EXCLUSIVAMENTE em Markdown bem formatado seguindo exatamente esta estrutura:

                    ## 📊 Resumo
                    - Texto objetivo em 1 linha
                    
                    ## ⚠️ Alerta
                    - Texto objetivo em 1 linha (se não houver risco, escreva: 'Sem riscos financeiros no momento.')

                    ## 💡 Recomendação
                    - Uma ação prática e clara em 1 linha

                    Regras obrigatórias:
                    - Não escreva nada fora dessa estrutura
                    - Não use parágrafos soltos
                    - Use apenas títulos (##) e listas com hífen (-)
                    - Use negrito para valores
                    - Máximo total de 5 linhas de conteúdo
                    - Seja direto e profissional
                    ",
                'input' => $context
            ]);

            $data = $response->json();

            return collect($data['output'])
            ->flatMap(fn ($item) => $item['content'] ?? [])
            ->firstWhere('type', 'output_text')['text'] ?? 'Erro ao gerar a resposta';  
        });
    
          
        return $ai_message;
    }
}
