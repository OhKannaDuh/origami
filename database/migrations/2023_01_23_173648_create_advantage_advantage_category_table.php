<?php

use App\Models\Character\Advantage;
use App\Models\Core\AdvantageCategory;
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
        Schema::create('advantage_advantage_category', function (Blueprint $table) {
            $table->foreignIdFor(Advantage::class);
            $table->foreignIdFor(AdvantageCategory::class);
        });
    }
};
