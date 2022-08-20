<?php

use App\Models\Core\Campaign;
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
        Schema::create('campaign_user', function (Blueprint $table) {
            $table->foreignIdFor(Campaign::class);
            $table->foreignIdFor(User::class);
        });
    }
};
