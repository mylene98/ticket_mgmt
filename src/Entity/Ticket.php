<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;
use App\Entity\User;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    private $updatedAt;

   

    #[ORM\Column(type: 'string', length: 255)]
    private $type;
    
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $Category;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $Demandeur;
    
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tickets1')]
    #[ORM\JoinColumn(nullable: false)]
    private $assignedTo;

    #[ORM\Column(type: 'string', length: 255)]
    private $status;
    #[ORM\Column(type: 'datetime')]
    private $affectedAt;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $priority;
    #[ORM\Column(type: 'text')]
    private $solution;

    #[ORM\Column(type: 'string', length: 255)]
    private $Title;

    #[ORM\Column(type: 'text')]
    private $description;

 



   

    


 


    

  

  

   

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }
    public function getDemandeur(): ?User
    {
        return $this->Demandeur;
    }

    public function setDemandeur(?User $Demandeur): self
    {
        $this->Demandeur = $Demandeur;

        return $this;
    }

    public function getAssignedTo(): ?User
    {
        return $this->assignedTo;
    }

    public function setAssignedTo(?User $assignedTo): self
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
    public function getAffectedAt(): ?\DateTimeInterface
    {
        return $this->affectedAt;
    }

    public function setAffectedAt(\DateTimeInterface $affectedAt): self
    {
        $this->affectedAt = $affectedAt;

        return $this;
    }
    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }
    public function getSolution(): ?string
    {
        return $this->solution;
    }

    public function setSolution(string $solution): self
    {
        $this->solution = $solution;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

   

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
 
    public function __toString() {
        return $this->type ;
    }
    
   

    

    

   

    



    

    
}
