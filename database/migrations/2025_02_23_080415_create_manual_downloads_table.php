<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manual_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manual_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('ip_address', 45);
            $table->timestamp('downloaded_at');
            
            // Add index for rate limiting queries
            $table->index(['ip_address', 'downloaded_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manual_downloads');
    }
};
