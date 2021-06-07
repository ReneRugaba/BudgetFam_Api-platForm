<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Members;
use App\Service\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


Class MembersPersister implements DataPersisterInterface{

    private EntityManagerInterface $entityManagerInterface;
    private UserPasswordHasherInterface $userPasswordHasherInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface,UserPasswordHasherInterface $userPasswordHasherInterface,private Mailer $serviceMailer)
    {
        $this->entityManagerInterface=$entityManagerInterface;
        $this->userPasswordHasherInterface=$userPasswordHasherInterface;
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

    if($data->getPassword() && $data->getPassword()!=null ){
        $data->setPassword($this->userPasswordHasherInterface->hashPassword(new Members(),$data->getPassword()));
    }else{
        $data->setPassword(null);
    }

    if ($data->getId()===null) {
        //send email
        $subject="Mail registration";
        $templete='email/registration.html.twig';
        $this->serviceMailer->sendMail($data,$subject,$templete);
    }
    $this->entityManagerInterface->persist($data);
    $this->entityManagerInterface->flush();
   }

   /**
    * Removes the data.
    */
   public function remove($data){
    $this->entityManagerInterface->remove($data);
    $this->entityManagerInterface->flush();
   }

}