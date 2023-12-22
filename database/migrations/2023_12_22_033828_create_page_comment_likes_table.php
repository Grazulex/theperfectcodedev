<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('page_comment_likes', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('page_comment_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('liked')->default(true);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_comment_likes');
    }
};
