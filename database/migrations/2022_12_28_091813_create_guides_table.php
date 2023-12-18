<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('icon', 30)->nullable();
            $table->string('program_link')->unique();
            $table->string('doc_link')->unique();
            $table->unsignedTinyInteger('sort')->nullable();
            $table->boolean('approved')->default(0);
            $table->boolean('public');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guides');
    }
};
