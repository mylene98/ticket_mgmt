<?php

namespace App\DataFixtures;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Role;
use App\Entity\Ticket;
use App\Entity\Category;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AppFixtures extends Fixture
  
{
   

  
       
    


    public function load(ObjectManager $manager): void
    {
       
       
        $this->faker = Factory::create('fr-Fr');
//admin métier
        $adminRole = new Role();
        $adminRole -> setTitle('ROLE_ADMIN_METIER');
        $manager->persist ($adminRole);
        $genres = ['male','female'];
        for($i= 0 ; $i <= 5; $i++){
            $adminuser=new User();
            $genre= $this->faker->randomElement($genres);
            $picture ='https://randomuser.me/api/portraits/';
            $pictureId=$this->faker->numberBetween(1,99) . '.jpg';
            $picture .= ($genre== 'male' ? 'men/' :'women/') . $pictureId;
        $adminuser ->setFullName($this->faker->name);  
        $adminuser ->setEmail($this->faker->email);
        $adminuser ->setRoles(['ROLE_ADMIN_METIER']);
        $adminuser->setplainPassword('password');
        $adminuser->setPicture($picture);
        $adminuser->AddUserRole($adminRole);

        $manager->persist ($adminuser);
        }
//admin IT
         $adminRole = new Role();
         $adminRole -> setTitle('ROLE_ADMIN_IT');
         $manager->persist ($adminRole);
         $genres = ['male','female'];
       for($i= 0 ; $i <= 5; $i++){
     $admin1user=new User();
     $genre= $this->faker->randomElement($genres);
      $picture ='https://randomuser.me/api/portraits/';
      $pictureId=$this->faker->numberBetween(1,99) . '.jpg';
      $picture .= ($genre== 'male' ? 'men/' :'women/') . $pictureId;
     $admin1user ->setFullName($this->faker->name);  
     $admin1user ->setEmail($this->faker->email);
     $admin1user ->setRoles(['ROLE_ADMIN_IT']);
     $admin1user->setplainPassword('password');
     $admin1user->setPicture($picture);
     $admin1user->AddUserRole($adminRole);

      $manager->persist ($admin1user);
}
   // technicien      
   $adminRole = new Role();
   $adminRole -> setTitle('ROLE_TECHNICIEN');
   $manager->persist ($adminRole);
   $genres = ['male','female'];
 for($i= 0 ; $i <= 5; $i++){
$admintuser=new User();
$genre= $this->faker->randomElement($genres);
$picture ='https://randomuser.me/api/portraits/';
$pictureId=$this->faker->numberBetween(1,99) . '.jpg';
$picture .= ($genre== 'male' ? 'men/' :'women/') . $pictureId;
$admintuser ->setFullName($this->faker->name);  
$admintuser ->setEmail($this->faker->email);
$admintuser ->setRoles(['ROLE_TECHNICIEN']);
$admintuser->setplainPassword('password');
$admintuser->setPicture($picture);
$admintuser->AddUserRole($adminRole);

$manager->persist ($admintuser);
}
//demandeur
 $adminRole = new Role();
 $adminRole -> setTitle('ROLE_REQUESTER');
 $manager->persist ($adminRole);
 $genres = ['male','female'];
 for($i= 0 ; $i <= 5; $i++){
 $adminruser=new User();
 $genre= $this->faker->randomElement($genres);
 $picture ='https://randomuser.me/api/portraits/';
 $pictureId=$this->faker->numberBetween(1,99) . '.jpg';
 $picture .= ($genre== 'male' ? 'men/' :'women/') . $pictureId;
 $adminruser ->setFullName($this->faker->name);  
 $adminruser ->setEmail($this->faker->email);
 $adminruser ->setRoles(['ROLE_REQUESTER']);
 $adminruser->setplainPassword('password');
 $adminruser->setPicture($picture);
 $adminruser->AddUserRole($adminRole);

$manager->persist ($adminruser);
}

        $users =[];
        $genres = ['male','female'];
        //user
        for($i= 0 ; $i <= 5; $i++){
            $user=new User();
            $genre= $this->faker->randomElement($genres);
            $picture ='https://randomuser.me/api/portraits/';
            $pictureId=$this->faker->numberBetween(1,99) . '.jpg';
            $picture .= ($genre== 'male' ? 'men/' :'women/') . $pictureId;
    
            $user ->setFullName($this->faker->name);
           
            $user ->setEmail($this->faker->email);
            $user ->setRoles(['ROLE_USER']);
            $user->setplainPassword('password');
            $user->setPicture($picture);
            

            $manager->persist ($user);
            $users []=$user;

       
         }
  
    //category
         for($i= 0 ; $i <=5 ; $i++){
           $category=new Category();

            $category ->setNom($this->faker->word());
       
            $category->setDescription($this->faker->text());
        
        

            $manager->persist ($category);
           $categories[] =$category;

   
        }
        // tickets
        $types =['Demande','incident'];
        $priorities =['high','medium','low'];
        $statuss =['New','In progress'];
        for($i= 0 ; $i <= 5 ; $i++){
            $ticket=new Ticket();
             $type = $this->faker->randomElement($types);
             $priority=$this->faker->randomElement($priorities);
             $status=$this->faker->randomElement($statuss);
             $ticket ->setTitle($this->faker->word());
             $ticket ->setType($type);
             $ticket ->setCategory($category);
             $ticket ->setPriority($priority);
             $ticket ->setDemandeur($user);
             $ticket ->setAssignedTo($user);
             $ticket ->setStatus($status);
             $ticket ->setCreatedAt($this->faker->dateTime());
             $ticket ->setUpdatedAt($this->faker->dateTime());
             $ticket ->setAffectedAt($this->faker->dateTime());

            

        
             $ticket->setSolution($this->faker->text());
             $ticket->setDescription($this->faker->text());
         
         
 
             $manager->persist ($ticket);
            $tickets[] =$ticket;
 
    
         }
       

          $manager->flush();
    }}
