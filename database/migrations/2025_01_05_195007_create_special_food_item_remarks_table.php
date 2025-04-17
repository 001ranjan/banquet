<?php

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
    public function up()
    {
        Schema::create('special_food_item_remarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('special_food_items_id')->nullable()->references('id')->on('special_food_items')->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_food_item_remarks');
    }
};
