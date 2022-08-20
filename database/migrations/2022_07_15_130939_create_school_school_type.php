<?php

use App\Models\Character\School;
use App\Models\Core\SchoolType;
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
        Schema::create('school_school_type', function (Blueprint $table) {
            $table->foreignIdFor(School::class);
            $table->foreignIdFor(SchoolType::class);
        });
    }
};
