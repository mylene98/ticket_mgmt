<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\User;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Component\Workflow\Exception\LogicException;
#[Route('/ticket')]

class TicketController extends AbstractController

{
    

    #[Route('/indexticket', name: 'app_ticket_index', methods: ['GET'])]
    
    

    public function index(TicketRepository $ticketRepository): Response

    {
        

        return $this->render('ticket/index.html.twig', [
            'tickets' => $ticketRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_ticket_new', methods: ['GET', 'POST'])]
    #[Is_Granted("ROLE_REQUESTER") ]
   
   
    public function new(Request $request, TicketRepository $ticketRepository , EntityManagerInterface  $entityManager ): Response
    {
        $ticket = new Ticket();
        
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticketRepository->add($ticket, true);


            $entityManager->persist($ticket);
            $entityManager->flush();

            $this->addFlash('success', 'Demande enregistrée !');

             
          
          


            return $this->redirectToRoute('app_ticket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ticket/new.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ticket_show', methods: ['GET'])]

   
    public function show(Ticket $ticket): Response
    {
        return $this->render('ticket/show.html.twig', [
            'ticket' => $ticket,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ticket_edit', methods: ['GET', 'POST'])]
    #[Security( "is_granted('ROLE_REQUESTER') and user === ticket.getDemandeur() ")]


    public function edit(Request $request, Ticket $ticket, TicketRepository $ticketRepository): Response
    {
       
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticketRepository->add($ticket, true);

            return $this->redirectToRoute('app_ticket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ticket/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ticket_delete', methods: ['POST'])]
   #[Security( "is_granted('ROLE_REQUESTER') and user === ticket.getDemandeur()")]
  

    public function delete(Request $request, Ticket $ticket, TicketRepository $ticketRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ticket->getId(), $request->request->get('_token'))) {
            $ticketRepository->remove($ticket, true);
        }

        return $this->redirectToRoute('app_ticket_index', [], Response::HTTP_SEE_OTHER);
    }
}
