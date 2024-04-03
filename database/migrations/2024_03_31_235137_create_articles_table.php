<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_active')->default(0);
            $table->string('title');
            $table->string('slug');
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->longText('components')->nullable();
            $table->string('category_id')->nullable();
            $table->text('tags')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('article_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_categories');
        Schema::dropIfExists('articles');
    }
};
