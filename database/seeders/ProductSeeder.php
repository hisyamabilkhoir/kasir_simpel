<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = ([
            ([
                "name"   => "Steak Kambing",
                "picture"   => "1.jpg",
                "price"   => 50000,
                "show"   => 1,
            ]),
            ([
                "name"   => "Tahu Goreng",
                "picture"   => "2.jpg",
                "price"   => 13000,
                "show"   => 1,
            ]),
            ([
                "name"   => "Buah Campur",
                "picture"   => "3.jpg",
                "price"   => 25000,
                "show"   => 1,
            ]),
            ([
                "name"   => "Burger",
                "picture"   => "4.jpg",
                "price"   => 30000,
                "show"   => 1,
            ]),
            ([
                "name"   => "Pizza",
                "picture"   => "5.jpg",
                "price"   => 60000,
                "show"   => 1,
            ]),
            ([
                "name"   => "Risol",
                "picture"   => "6.jpg",
                "price"   => 35000,
                "show"   => 1,
            ]),
            ([
                "name"   => "Pangsit",
                "picture"   => "7.jpg",
                "price"   => 23000,
                "show"   => 1,
            ]),
            ([
                "name"   => "Empal",
                "picture"   => "8.jpg",
                "price"   => 31000,
                "show"   => 1,
            ]),
            ([
                "name"   => "Roti Bakar",
                "picture"   => "9.jpg",
                "price"   => 12000,
                "show"   => 1,
            ]),
            ([
                "name"   => "Sop Daging",
                "picture"   => "10.jpg",
                "price"   => 39000,
                "show"   => 1,
            ]),
        ]);

        DB::table('products')->insert($products);
    }
}
