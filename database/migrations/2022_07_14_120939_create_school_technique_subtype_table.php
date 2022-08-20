<?php

use App\Models\Character\School;
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
        Schema::create('school_technique_subtype', function (Blueprint $table) {
            $table->foreignIdFor(School::class);
            $table->foreignIdFor(TechniqueSubtype::class);
        });
    }
};
