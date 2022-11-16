<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->string('slug',100);
            $table->text('image')->nullable();
            $table->text('video')->nullable();
            $table->text('content');
            $table->string('author',100);
            $table->date('publish_date');
            $table->string('category',100)->nullable();
            $table->enum('status',['Publish','Draft'])->default('Draft');
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
        Schema::dropIfExists('blogs');
    }
}
