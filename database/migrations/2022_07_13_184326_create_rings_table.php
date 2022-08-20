<?php

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
        Schema::create('rings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 8)->unique();
            $table->string('name', 8);
            $table->timestamps();
        });
    }
};
