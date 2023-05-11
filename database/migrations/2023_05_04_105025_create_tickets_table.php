<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
          //  $table->unsignedBigInteger('status_id')->unsigned;
            $table->string('tic_name', 50);
            $table->string('details', 255);
            
            $table->string('status', 15)->default('Open');
            $table->unsignedBigInteger('user_id')->nulltable();
           
            $table->timestamps();
        });

       // Schema::table('tickets', function ($table){
         //   $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            
            

        //});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
