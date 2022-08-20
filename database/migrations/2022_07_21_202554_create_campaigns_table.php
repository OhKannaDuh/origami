<?php

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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->text('description')->default('');
            $table->foreignIdFor(User::class);
            $table->json('npcs')->default('{}');
            $table->timestamps();
        });
    }
};
