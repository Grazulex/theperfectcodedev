<?php

declare(strict_types=1);

use App\Enums\State;
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

            $table->text('description');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->integer('version')->default(1);

            $table->string('state')->default(State::DRAFT->value);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
