<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Members;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

Class MembersPersister implements DataPersisterInterface{

    private EntityManagerInterface $entityManagerInterface;
    private UserPasswordHasherInterface $userPasswordEncoderInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface,UserPasswordHasherInterface $userPasswordEncoderInterface)
    {
        $this->entityManagerInterface=$entityManagerInterface;
        $this->userPasswordEncoderInterface=$userPasswordEncoderInterface;
    }
   public function supports($data): bool{
        return $data instanceof Members;
   }

   /**
    * Persists the data.
    *
    * @return object|void Void will not be supported in API Platform 3, an object should always be returned
    */
   public function persist($data){

    if($data->getPassword() ){
        $data->setPassword($this->userPasswordEncoderInterface->hashPassword(new Members(),$data->getPassword()));
    }
    $this->entityManagerInterface->persist($data);
    $this->entityManagerInterface->flush();
   }

   /**
    * Removes the data.
    */
   public function remove($data){

   }

}