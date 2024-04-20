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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->integer("purchase_id")->unsigned()->nullable();
            $table->integer("check_id")->unsigned()->nullable();
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("purchase_id")->references("id")->on("purchases");
            $table->foreign("check_id")->references("id")->on("checks");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
