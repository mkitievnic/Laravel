<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = $this->userRepository->update($input, $id);

        Flash::success('Usuario actualizado correctamente.');

        if($user->esEmpleado)
            return redirect(route('empleados.index'));
        else
            return redirect(route('instructors.index'));

    }

    public function updatePassword($id, Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:5|max:20|confirmed',
        ]);

        $user = $this->userRepository->find($id);

        $input = $request->all();

        //verificando si la contrasena actual es la correcta
        if(! \Hash::check($request->old_password, \Auth::user()->password))
        {
            Flash::error('La contraseña actual no es la correcta!.');
            return redirect()->route('users.show', $user);
        }

        $user = $this->userRepository->update($input, $id);
        Flash::success('Actualizado correctamente!.');
        return redirect()->route('users.show', $user);
    }
}
