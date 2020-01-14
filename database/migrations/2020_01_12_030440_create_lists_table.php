<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')
                    ->references('id')->on('accounts')
                    ->onDelete('cascade');
            $table->string('name');
            $table->enum('category', ['public', 'private', 'temporary']);
            $table->timestamps();
        });


        Schema::create('subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('subscriber_id');
            $table->foreign('subscriber_id')->references('id')->on('subscribers');
            $table->unsignedBigInteger('catalog_id');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->enum('status', ['unconfirmed', 'confirmed', 'unsubscribed']);
            $table->timestamps();
            $table->primary(['subscriber_id', 'catalog_id']);	

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogs');
    }
}
