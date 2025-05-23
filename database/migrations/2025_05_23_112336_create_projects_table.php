<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_description');
            $table->text('full_description')->nullable();
            $table->string('thumbnail')->nullable(); // εικόνα για το preview
            $table->json('screenshots')->nullable(); // αποθηκεύουμε array με URLs
            $table->string('links')->nullable(); // μπορεί να είναι json ή απλό text με URLs
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
