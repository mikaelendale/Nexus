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
        Schema::create('volunteer_org', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteers_id')->constrained('volunteers')->onDelete('cascade');
            $table->foreignId('org_id')->constrained('org')->onDelete('cascade');
            $table->string('hours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_org');
    }
};
