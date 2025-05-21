<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cashiers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->nullable()->unique()->constrained()->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cashiers');
    }
};
