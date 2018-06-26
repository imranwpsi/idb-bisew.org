<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_widgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titile_content');
            $table->string('pic');
            $table->string('deadline_content');
            $table->string('date');
            $table->string('guidelines_content');
            $table->string('guideline_url');
            $table->string('apply_content');
            $table->string('apply_url');
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
        Schema::dropIfExists('apply_widgets');
    }
}
