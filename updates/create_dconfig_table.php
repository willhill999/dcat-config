<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDconfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $table = config('admin.extensions.config.table', 'dconfig');

        Schema::connection($connection)->create($table, function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('标题');
            $table->string('name')->comment('键名')->unique();
            $table->tinyInteger('type')->default(0)->comment('类型');
            $table->string('value')->comment('键值')->nullable();
            $table->text('option')->comment('选项:select,radio等选择类型的数据')->nullable();
            $table->text('description')->comment('说明')->nullable();
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
        $connection = config('admin.database.connection') ?: config('database.default');

        $table = config('admin.extensions.config.table', 'dconfig');

        Schema::connection($connection)->dropIfExists($table);
    }
}
