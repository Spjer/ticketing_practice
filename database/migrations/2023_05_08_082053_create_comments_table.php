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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comm', 400);
            $table->unsignedBigInteger('ticket_id')->unsigned;

            $table->timestamps();
        });

        Schema::table('comments', function ($table){
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
