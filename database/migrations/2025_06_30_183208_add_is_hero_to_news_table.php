<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_is_hero_to_news_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->boolean('is_hero')->default(false)->after('image');
        });
    }

    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('is_hero');
        });
    }
};
