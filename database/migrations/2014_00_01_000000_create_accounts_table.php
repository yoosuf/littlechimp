<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('subdomain')->unique();
            $table->boolean('is_demo')->default(false);
            $table->timestamps();
        });



        Schema::create('team', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id');
            $table->foreign('owner_id')
                    ->references('id')->on('accounts')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')
                    ->references('id')->on('people')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->enum('role', ['owner', 'admin', 'member', 'user']);
            $table->timestamp('created_at');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team');
        Schema::dropIfExists('accounts');
    }
}
