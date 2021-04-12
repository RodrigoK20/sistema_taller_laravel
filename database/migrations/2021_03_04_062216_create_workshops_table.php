<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('name_service')->unique();
            $table->string('description')->nullable();
            $table->decimal('cost');
            $table->enum('status', ['ACTIVE','DEACTIVATED'])->default('ACTIVE');
            $table->timestamps();

             //FK Category Work
             $table->unsignedBigInteger('category_work_id');
             $table->foreign('category_work_id')->references('id')->on('category_works');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshops');
    }
}
