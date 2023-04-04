<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


    public function up(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->boolean('allow_nonhuman_techniques')->default(false)->after('stats');
        });
    }
};
