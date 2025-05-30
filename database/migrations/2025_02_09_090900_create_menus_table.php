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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->text('description')->nullable();
            $table->double('menu_price', 10, 2)->default(0);
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
        Schema::dropIfExists('menus');
    }
};
