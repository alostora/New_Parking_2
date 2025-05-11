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
        Schema::create('available_final_client_packages', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->integer('available_customer_count')->nullable()->default(0);

            $table->integer('final_cliend_number_of_usage')->nullable()->default(0);

            $table->foreignUuid('client_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_final_client_packages');
    }
};
