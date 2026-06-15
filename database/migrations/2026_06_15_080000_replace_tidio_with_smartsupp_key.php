<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReplaceTidioWithSmartsuppKey extends Migration
{
    private const SMARTSUPP_KEY = '0e89323056bcf508d6c3f5a5ce195409d8681e72';

    public function up()
    {
        if (! Schema::hasColumn('settings', 'tido')) {
            return;
        }

        DB::table('settings')->update([
            'tido' => self::SMARTSUPP_KEY,
        ]);
    }

    public function down()
    {
        if (! Schema::hasColumn('settings', 'tido')) {
            return;
        }

        DB::table('settings')
            ->where('tido', self::SMARTSUPP_KEY)
            ->update(['tido' => null]);
    }
}
