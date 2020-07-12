<?php

use Illuminate\Database\Seeder;
use App\LibUser;
use App\DataLayer;
use App\Esperienza;
use Faker\Generator as Faker;

class SeederEsperienze extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $dl = new DataLayer();
        
        //utente_id, sentiero_id, revisore_id, stato, nota
        
        $lista_utenti = json_decode($dl->getAllUsers());
        $revisore=$dl->trovaRevisore();
        $lista_sentieri=json_decode($dl->getAllSentieri());
        
        for($i=0; $i<5; $i++) {
            $utente = $lista_utenti[array_rand($lista_utenti)];
            $sentiero = $lista_sentieri[array_rand($lista_sentieri)];
            if($utente->admin=='y'){
                factory(Esperienza::class, 1)->create(['utente_id' => $utente->id, 'sentiero_id'=>$sentiero->id, 
                    'stato'=>'approvato']); 
            }
            else {
                factory(Esperienza::class, 1)->create(['utente_id' => $utente->id, 'sentiero_id'=>$sentiero->id, 
                    'nota'=>$faker->sentence(rand(1,5)), 'stato'=>$faker->randomElement(['revisione', 'rifiutato']),
                    'revisore_id'=>$revisore]); 
            }
            
        }
    }
}
