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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('surname',50)->nullable();
            $table->string('middle_name',50)->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('password')->nullable();
            $table->text('address')->nullable();
            $table->string('nationality',50)->nullable();
            $table->string('country',80)->nullable();
            $table->string('state',80)->nullable();
            $table->string('city',80)->nullable();
            $table->integer('zipcode')->nullable();
            $table->string('gender',10)->nullable();
            $table->string('image')->nullable();
            $table->integer('age')->nullable();
            $table->integer('is_deleted')->default('0')->comment('0=>Not Yet Deleted,1=>Deleted');
            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
};
