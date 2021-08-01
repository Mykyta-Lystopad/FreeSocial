<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
//            $table->string('file_name')->default('Test file-name');
//            $table->string('comment')->nullable();
            $table->TEXT('avatar')->nullable();
//            $table->TEXT('avatar')->comment('http://nikita-listopad-portfolio.pp.ua/FreeSocial/storage/avatars/default_avatar.png');
            $table->string('first_name')->default('Name');
            $table->string('last_name')->default('Surname');
            $table->Integer('age')->default(0);
            $table->string('birthDay')->default('2000-10-10');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verify_code');
            $table->string('country')->default('Україна');
            $table->string('city')->default('Полтава');
            $table->string('mobile')->default('380*********');
            $table->string('role')->default('user');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
