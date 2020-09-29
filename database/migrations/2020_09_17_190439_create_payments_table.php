<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10,2);
            $table->string('payment_num',20)->nullable();
            $table->string('payment_date')->nullable();
            $table->string('payment_type',20)->nullable();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->foreignId('bank_id')->nullable()->constrained();
            $table->foreignId('billing_id')->nullable()->constrained('billings');
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
