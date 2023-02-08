<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Event;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //User
        /*
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
            $table->enum('role', ['member', 'admin'])->default('member');
            $table->date('birthday')->nullable();
            $table->string('twitter', 100)->nullable();
            $table->string('twitch', 100)->nullable();
            $table->string('instagram', 100)->nullable();
        */

/*         DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'birthday' => '1990-01-01',
            'twitter' => 'https://twitter.com/',
            'twitch' => 'https://twitch.tv/',
            'instagram' => 'https://instagram.com/',
        ]); */

        User::factory(10)->create();

        //Events
        /*
            $table->id();
            $table->string('name', 15);
            $table->text('description');
            $table->boolean('visibility')->default(0);
            $table->date('date')->nullable();
            $table->time('hour')->nullable();
            $table->text('location')->nullable();
            $table->text('tags')->nullable();
            $table->timestamps();
        */

/*         DB::table('events')->insert([
            'name' => Str::random(10),
            'description' => Str::random(10),
            'visibility' => 1,
            'date' => '2021-01-01',
            'hour' => '12:00:00',
            'location' => 'Calle falsa 123',
            //'tags' => 'tag1, tag2, tag3',
        ]); */

        Event::factory(10)->create();

        //Messages
        /*
            $table->id();
            $table->string('name', 15);
            $table->string('email');
            $table->string('subject', 100);
            $table->text('text');
            $table->boolean('readed')->default(0);
            $table->timestamps();
        */

/*         DB::table('messages')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'subject' => Str::random(10),
            'text' => Str::random(10),
            'readed' => 1,
        ]); */

        Message::factory(10)->create();

    }
}
