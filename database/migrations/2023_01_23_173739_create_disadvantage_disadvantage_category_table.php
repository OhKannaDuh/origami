<?php

use App\Models\Character\Disadvantage;
use App\Models\Core\DisadvantageCategory;
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
        Schema::create('disadvantage_disadvantage_category', function (Blueprint $table) {
            $table->foreignIdFor(Disadvantage::class);
            $table->foreignIdFor(DisadvantageCategory::class);
        });
    }
};
