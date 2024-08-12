<?php

// Update the migration file if needed
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteers_id')->constrained('volunteers')->onDelete('cascade');
            $table->foreignId('org_id')->constrained('org')->onDelete('cascade'); // Adjusted to match org table name
            $table->string('project_name');
            $table->text('description');
            $table->foreignId('volunteer_org_id')->nullable()->constrained('volunteer_org')->onDelete('set null'); // Add this line
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
