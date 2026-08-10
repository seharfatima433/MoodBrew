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
        Schema::table('products', function (Blueprint $table) {
            $table->string('farmer_name')->nullable();
            $table->string('country_origin')->nullable();
            $table->string('altitude')->nullable();
            $table->text('farm_story')->nullable();
            $table->integer('reward_points')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['farmer_name', 'country_origin', 'altitude', 'farm_story', 'reward_points']);
        });
    }
};
