<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\User;
//use App\Models\Status;
use App\User;
use App\Status;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(30);
        //return view('users.index', compact('users'));
//        return $user; // NG

/*
{"users":{"
    current_page":1,
    "data":[
        {"id":1,"name":"Aufree","email":"aufree@yousails.com","created_at":"2018-09-10 18:48:00","updated_at":"2018-09-10 18:48:00"},
        {"id":3,"name":"kevin","email":"kevin@10ware.com","created_at":"2018-09-10 19:13:26","updated_at":"2018-09-10 19:13:26"}
    ],
    "first_page_url":"http:\/\/sample.test\/users?page=1","from":1,"last_page":1,
    "last_page_url":"http:\/\/sample.test\/users?page=1",
    "next_page_url":null,"path":"http:\/\/sample.test\/users",
    "per_page":30,
    "prev_page_url":null,
    "to":2,
    "total":2}}
*/
        return compact('users');
    }

    public function show_x(User $user, Status $status)
    {
        /*{"status":[]}*/
        //return compact('status');

        /*[]*/
        //return $status;
    }

    //public function show(User $user)
    public function show($id)
    {
        /*{"id":1,"name":"Aufree","email":"aufree@yousails.com","created_at":"2018-09-10 13:54:20","updated_at":"2018-09-10 13:54:20"}*/
        //return $user;

        /*{"user":{"id":1,"name":"Aufree","email":"aufree@yousails.com","created_at":"2018-09-10 13:54:20","updated_at":"2018-09-10 13:54:20"}}*/
        //return compact('user');

        /*{"id":1,"name":"Aufree","email":"aufree@yousails.com","created_at":"2018-09-10 13:54:20","updated_at":"2018-09-10 13:54:20"}*/
        //return view('users.show', compact('user'));

//         $user = User::findOrFail($id);
//         $user->statuses()->create([
//             'content' => 'this is a test.'
//         ]);
// return $user;
//        $user = User::findOrFail($id);
        // $user->statuses()->create([
        //     'content' => 'this is a test.'
        // ]);

        // $user = User::all();
        // return $user; // OK

         $user = User::findOrFail($id);
// return $user;
//return compact('user');

//         //$statuses = $user->statuses()->first();
//         $statuses = $user->statuses()
//                             ->orderBy('created_at', 'desc')
//                             ->first();

// return $statuses; // OK

        $statuses = $user->statuses()
                           ->orderBy('created_at', 'desc')
                           ->paginate(3);
//return $statuses; // NG
//return compact('statuses'); /*{"statuses":{}}*/
return view('users.show', compact('user', 'statuses'));

//return compact('user');
        //return $statuses; // NG

        /*{"statuses":{}}*/
//        return compact('statuses');

        return view('users.show', compact('user'));
//        return view('users.show', compact('user', 'statuses'));

        // $statuses = $user->statuses()
        //                    ->orderBy('created_at', 'desc')
        //                    ->paginate(30);
        // return view('users.show', compact('user', 'statuses'));

//        $statuses = $user->statuses();
        //return view('users.show', compact('user', 'statuses'));

//        return view('users.show', compact('user'));
        //return view('users.show');
        //return 'hello';
    }
}
