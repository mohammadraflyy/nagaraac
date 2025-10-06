<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_post', function (Blueprint $table) {
            $table->uuid('post_uuid');
            $table->uuid('category_uuid');

            $table->primary(['post_uuid', 'category_uuid']);

            $table->foreign('post_uuid')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('category_uuid')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_categories');
    }
};
