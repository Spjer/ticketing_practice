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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('phone_number');
            $table->unsignedBigInteger('ticket_id')->unsigned;            

            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets')
            ->onDelete('cascade');
        });

        Schema::table('clients', function ($table){
           // $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
