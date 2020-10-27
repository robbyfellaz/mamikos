<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Kost;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function kostList(Request $request): Response
    {
        $location = '';
        if (isset($request->location)) {
            $location = strtolower($request->location) === '' ? '' : strtolower($request->location);
        }

        $name = '';
        if (isset($request->name)) {
            $name = strtolower($request->name) === '' ? '' : strtolower($request->name);
        }

        $kost = Kost::name($name)
            ->location($location)
            ->price($request->harga_awal, $request->harga_akhir, $request->sortPrice)
            ->orderBy('updated_at', 'desc')
            ->get();

        return response(
            $kost,
            200
        );
    }

    public function availableRoom(Request $request): Response
    {
        $user = User::find($request->id_user);
        if ($user->credit_points) {
            $user->credit_points = ($user->credit_points - 5);
            $user->save();
        }

        $kost = Kost::find($request->id);

        return response(
            $kost,
            200
        );
    }

    public function detailKost(Request $request): Response
    {
        $kost = Kost::find($request->id);

        return response(
            $kost,
            200
        );
    }
}
