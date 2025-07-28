<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\EmbeddingService;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = [];

        if ($query) {
            $service = new EmbeddingService();
            $inputEmbedding = $service->generateEmbedding($query);

            $categories = Category::whereNotNull('embedding')->get();

            $results = $categories->map(function ($category) use ($inputEmbedding) {
                $categoryEmbedding = json_decode($category->embedding, true);
                $score = $this->cosineSimilarity($inputEmbedding, $categoryEmbedding);
                return [
                    'name' => $category->name,
                    'score' => $score,
                ];
            })->sortByDesc('score')->take(5);
        }

        return view('search', compact('results', 'query'));
    }

    private function cosineSimilarity(array $vecA, array $vecB)
    {
        $dotProduct = array_sum(array_map(fn($a, $b) => $a * $b, $vecA, $vecB));
        $normA = sqrt(array_sum(array_map(fn($a) => $a ** 2, $vecA)));
        $normB = sqrt(array_sum(array_map(fn($b) => $b ** 2, $vecB)));
        return $normA && $normB ? $dotProduct / ($normA * $normB) : 0;
    }
}
