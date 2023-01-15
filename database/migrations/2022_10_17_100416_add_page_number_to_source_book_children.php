<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLES = [
        'advantages',
        'clans',
        'disadvantages',
        'families',
        'items',
        'schools',
        'techniques',
    ];


    /**
     * @return void
     */
    public function up(): void
    {
        foreach (self::TABLES as $table) {
            Schema::table($table, function (Blueprint $schema) {
                $schema->unsignedInteger('page_number')->nullable()->before('created_at');
            });
        }
    }
};
