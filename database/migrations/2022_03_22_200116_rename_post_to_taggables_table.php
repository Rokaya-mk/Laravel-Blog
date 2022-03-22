<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePostToTaggablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tag', function (Blueprint $table) {
            //we need to drop foreign key first
            $table->dropForeign(['post_id']);
            //drop post_id column
            $table->dropColumn('post_id');

        });
        //rename table post_tag to taggables table
        Schema::rename('post_tag','taggables');
        //add morph to taggable table
        Schema::table('taggables', function(Blueprint $table) {
            //add morph
            $table->morphs('taggable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taggables', function (Blueprint $table) {
            //drop morphs
            $table->dropMorphs('taggable');
            //rename table
            Schema::rename('taggables','post_tag');
            //disable constraint of foreign key
            Schema::disableForeignKeyConstraints();
            //add foreign key 
            Schema::table('post_tag',function(Blueprint $table) {
                $table->foreignId('post_id')->constrained()->onDelete('cascade');
            });

            //enable foreign key constraint
            Schema::enableForeignKeyConstraints();
        });
    }
}
