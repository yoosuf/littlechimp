<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('newsletters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')
                    ->references('id')->on('accounts')
                    ->onDelete('cascade');
            $table->string('name');
            $table->string('from');
            $table->string('subject');
            $table->longText('content');
            $table->string('content_type')->default('richtext');
            $table->enum('status', ['draft', 'running', 'scheduled', 'paused', 'cancelled', 'finished']);
            $table->unsignedBigInteger('template_id');
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
            $table->smallInteger('count_subscribers');
            $table->smallInteger('count_remaining');
            $table->smallInteger('count_sent');
            $table->dateTime('started_at');
            $table->dateTime('finished_at');
            $table->timestamps();
        });



        Schema::create('campaigns', function (Blueprint $table) {
            $table->unsignedBigInteger('newsletter_id');
            $table->foreign('newsletter_id')->references('id')->on('newsletters')->onDelete('cascade');
            $table->unsignedBigInteger('catalog_id');
            $table->foreign('catalog_id')->references('id')->on('catalogs')->onDelete('cascade');
            $table->enum('status', ['unconfirmed', 'confirmed', 'unsubscribed']);
            $table->timestamps();
            $table->primary(['catalog_id', 'newsletter_id']);	
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
