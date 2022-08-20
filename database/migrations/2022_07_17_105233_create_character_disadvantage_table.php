<?php

use App\Models\Character\Character;
use App\Models\Character\Disadvantage;
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
        Schema::create('character_disadvantage', function (Blueprint $table) {
            $table->foreignIdFor(Character::class);
            $table->foreignIdFor(Disadvantage::class);
        });
    }
};
