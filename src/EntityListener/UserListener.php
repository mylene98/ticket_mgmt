<?php

namespace App\EntityListener;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
 class UserListener {

    private UserPasswordHasherInterface $hasher;
    public function __construct (UserPasswordHasherInterface $hasher)
    {
        $this->hasher= $hasher;
    }
     public function prePersist(User $user) {
        $this->encoderPassword($user);

     }
     public function preUpdate(User $user) {
        $this->encoderPassword($user);
         
    }
    public function encoderPassword(User $user) {
        if ($user->getPlainPassword() ===null){
            return;
        }
         $user ->setPassword(
            $this->hasher->hashPassword(
                $user,
                $user->getplainPassword()
            )
         );
         $user->setplainPassword(null);
    }

 }