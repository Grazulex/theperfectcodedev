<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function down(): void
    {
        Schema::dropIfExists('page_user_likes');
    }
    public function up(): void
    {
        Schema::create('page_user_likes', static function (Blueprint $table): void {
            $table->foreignId('page_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->unique(['page_id', 'user_id']);
        });
    }
};
