<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('work_time')->default(25); // Default: 25 minutes
            $table->integer('break_time')->default(5); // Default: 5 minutes
            $table->string('focus_sound')->nullable(); // Optional focus sound path
            $table->string('break_sound')->nullable(); // Optional break sound path
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('settings');
    }
};
