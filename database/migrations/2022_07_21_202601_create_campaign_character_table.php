<?php

use App\Models\Character\Character;
use App\Models\Core\Campaign;
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
        Schema::create('campaign_character', function (Blueprint $table) {
            $table->foreignIdFor(Campaign::class);
            $table->foreignIdFor(Character::class);
        });
    }
};
