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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('Open');
            //$table->unsignedBigInteger('ticket_id');
            $table->timestamps();
        });

       // Schema::table('statuses', function ($table){
       //     $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
       // });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
