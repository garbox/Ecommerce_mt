<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
class DatabaseSeeder extends Seeder
{
    // run the database seeder

    public function run(): void 
    {
        $this->call(ProdAttribute::class);
        $this->call(Products::class);
        $this->call(ProductType::class);
        $this->call(States::class);
        $this->call(Status::class);
        $this->call(Role::class);
        $this->call(User::class);

    }
}