<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsArticleTagsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_article_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('news_article_id');
            $table->unsignedBigInteger('tag_id');

            // Foreign keys
            $table->foreign('news_article_id')->references('id')->on('news_articles')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->primary(['news_article_id', 'tag_id']); // Set primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_article_tags');
    }
}
