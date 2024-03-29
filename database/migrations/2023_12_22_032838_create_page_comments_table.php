<?php

declare(strict_types=1);

use App\Enums\Comments\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('page_comments', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->integer('version_id')->nullable();
            $table->mediumText('content');


            $table->foreignId('response_id')->nullable()->constrained('page_comments')->onDelete('cascade');

            $table->string('state')->default(State::PUBLISHED);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_comments');
    }
};
