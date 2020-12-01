<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Project;
use App\Form\ContactType;
use App\Repository\ProjectRepository;
use App\Repository\TechnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        ProjectRepository $projectRepository,
        TechnoRepository $technoRepository
    ): Response
    {
        $projects = [];
        $technos = $technoRepository->findAll();
        $projects = $projectRepository->findAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idTechno = $_POST['id_techno'];
            $techno = $technoRepository->findOneBy(['id' => $idTechno]);
            $projects = $techno->getProjects();
        }
        return $this->render('home/index.html.twig', [
            'projects' => $projects,
            'technos' => $technos
        ]);
    }

    /**
     * @Route("/projet/{id}", name="show_project")
     */
    public function project(Project $project): Response
    {
        return $this->render('home/project.html.twig', [
            'project' => $project
        ]);
    }

    /**
     * @Route("/contact", name="contact", methods={"GET","POST"})
     */
    public function contact(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }
}
