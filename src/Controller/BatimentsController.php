<?php

namespace App\Controller;

use App\Entity\Batiments;
use App\Form\BatimentType;
use App\Repository\BatimentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BatimentsController extends AbstractController
{
    /**
     * @Route("/batiment/", name="app_batiment_index", methods="GET")
     */
    public function index(BatimentsRepository $repository): Response
    {
        $batiments = $repository->findAll();

        return $this->render('batiments/index.html.twig', [
            'batiments' => $batiments,
        ]);
    }

    /**
     * @Route("/batiment/create", name="app_batiment_create", methods={"GET","POST"})
     */
    public function create(Request $requete, EntityManagerInterface $entityManager): Response
    {
        // entityManager est un objet Synfony permettant de sauvgarder des entites dans la base de donnees
        //Crée un produit
        $batiments = new Batiments();

        //intancier le formulaire

        $form = $this->createForm(BatimentType::class, $batiments);

        //"Voir" si le formulaire a ete soumis au niveau de la requete HTTP
        $form->handleRequest($requete); // tester si le formulaire a ete soumis


        if ($form->isSubmitted() && $form->isValid()) {
            // enregistrer le produit dans la base de données
            $entityManager->persist($batiments);
            $entityManager->flush();

            return $this->redirectToRoute('app_batiment_index');
        }


        return $this->render('batiments/create.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/batiment/{id}/edit", name="app_batiment_edit", methods={"GET","PUT"})
     */
    public function edit($id, Request $requete, EntityManagerInterface $entityManager, BatimentsRepository $repository): Response
    {
        // entityManager est un objet Synfony permettant de sauvgarder des entites dans la base de donnees
        //Rechercher le produit
        $batiments = $repository->find($id);

        //intancier le formulaire
        $form = $this->createForm(BatimentType::class, $batiments, [
            'method' => 'PUT'
        ]);

        //"Voir" si le formulaire a ete soumis au niveau de la requete HTTP
        $form->handleRequest($requete); // tester si le formulaire a ete soumis


        if ($form->isSubmitted() && $form->isValid()) {
            // enregistrer le produit dans la base de données
            $entityManager->flush();


            return $this->redirectToRoute('app_batiment_index');
        }


        return $this->render('batiments/edit.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/batiment/{id}", name="app_batiment_delete", methods="DELETE")
     */
    public function delete(Request $requete, $id, BatimentsRepository $repository, EntityManagerInterface $entityManager) : Response
    {

        $batiments = $repository->find($id);

        if ($this->isCsrfTokenValid('DELETE'.$batiments->getId(), $requete->request->get("_token"))) {

            $entityManager->remove($batiments);
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_batiment_index');
    }
}
