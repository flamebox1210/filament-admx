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
            $table->bigIncrements('id')->primary();
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_active')->default(0);
            $table->json('title');
            $table->json('slug');
            $table->json('content')->nullable();
            $table->string('image')->nullable();
            foreach (config('app.locales') as $locale) {
                $table->json('components:' . $locale)->nullable();
            }
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('author_id')->nullable();
            $table->text('tags')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('article_categories', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->json('title');
            $table->json('slug');
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
