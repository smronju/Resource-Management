<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->text('description')->nullable()->comment('HTML snippet description');
            $table->text('snippet')->nullable()->comment('HTML snippet');
            $table->string('link')->nullable();
            $table->boolean('new_tab')->default(0);
            $table->string('file_name')->nullable();
            $table->string('path')->nullable()->comment('Uploaded file path');
            $table->string('type')->comment('resource type e.g: pdf, snippet and link');
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
        Schema::dropIfExists('resources');
    }
};
