<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('cover_img')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('slug')->index()->nullable();
            $table->string('name')->index()->nullable();
            $table->json('translation')->nullable();
            $table->integer('position')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
