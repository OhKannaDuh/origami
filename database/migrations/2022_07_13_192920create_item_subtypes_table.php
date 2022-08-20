<?php

use App\Models\Core\ItemType;
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
        Schema::create('item_subtypes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ItemType::class);
            $table->string('key', 32)->unique();
            $table->string('name', 32);
            $table->timestamps();
        });
    }
};
