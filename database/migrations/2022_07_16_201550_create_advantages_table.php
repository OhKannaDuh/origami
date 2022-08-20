<?php

use App\Models\Core\AdvantageType;
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
        Schema::create('advantages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SourceBook::class);
            $table->foreignIdFor(AdvantageType::class);
            $table->foreignIdFor(Ring::class);
            $table->string('key')->unique();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }
};
