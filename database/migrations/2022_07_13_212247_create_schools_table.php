<?php

use App\Models\Character\Family;
use App\Models\Character\Technique;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SourceBook::class);
            $table->string('key', 64);
            $table->string('name', 64);
            $table->foreignIdFor(Ring::class, 'ring_one_id');
            $table->foreignIdFor(Ring::class, 'ring_two_id');
            $table->integer('starting_skill_amount', false, true);
            $table->json('starting_skills');
            $table->json('starting_techniques');
            $table->json('starting_outfit');
            $table->json('curriculum');
            $table->foreignIdFor(Technique::class, 'school_ability_id')->nullable();
            $table->foreignIdFor(Technique::class, 'mastery_ability_id')->nullable();
            $table->foreignIdFor(Family::class)->nullable();
            $table->timestamps();
        });
    }
};
