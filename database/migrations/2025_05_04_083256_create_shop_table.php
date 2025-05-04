<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::create('shops', function (Blueprint $table) {
$table->id();
$table->enum('type', ['course', 'diy']);
$table->string('title');
$table->text('description');
$table->decimal('price', 6, 2);
$table->string('image');
$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('shops');
}
};
