<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileSearchlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_searchlists', function (Blueprint $table) {
            $table->id();
            $table->integer('api_request_id');
            $table->bigInteger('mobiletitle_aliase_id');
            $table->string('kind')->nullable();
            $table->string('nextpagetoken')->nullable();
            $table->string('prevpagetoken')->nullable();
            $table->string('channelid')->nullable();
            $table->string('channeltitle')->nullable();
            $table->string('videoid');
            $table->longText('title');
            $table->longText('description')->nullable();
            $table->string('thumbnails_defaulturl')->nullable();
            $table->string('thumbnails_mediumurl')->nullable();
            $table->string('thumbnails_highurl')->nullable();
            $table->string('publishtime')->nullable();
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
        Schema::dropIfExists('mobile_searchlists');
    }
}
