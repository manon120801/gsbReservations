<?php

namespace App\Controller;

use App\Entity\Salles;
use App\Form\SalleType;
use App\Repository\SallesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SallesController extends AbstractController
{

    /**
     * @Route("/salle/", name="app_salle_index", methods="GET")
     */
    public function index(SallesRepository $repository) : Response
    {
        $salles = $repository->findAll();

        return $this->render('salles/index.html.twig', [
            'salles' => $salles,
        ]);
    }



    /**
     * @Route("/salle/create", name="app_salle_create", methods={"GET","POST"})
     */
    public function create(Request $requete,EntityManagerInterface $entityManager): Response
    {
        // entityManager est un objet Synfony permettant de sauvgarder des entites dans la base de donnees
        //Crée un produit
        $salles = new Salles();

        //intancier le formulaire

        $form = $this->createForm(SalleType::class,$salles);

        //"Voir" si le formulaire a ete soumis au niveau de la requete HTTP
        $form->handleRequest($requete); // tester si le formulaire a ete soumis


        if ($form->isSubmitted() && $form->isValid()) {
            // enregistrer le produit dans la base de données
            $entityManager->persist($salles);
            $entityManager->flush();

            return $this->redirectToRoute('app_salle_index');
        }



        return $this->render('salles/create.html.twig', [
            'form' => $form->createView()
        ]);

    }



    /**
     * @Route("/salle/{id}/edit", name="app_salle_edit", methods={"GET","PUT"})
     */
    public function edit($id,Request $requete, EntityManagerInterface $entityManager, SallesRepository $repository): Response
    {
        // entityManager est un objet Synfony permettant de sauvgarder des entites dans la base de donnees
        //Rechercher le produit
        $salles = $repository->find($id);

        //intancier le formulaire
        $form = $this->createForm(SalleType::class,$salles, [
            'method' => 'PUT'
        ]);

        //"Voir" si le formulaire a ete soumis au niveau de la requete HTTP
        $form->handleRequest($requete); // tester si le formulaire a ete soumis


        if ($form->isSubmitted() && $form->isValid()) {
            // enregistrer le produit dans la base de données
            $entityManager->flush();


            return $this->redirectToRoute('app_salle_index');
        }



        return $this->render('salles/edit.html.twig', [
            'form' => $form->createView()
        ]);

    }




    /**
     * @Route("/salle/{id}", name="app_salle_delete", methods="DELETE")
     */
    public function delete(Request $requete, $id, SallesRepository $repository, EntityManagerInterface $entityManager) : Response
    {

        $salles = $repository->find($id);

        if ($this->isCsrfTokenValid('DELETE'.$salles->getId(), $requete->request->get("_token"))) {

            $entityManager->remove($salles);
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_batiment_index');
    }
}
