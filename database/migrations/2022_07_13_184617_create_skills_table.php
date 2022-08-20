<?php

use App\Models\Core\SkillGroup;
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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SkillGroup::class);
            $table->string('key', 32)->unique();
            $table->string('name', 32);
            $table->text('description')->default('');
            $table->timestamps();
        });
    }
};
