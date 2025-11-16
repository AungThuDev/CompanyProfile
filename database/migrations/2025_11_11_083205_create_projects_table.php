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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_type_id')->constrained('project_types')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image');
            $table->text('description')->nullable();
            $table->string('project_url')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('display_order')->default(1);
            
            $table->foreignId('created_by')
            ->nullable()
            ->constrained('users')
            ->onDelete('set null');
            
            $table->foreignId('updated_by')
            ->nullable()
            ->constrained('users')
            ->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
