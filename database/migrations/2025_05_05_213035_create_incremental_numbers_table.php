<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incremental_numbers', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('final_client_id')->nullable();

            $table->foreignUuid('garage_id')->nullable();

            $table->string('number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incremental_numbers');
    }
};
