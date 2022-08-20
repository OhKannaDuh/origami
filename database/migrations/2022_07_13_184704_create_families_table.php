<?php

use App\Models\Character\Clan;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SourceBook::class);
            $table->foreignIdFor(Clan::class);
            $table->foreignIdFor(Ring::class, 'ring_choice_one_id');
            $table->foreignIdFor(Ring::class, 'ring_choice_two_id');
            $table->foreignIdFor(Skill::class, 'skill_one_id');
            $table->foreignIdFor(Skill::class, 'skill_two_id');
            $table->string('key', 32)->unique();
            $table->string('name', 32);
            $table->unsignedInteger('glory');
            $table->unsignedInteger('starting_wealth');
            $table->text('description')->default('');
            $table->timestamps();
        });
    }
};
