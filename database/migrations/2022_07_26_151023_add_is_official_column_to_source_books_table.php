<?php

use App\Models\Core\SourceBook;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


    public function up(): void
    {
        Schema::table('source_books', function (Blueprint $table) {
            $table->boolean('is_official')->default(false);
        });

        foreach (SourceBook::all() as $sourceBook) {
            $sourceBook->update([
                'is_official' => true,
            ]);
        }
    }


    public function down(): void
    {
        Schema::table('source_books', function (Blueprint $table) {
            $table->dropColumn('is_official');
        });
    }
};
