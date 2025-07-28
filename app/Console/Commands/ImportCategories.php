<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoriesImport;

use App\Models\Category;
use App\Services\EmbeddingService;

class ImportCategories extends Command
{
    protected $signature = 'import:categories';
    protected $description = 'Import categories from Excel file';

    public function handle()
    {
        //dd(storage_path('app\categories.xlsx'));
        Excel::import(new CategoriesImport, storage_path('app\categories.xlsx'));

        $this->info('Categories imported successfully.');


        $service = new EmbeddingService();
        Category::whereNull('embedding')->each(function ($category) use ($service) {
            $embedding = $service->generateEmbedding($category->name);
            $category->embedding = json_encode($embedding);
            $category->save();
        });

        $this->info('Embeddings generated.');
    }
}

