<?php

use App\Models\Core\DisadvantageType;
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
        Schema::create('disadvantages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SourceBook::class);
            $table->foreignIdFor(DisadvantageType::class);
            $table->foreignIdFor(Ring::class);
            $table->string('key')->unique();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }
};
