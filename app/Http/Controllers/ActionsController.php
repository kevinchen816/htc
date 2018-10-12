<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class ActionsController extends Controller
{
    //public function terms(Request $request) {
    //    if (Auth::check()) {
    //        $user = Auth::user();
    //        return view('help.terms', compact('user'));
    //
    //    } else {
    //        session()->flash('warning', 'Please Login first');
    //        return redirect()->route('login');
    //    }
    //}

    /*
        <tr>
            <td>Scheduled Update</td>
            <td>Completed</td>
            <td>09/10/2018 1:31:14 pm</td>
            <td>09/10/2018 1:34:53 pm</td>
            <td>49 photos uploaded.</td>
        </tr>
    */
    public function History($camera) {
        $actions = DB::table('actions')
            ->where('camera_id', $camera->id)
            ->get();

        $handle = '';
        foreach ($actions as $action) {
            $handle .= '<tr>';
            $handle .=     '<td>'.$action->action.'</td>';
            $handle .=     '<td>'.$action->status.'</td>';
            $handle .=     '<td>'.$action->requested.'</td>';
            $handle .=     '<td>'.$action->completed.'</td>';
            //$handle .=     '<td>49 photos uploaded.</td>';
            $handle .=     '<td></td>';
            $handle .= '</tr>';
        }
        return $handle;
    }
}
