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
        Schema::create('contents', function (Blueprint $table) {
            $table->integer('likes');      
        $table->string('title');
        $table->string('text');
        $table->string('thumbnail');

        // 外部キー
        $table->unsignedBigInteger('tagsId');
        $table->unsignedBigInteger('pictureId');

        $table->timestamps();

        // 外部キー制約
        $table->foreign('tagsId')
            ->references('id')->on('tags')
            ->onDelete('cascade');

        $table->foreign('pictureId')
            ->references('id')->on('pictures')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
