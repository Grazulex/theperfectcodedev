<?php

declare(strict_types=1);

use App\Enums\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('versions', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->integer('version')->default(1);

            $table->text('description');
            $table->text('code');

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('state')->default(State::ARCHIVED->value);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('versions');
    }
};
