<?php

use Illuminate\Database\Seeder;

use App\Channel;

use Illuminate\Support\Str;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'Laravel 7.0',
            'slug' => Str::slug('Laravel 7.0')
        ]);

        Channel::create([
            'name' => 'PHP MySQL',
            'slug' => Str::slug('PHP MySQL')
        ]);

        Channel::create([
            'name' => 'Vue JS',
            'slug' => Str::slug('Vue JS')
        ]);

        Channel::create([
            'name' => 'Web Development',
            'slug' => Str::slug('Web Development')
        ]);
    }
}
