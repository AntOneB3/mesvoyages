<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\admin;

use App\Entity\Visite;
use App\Repository\VisiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Description of AdminVoyagesController
 *
 * @author abego
 */
class AdminVoyagesController extends AbstractController{
    
    /**
     * @Route("/admin", name="admin.voyages")
     * @return Response
     */
    public function index() : Response 
    {
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render("admin/admin.voyages.html.twig", ['visites' => $visites]);
    } 
    
    /**
     *
     * @var type 
     */
    private $repository;
    
    /**
     * 
     * @param VisiteRepository $repository
     * @param EntityManagerInterface $om
     */
    function __construct(VisiteRepository $repository, EntityManagerInterface $om) {
        $this->repository = $repository;
        $this->om = $om;
    }
    
    /**
     *
     * @var EntityManagerInterface 
     */
    private $om;
    
    
    /**
     * @Route("/admin/suppr/{id}", name="admin.voyage.suppr")
     * @param Visite $visite
     * @return Response
     */
    public function suppr(Visite $visite): Response{
        $this->om->remove($visite);
        $this->om->flush();
        return $this->redirectToRoute('admin.voyages');
    }
}
