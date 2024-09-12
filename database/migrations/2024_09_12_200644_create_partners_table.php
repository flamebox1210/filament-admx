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
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->tinyInteger('is_active')->default(0);
            $table->string('image')->nullable();
            $table->json('title');
            $table->json('slug');
            $table->string('url')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('partner_categories', function (Blueprint $table) {
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
        Schema::dropIfExists('partner_categories');
        Schema::dropIfExists('partners');
    }
};
