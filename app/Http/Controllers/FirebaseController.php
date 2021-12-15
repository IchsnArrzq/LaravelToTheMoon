<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
class FirebaseController extends Controller
{
    public function index(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/laravel-to-the-moon-firebase-adminsdk-dn7fb-b0c7ad5112.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        $database = $firebase->getDatabase();
        $ref = $database->getReference('Subjects');
        $key = $ref->push()->getKey();
        $ref->getChild($key)->set([
            'SubjectName' => 'Laravel'
        ]);
        return $key;
    }
}
