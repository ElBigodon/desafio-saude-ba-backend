<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Addresses;
use App\Models\AddressUser;
use App\Models\Cep;
use App\Models\Profiles;
use App\Models\User;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function get(string $id)
    {
        $user = User::with(['addresses.cep', 'profile'])->where('uuid', '=', $id)->first();

        if (is_null($user)) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        return $user;
    }

    public function getAll()
    {
        return User::query()
            ->join('profiles', 'users.profile_uuid', '=', 'profiles.uuid')
            ->orderByDesc('created_at')
            ->get(["users.*", "profiles.name as profile_name"]);
    }

    public function create(UserRequest $request)
    {

        $hasUser = User::where('cpf', '=', $request->input('cpf'))
            ->orWhere(DB::raw('LOWER(name)'), 'LIKE', '%' . $request->input('name') . '%')
            ->first();

        if (!is_null($hasUser)) {
            return response()->json(['error' => 'Usuário já cadastrado'], 409);
        }

        DB::transaction(function () use ($request) {

            $addresses = collect($request->input('addresses'));

            $profile = Profiles::query()->where('name', '=', $request->input('profile'))->first();

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'cpf' => $request->input('cpf'),
                'profile_uuid' => $profile->uuid,
            ]);

            foreach ($addresses as $address) {
                $cep = Cep::where('name', '=', $address['cep'])->first();

                if (is_null($cep)) {
                    $cep = Cep::create([
                        'name' => $address['cep'],
                    ]);
                }

                $address = Addresses::create([
                    'name' => $address['address'],
                    'cep_uuid' => $cep->uuid,
                ]);

                AddressUser::create([
                    'user_uuid' => $user->uuid,
                    'address_uuid' => $address->uuid,
                ]);
            }
        });

    }

    public function delete(string $id)
    {
        $result = User::find($id);

        if (is_null($result)) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $result->delete();

        return response()->json(['result' => 'Usuário foi removido com sucesso'], 200);
    }
    public function update(UserRequest $request, string $uuid)
    {

        $result = User::find($uuid);

        if (is_null($result)) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $addresses = collect($request->input('addresses'));

        $profile = Profiles::query()->where('name', '=', $request->input('profile'))->first();

        $result->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'cpf' => $request->input('cpf'),
            'profile_uuid' => $profile->uuid,
        ]);

        foreach ($addresses as $address) {
            $cep = Cep::where('name', '=', $address['cep']);

            if (is_null($cep)) {
                $cep = Cep::create([
                    'name' => $address['cep'],
                ]);
            } else {
                $cep->update([
                    'name' => $address['cep'],
                ]);
            }

            $localAddress = Addresses::where('name', '=', $address['address']);

            if (is_null($address)) {
                Addresses::create([
                    'name' => $address['address'],
                    'cep_uuid' => $cep->uuid,
                ]);
            } else {
                $localAddress->update([
                    'name' => $address['address'],
                ]);
            }

        }

    }
}
