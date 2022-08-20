<?php

use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('techniques', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SourceBook::class);
            $table->foreignIdFor(TechniqueSubtype::class);
            $table->string('key', 128);
            $table->string('name', 128);
            $table->unsignedInteger('rank');
            $table->text('description')->default('');
            $table->timestamps();
        });
    }
};
