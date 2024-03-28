<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('industry_id');
            $table->foreign('industry_id')->references('id')->on('industries');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('online')->default(1);
            $table->text('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'company_id' => 1,
            'industry_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@themesbrand.com',
            'password' => Hash::make('12345678'),
            'email_verified_at'=> now(), 
            'created_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
