<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_num', 20);
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('plan_id')->constrained();
            $table->decimal('invoice_amount',20,2);
            $table->date('cutt_off')->nullable()->comment('Fecha de corte generada');
            $table->date('date_payment')->nullable()->comment('fecha de notificacicon de pago');
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('billings');
    }
}
