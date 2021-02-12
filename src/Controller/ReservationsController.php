<?php

namespace App\Controller;

use App\Entity\Reservations;
use App\Form\ReserverType;
use App\Repository\ReservationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationsController extends AbstractController
{

    /**
     * @Route("/reservevation/", name="app_reserver_index", methods="GET")
     */
    public function index(ReservationsRepository $repository): Response
    {
        $reservations = $repository->findAll();

        return $this->render('reservations/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }
    /**
     * @Route("/reserver/create", name="app_reserver_create", methods={"GET","POST"})
     */
    public function create(Request $requete, EntityManagerInterface $entityManager): Response
    {
        // entityManager est un objet Synfony permettant de sauvgarder des entites dans la base de donnees
        //Crée un produit
        $reservations = new Reservations();

        //intancier le formulaire

        $form = $this->createForm(ReserverType::class, $reservations);

        //"Voir" si le formulaire a ete soumis au niveau de la requete HTTP
        $form->handleRequest($requete); // tester si le formulaire a ete soumis


        if ($form->isSubmitted() && $form->isValid()) {
            // enregistrer le produit dans la base de données
            $entityManager->persist($reservations);
            $entityManager->flush();

            return $this->redirectToRoute('app_reserver_index');
        }


        return $this->render('reservations/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/reservation/{id}/edit", name="app_reservation_edit", methods={"GET","PUT"})
     */
    public function edit($id, Request $requete, EntityManagerInterface $entityManager, ReservationsRepository $repository): Response
    {
        // entityManager est un objet Synfony permettant de sauvgarder des entites dans la base de donnees
        //Rechercher le produit
        $reservations = $repository->find($id);

        //intancier le formulaire
        $form = $this->createForm(ReserverType::class, $reservations, [
            'method' => 'PUT'
        ]);

        //"Voir" si le formulaire a ete soumis au niveau de la requete HTTP
        $form->handleRequest($requete); // tester si le formulaire a ete soumis


        if ($form->isSubmitted() && $form->isValid()) {
            // enregistrer le produit dans la base de données
            $entityManager->flush();


            return $this->redirectToRoute('app_reserver_index');
        }


        return $this->render('reservations/edit.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/reservation/{id}", name="app_reservation_delete", methods="DELETE")
     */
    public function delete(Request $requete, $id, ReservationsRepository $repository, EntityManagerInterface $entityManager) : Response
    {

        $reservations = $repository->find($id);

        if ($this->isCsrfTokenValid('DELETE'.$reservations->getId(), $requete->request->get("_token"))) {

            $entityManager->remove($reservations);
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_reserver_index');
    }
}
