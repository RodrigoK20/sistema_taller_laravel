<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_service');
            $table->dateTime('service_date');
        
             //FK Sale
             $table->unsignedBigInteger('sale_id');
             $table->foreign('sale_id')->references('id')->on('sales');
    
             //FK workshop
             $table->unsignedBigInteger('workshop_id');
             $table->foreign('workshop_id')->references('id')->on('workshops');

             //FK Client
             $table->unsignedBigInteger('client_id');
             $table->foreign('client_id')->references('id')->on('clients');

             //FK Car
             $table->unsignedBigInteger('car_id');
             $table->foreign('car_id')->references('id')->on('cars');


             //FK User
             $table->unsignedBigInteger('user_id');
             $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('services');
    }
}
