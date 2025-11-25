<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();

        $table->text('comment');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['user_id']);
            $table->dropIndex(['product_id']);
            $table->dropIndex(['user_id']);
        });
        Schema::dropIfExists('comments');
    }
};
