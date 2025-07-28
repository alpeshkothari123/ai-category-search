<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class EmbeddingService
{
    public function generateEmbedding($text)
    {
        $apiKey = env('OPENAI_API_KEY');
       
        $response = Http::withToken($apiKey)->post('https://api.openai.com/v1/embeddings', [
            'model' => 'text-embedding-ada-002',
            'input' => $text,
        ]);
        // dd($response);
        return $response->json()['data'][0]['embedding'] ?? null;
    }
}
