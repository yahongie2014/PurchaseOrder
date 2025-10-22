<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('mediable');                 // mediable_id, mediable_type
            $table->string('collection')->default('default'); // product_images, bills...
            $table->string('disk')->default('public');
            $table->string('path');                     // storage path
            $table->string('filename');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->json('meta')->nullable();           // width/height/alt
            $table->timestamps();
            $table->softDeletes();
            $table->index(['mediable_type', 'collection']);
        });

        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->morphs('auditable');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audits');
        Schema::dropIfExists('media');
    }
};
