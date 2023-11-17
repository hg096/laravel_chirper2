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

        $tableName = 'dev_stacks';

        // Check if the table already exists
        // if (!Schema::hasTable($tableName)) {
            // If not, create the table
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('skill');
                $table->string('company');
                $table->string('location');
                $table->string('location2');
                $table->string('category');
                $table->text('memo');
                $table->timestamps();
            });
        // }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dev_stacks');
    }
};
