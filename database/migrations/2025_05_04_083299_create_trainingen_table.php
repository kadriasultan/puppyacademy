<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::create('trainingen', function (Blueprint $table) {
$table->id();
$table->enum('type', ['course', 'video'])->nullable();
$table->string('title')->nullable();
$table->text('description')->nullable();
$table->decimal('price', 6, 2)->nullable();
$table->string('image')->nullable();
$table->string('video')->nullable();
$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('trainingen');
}
};
