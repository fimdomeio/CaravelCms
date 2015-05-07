<?php namespace App\Transformer;
use User;

class UserTransformer {
    public function transform(User $user)
    {
        return [
            'name'           => $user->name,
            'email'          => $user->email,
            'confirmed'      => $user->
        ];
    }
}