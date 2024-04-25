<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation');
        });

        DB::table('positions')->insert([
            ['name' => 'Quarterback', 'abbreviation' => 'QB'],
            ['name' => 'Halfback', 'abbreviation' => 'HB'],
            ['name' => 'Fullback', 'abbreviation' => 'FB'],
            ['name' => 'Wide Receiver', 'abbreviation' => 'WR'],
            ['name' => 'Tight End', 'abbreviation' => 'TE'],
            ['name' => 'Tackle', 'abbreviation' => 'T'],
            ['name' => 'Guard', 'abbreviation' => 'G'],
            ['name' => 'Center', 'abbreviation' => 'C'],
            ['name' => 'Defensive Tackle', 'abbreviation' => 'DT'],
            ['name' => 'Left End', 'abbreviation' => 'LE'],
            ['name' => 'Right End', 'abbreviation' => 'RE'],
            ['name' => 'Outside Linebacker', 'abbreviation' => 'OLB'],
            ['name' => 'Middle Linebacker', 'abbreviation' => 'MLB'],
            ['name' => 'Cornerback', 'abbreviation' => 'CB'],
            ['name' => 'Strong Safety', 'abbreviation' => 'SS'],
            ['name' => 'Free Safety', 'abbreviation' => 'FS'],
            ['name' => 'Kicker', 'abbreviation' => 'K'],
            ['name' => 'Punter', 'abbreviation' => 'P'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
