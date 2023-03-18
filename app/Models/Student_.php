<?php

namespace App\Models;

class Student_
{
    private static $siswa_posts = [
        [
            "name" => "Karinda Najla Shahira",
            "slug" => "karinda-najla-shahira",
            "school" => "SMA Negeri 1 Padang",
            "class" => "XII IPA 8",
            "gender" => "Perempuan",
            "age" => "17"
        ],
        [
            "name" => "Alya Damayanti Rivani",
            "slug" => "alya-damayanti-rivani",
            "school" => "SMA Negeri 1 Padang",
            "class" => "XII IPA 8",
            "gender" => "Perempuan",
            "age" => "17"
        ],
        [
            "name" => "Aliyyah Putri Zahirah",
            "slug" => "aliyyah-putri-zahirah",
            "school" => "SMA Negeri 1 Padang",
            "class" => "XII IPA 8",
            "gender" => "Perempuan",
            "age" => "17"
        ],
    ];

    public static function all()
    {
        return collect(self::$siswa_posts);
    }

    public static function find($slug)
    {
        $students = static::all();
        return $students->firstWhere('slug', $slug);
    }
}
