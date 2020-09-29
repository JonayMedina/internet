<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('slug')->nullable();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->integer('download',false, true)->length(10)->nullable();
            $table->integer('upload',false, true)->length(10)->nullable();
            $table->enum('unit_dw',['kb','mb','gb'])->nullable();
            $table->enum('unit_up',['kb','mb','gb'])->nullable();
            $table->decimal('cost',20,2)->nullable();
            $table->string('description')->nullable();
            $table->boolean('promotion')->nullable()->default(0);
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
