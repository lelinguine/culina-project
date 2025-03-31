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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->mediumText('title');
            $table->longText('content');
            $table->longText('ingredients');
            $table->string('media')->nullable();
            $table->text('tags')->nullable();
            $table->string('status', 45)->default('published');
            $table->timestamps('');
        
            $table->foreignId('user_id')
                      ->constrained()
                      ->onUpdate('cascade')
                      ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
