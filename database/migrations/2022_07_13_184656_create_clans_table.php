<?php

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
        Schema::create('clans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SourceBook::class);
            $table->foreignIdFor(Ring::class);
            $table->foreignIdFor(Skill::class);
            $table->string('key', 32)->unique();
            $table->string('name', 32);
            $table->unsignedInteger('status');
            $table->boolean('is_major');
            $table->text('description')->default('');
            $table->timestamps();
        });
    }
};
