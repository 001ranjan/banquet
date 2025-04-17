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
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->references('id')->on('food_categories')->cascadeOnDelete();
            $table->string('name');
            $table->double('price', 10, 2)->default(0);
            $table->text('description')->nullable();
            $table->enum('type', array('Veg','Non-Veg'))->default('Veg');
            $table->enum('status', array('0','1'))->default('1')->comment('1=>Active,0=>Inactive');
            $table->integer('is_deleted')->default('0')->comment('0=>Not Yet Deleted,1=>Deleted');
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
        Schema::dropIfExists('food_items');
    }
};
