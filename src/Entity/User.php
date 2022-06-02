<?php

namespace App\Entity;
use \App\Entity\Role;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use symfony\Component\Validator\Constraints as Assert;




#[UniqueEntity('Email')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\EntityListeners(['App\EntityListener\UserListener'])]
#[UniqueEntity(fields: ['Email'], message: 'There is already an account with this Email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank()]
    #[Assert\lenght(min :2  , max:255)]
    private string $fullName;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\Email()]
    #[Assert\lenght(min :2  , max:180, unique:true)]
    private string $Email;

    

    #[ORM\Column(type: 'json')]
    #[Assert\NotNull()]
    private array $roles = [];

    private ?string $plainPassword ;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]
    private string $password ='password';
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Picture;


    #[ORM\OneToMany(mappedBy: 'Demandeur', targetEntity: Ticket::class)]
    private $tickets;

    #[ORM\OneToMany(mappedBy: 'assignedTo', targetEntity: Ticket::class)]
    private $tickets1;

    #[ORM\ManyToMany(targetEntity: Role::class, mappedBy: 'users')]
    private $userRoles;

   
    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->tickets1 = new ArrayCollection();
        $this->userRoles = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->Email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->userRoles->map(function ($role){
          return $role-> getTitle();
        })->toArray();
    
        $roles[] = 'ROLE_USER';

        return $roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function getplainPassword(): string
    {
        return $this->plainPassword;
    }

    public function setplainPassword( $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(?string $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setDemandeur($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getDemandeur() === $this) {
                $ticket->setDemandeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets1(): Collection
    {
        return $this->tickets1;
    }

    public function addTickets1(Ticket $tickets1): self
    {
        if (!$this->tickets1->contains($tickets1)) {
            $this->tickets1[] = $tickets1;
            $tickets1->setAssignedTo($this);
        }

        return $this;
    }

    public function removeTickets1(Ticket $tickets1): self
    {
        if ($this->tickets1->removeElement($tickets1)) {
            // set the owning side to null (unless already changed)
            if ($tickets1->getAssignedTo() === $this) {
                $tickets1->setAssignedTo(null);
            }
        }

        return $this;
    }
   

    /**
     * @return Collection<int, Role>
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->removeElement($userRole)) {
            $userRole->removeUser($this);
        }

        return $this;
    }
    public function __toString() {
        return $this->fullName;
    }


   
}
