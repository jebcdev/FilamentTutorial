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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('country_id')->references('id')->on('countries')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('state_id')->references('id')->on('states')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('city_id')->references('id')->on('cities')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('department_id')->references('id')->on('departments')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');

            $table->char('zip_code');

            $table->date('date_of_birth');
            $table->date('date_hired');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
