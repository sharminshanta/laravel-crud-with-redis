<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid','6')->unique();
            $table->string('first_name',80);
            $table->string('last_name', 80);
            $table->string('gmail_address', 80)->unique();
            $table->string('role', 20);
            $table->string('location', 80);
            $table->tinyInteger('status')
                ->default('1')
                ->nullable()
                ->comment('1=Active, 2=Inactive');
            $table->timestamp('created_at')
                ->nullable()
                ->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->nullable()
                ->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
