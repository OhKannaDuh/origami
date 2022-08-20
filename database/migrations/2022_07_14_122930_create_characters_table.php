<?php

use App\Models\Character\Clan;
use App\Models\Character\Family;
use App\Models\Character\School;
use App\Models\User;
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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(User::class);
            $table->string('name', 128);
            $table->json('inventory')->default('{}');
            $table->foreignIdFor(Clan::class);
            $table->foreignIdFor(Family::class);
            $table->foreignIdFor(School::class);
            $table->unsignedInteger('school_rank');
            $table->string('avatar')->default('/images/avatar.png');
            $table->json('advancements');
            $table->json('personality');
            $table->json('heritage');
            $table->json('stats');
            $table->timestamps();
        });
    }
};
