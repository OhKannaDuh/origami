<?php

use App\Models\Core\TechniqueType;
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
        Schema::create('technique_subtypes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TechniqueType::class);
            $table->string('key', 32)->unique();
            $table->string('name', 32);
            $table->timestamps();
        });
    }
};
