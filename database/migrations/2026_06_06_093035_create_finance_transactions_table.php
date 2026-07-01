<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense']); // مداخيل أو مصاريف
            $table->string('category'); // e.g. Salaries, Rent, Medical Contribution
            $table->decimal('amount', 10, 2);
            $table->string('description', 1000)->nullable();
            $table->date('date');
            $table->unsignedBigInteger('tuteur_id')->nullable(); // Optional link to guardian
            $table->unsignedBigInteger('enfant_id')->nullable(); // Optional link to child
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
        Schema::dropIfExists('finance_transactions');
    }
}
