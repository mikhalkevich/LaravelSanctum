<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socials')->insert([
            [
                'name'         => 'Linkedin',
                'link'         => 'http://linkedin.com',
                'link_develop' => 'https://developer.linkedin.com/',
                'email'        => 'sashkasynok@gmail.com',
            ], [
                'name'         => 'Github',
                'link'         => 'http://github.com',
                'link_develop' => 'https://github.com/settings/developers',
                'email'        => 'mikhalkevich@ya.ru',
            ], [
                'name'         => 'Google',
                'link'         => 'http://google.com',
                'link_develop' => 'https://console.developers.google.com/apis/credentials',
                'email'        => 'a.mikhalkevich@school-olymp.ru',
            ], [
                'name'         => 'VKontakte',
                'link'         => 'http://vk.com',
                'link_develop' => 'https://vk.com/apps?act=manage',
                'email'        => 'a.mikhalkevich@school-olymp.ru',
            ], [
                'name'         => 'Facebook',
                'link'         => 'http://facebook.com',
                'link_develop' => 'http://developers.facebook.com/apps',
                'email'        => 'mikhalkevich@ya.ru',
            ], [
                'name'         => 'Ok',
                'link'         => 'https://ok.ru',
                'link_develop' => 'https://apiok.ru/dev/app/create',
                'email'        => 'mikhalkevich@ya.ru',
            ],
        ]);
    }
}
