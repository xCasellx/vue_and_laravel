<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParseDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parse_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("link")->unique();
            $table->string("title");
            $table->string("image");
            $table->string("price");
            $table->string("mileage")->nullable();
            $table->string("type_of_fuel")->nullable();
            $table->text("description");
            $table->year("year_of_issue")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parse_data');
    }
}
