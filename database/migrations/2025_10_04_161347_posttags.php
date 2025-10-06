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
        Schema::create('post_tags', function (Blueprint $table) {
            $table->uuid('post_uuid');
            $table->uuid('tag_uuid');

            $table->primary(['post_uuid', 'tag_uuid']); // composite key

            $table->foreign('post_uuid')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('tag_uuid')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tags');
    }
};
