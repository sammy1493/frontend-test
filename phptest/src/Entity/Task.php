<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
   /**
    * @ORM\Column(type="text", length=200)
   */
   private $description;

   //getter & setter

   public function getId(){
   return $this->id;
}

public function getdescription(){
     return $this-> description;
}

public function setdescription($description){
     $this->description = $description;
 }
}