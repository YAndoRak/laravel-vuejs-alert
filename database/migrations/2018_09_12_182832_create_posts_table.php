<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->string('lieu');
            $table->string('commune');
            $table->string('date');
            $table->boolean('poster');
            $table->longText('description');
            $table->boolean('online');
            $table->string('auteur');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE posts ADD image LONGBLOB AFTER commune");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
