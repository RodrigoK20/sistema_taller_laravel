<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_shops', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->decimal('mount');
            $table->date('date_registry');
            $table->date('date_paid')->nullable();
            $table->enum('status', ['PAID','UNPAID'])->default('UNPAID');
            $table->softDeletes(); //Columna para soft delete
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
        Schema::dropIfExists('expense_shops');
    }
}
