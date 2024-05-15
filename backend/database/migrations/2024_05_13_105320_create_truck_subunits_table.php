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
        Schema::create('truck_subunits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_truck');
            $table->foreign('main_truck')->references('id')->on('trucks');
            $table->unsignedBigInteger('subunit');
            $table->foreign('subunit')->references('id')->on('trucks');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truck_subunits');
    }
};
