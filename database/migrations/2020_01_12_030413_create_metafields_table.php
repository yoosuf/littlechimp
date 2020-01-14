<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetafieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metafields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')
                    ->references('id')->on('accounts')
                    ->onDelete('cascade');

            $table->morphs('metaable');	
            $table->string('meta_key');
            $table->enum('meta_type', ['string', 'integer', 'float', 'boolean', 'array', 'object', 'resource', 'NULL']);
            $table->longText('meta_value');
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
        Schema::dropIfExists('metafields');
    }
}
