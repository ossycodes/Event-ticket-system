<?php

use Illuminate\Database\Seeder;
use App\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = [
            [
                'name' => 'lorem Ispuim',
                'email' => 'loremisuim.gmail.com',
                'message' => 'Lorem ipsum represents a long-held tradition for designers, typographers and the like. Some people hate it and argue for its demise, but others ignore the hat',
                'phonenumber' => '08027332873',
            ],
            
            [
                'name' => 'lorem Ispuim',
                'email' => 'ismuimorem.gmail.com',
                'message' => 'Lorem ipsum represents a long-held tradition for designers, typographers and the like. Some people hate it and argue for its demise, but others ignore the hat',
                'phonenumber' => '02938392292',
            ]
        ];

        foreach($contacts as $key => $value)
            Contact::create($value);
    }
}
