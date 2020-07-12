<?php

use Illuminate\Database\Seeder;
use App\LibUser;
use App\DataLayer;
use App\Esperienza;
use Faker\Generator as Faker;

class SeederUtenti extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$faker = \Faker\Factory::create();
        $dl = new DataLayer();
        $lista_citta = json_decode($dl->getAllCitta());
        
        for($i=0; $i<2; $i++) {
            $citta = $lista_citta[array_rand($lista_citta)];
            factory(LibUser::class, 1)->create(['citta_id' => $citta->id]);
        } 
    }
}
