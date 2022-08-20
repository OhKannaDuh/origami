<?php

use App\Models\Character\Advantage;
use App\Models\Character\Character;
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
        Schema::create('character_advantage', function (Blueprint $table) {
            $table->foreignIdFor(Character::class);
            $table->foreignIdFor(Advantage::class);
        });
    }
};
