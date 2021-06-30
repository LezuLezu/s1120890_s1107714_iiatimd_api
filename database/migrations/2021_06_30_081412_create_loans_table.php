<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            // Header vallues
            $table->float('amount');
            $table->string('firstName');
            $table->string('title')->nullable(false);
            $table->timestamp('createdAt');

            // Other vallues
            $table->id();
            $table->string('lastName');
            $table->text('reason')->nullable();
            $table->string('phoneNumber');
            $table->timestamp('payedOn')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
