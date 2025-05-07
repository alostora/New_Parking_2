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
        Schema::create('final_clients', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('name')->nullable();

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->string('final_cliend_incremental_number')->nullable();
            $table->string('guest_id')->nullable();

            $table->foreignUuid('client_id')->nullable();

            $table->foreignUuid('garage_id')->nullable();

            $table->timestamp('stopped_at')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_clients');
    }
};
