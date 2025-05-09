<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleToUsersTable extends Migration
{
public function up()
{
Schema::table('users', function (Blueprint $table) {
if (!Schema::hasColumn('users', 'role')) {
$table->string('role')->default('user');
}
});
}

public function down()
{
Schema::table('users', function (Blueprint $table) {
if (Schema::hasColumn('users', 'role')) {
$table->dropColumn('role');
}
});
}
}
