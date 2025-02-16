<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            ['id' => 1, 'parent_id' => null, 'slug' => 'page1', 'title' => 'Page 1 (Parent)', 'path' => '/page1'],
            ['id' => 2, 'parent_id' => 1, 'slug' => 'page2', 'title' => 'Page 2 (Child of Page 1)', 'path' => '/page1/page2'],
            ['id' => 3, 'parent_id' => 2, 'slug' => 'page1', 'title' => 'Page 1 Child (Child of Page 2)', 'path' => '/page1/page2/page1'],
            ['id' => 4, 'parent_id' => 2, 'slug' => 'page3', 'title' => 'Page 3 (Child of Page 2)', 'path' => '/page1/page2/page3'],
            ['id' => 5, 'parent_id' => 4, 'slug' => 'page4', 'title' => 'Page 4 (Child of Page 3)', 'path' => '/page1/page2/page3/page4'],
            ['id' => 6, 'parent_id' => 4, 'slug' => 'page5', 'title' => 'Page 5 (Child of Page 3)', 'path' => '/page1/page2/page3/page5'],
            ['id' => 7, 'parent_id' => null, 'slug' => 'page6', 'title' => 'Page 6 (Parent)', 'path' => '/page6'],
            ['id' => 8, 'parent_id' => 7, 'slug' => 'page7', 'title' => 'Page 7 (Child of Page 6)', 'path' => '/page6/page7'],
            ['id' => 9, 'parent_id' => 8, 'slug' => 'page8', 'title' => 'Page 8 (Child of Page 7)', 'path' => '/page6/page7/page8'],
            ['id' => 10, 'parent_id' => 9, 'slug' => 'page9', 'title' => 'Page 9 (Child of Page 8)', 'path' => '/page6/page7/page8/page9'],
            ['id' => 11, 'parent_id' => null, 'slug' => 'page10', 'title' => 'Page 10 (Parent)', 'path' => '/page10'],
            ['id' => 12, 'parent_id' => 11, 'slug' => 'page11', 'title' => 'Page 11 (Child of Page 10)', 'path' => '/page10/page11'],
            ['id' => 13, 'parent_id' => 12, 'slug' => 'page12', 'title' => 'Page 12 (Child of Page 11)', 'path' => '/page10/page11/page12'],
            ['id' => 14, 'parent_id' => 12, 'slug' => 'page13', 'title' => 'Page 13 (Child of Page 11)', 'path' => '/page10/page11/page13'],
            ['id' => 15, 'parent_id' => 13, 'slug' => 'page14', 'title' => 'Page 14 (Child of Page 12)', 'path' => '/page10/page11/page12/page14'],
            ['id' => 16, 'parent_id' => 1, 'slug' => 'page15', 'title' => 'Page 15 (Child of Page 1)', 'path' => '/page1/page15'],
            ['id' => 17, 'parent_id' => 16, 'slug' => 'page16', 'title' => 'Page 16 (Child of Page 15)', 'path' => '/page1/page15/page16'],
            ['id' => 18, 'parent_id' => 17, 'slug' => 'page17', 'title' => 'Page 17 (Child of Page 16)', 'path' => '/page1/page15/page16/page17'],
            ['id' => 19, 'parent_id' => 18, 'slug' => 'page18', 'title' => 'Page 18 (Child of Page 17)', 'path' => '/page1/page15/page16/page17/page18'],
            ['id' => 20, 'parent_id' => null, 'slug' => 'page19', 'title' => 'Page 19 (Parent)', 'path' => '/page19'],
            ['id' => 21, 'parent_id' => 20, 'slug' => 'page20', 'title' => 'Page 20 (Child of Page 19)', 'path' => '/page19/page20'],
            ['id' => 22, 'parent_id' => 21, 'slug' => 'page21', 'title' => 'Page 21 (Child of Page 20)', 'path' => '/page19/page20/page21'],
            ['id' => 23, 'parent_id' => 21, 'slug' => 'page22', 'title' => 'Page 22 (Child of Page 20)', 'path' => '/page19/page20/page22'],
            ['id' => 24, 'parent_id' => 22, 'slug' => 'page23', 'title' => 'Page 23 (Child of Page 21)', 'path' => '/page19/page20/page21/page23'],
            ['id' => 25, 'parent_id' => 23, 'slug' => 'page24', 'title' => 'Page 24 (Child of Page 22)', 'path' => '/page19/page20/page22/page24'],
        ]);
    }
}
