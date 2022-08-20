<?php

use App\Models\Core\ItemSubtype;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SourceBook::class);
            $table->foreignIdFor(ItemSubtype::class);
            $table->string('key', 64)->unique();
            $table->string('name', 64);
            $table->text('description')->default('');
            $table->json('data');
            $table->json('cost');
            $table->integer('rarity');
            $table->timestamps();
        });
    }
};
