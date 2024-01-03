<?php

declare(strict_types=1);

use App\Enums\Pages\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table): void {
            $table->id();
            $table->json('tags');

            $table->string('title');
            $table->string('slug')->unique();

            $table->mediumText('resume');
            $table->text('description');
            $table->text('code');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->integer('version')->default(1);

            $table->string('state')->default(State::DRAFT);

            $table->timestamp('published_at')->nullable();

            $table->boolean('is_public')->default(true);
            $table->boolean('is_accept_version')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
