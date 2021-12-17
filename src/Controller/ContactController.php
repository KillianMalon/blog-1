<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository){
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route("/contact/{id}", name="contact")
     */
    public function index(Request $request, string $id = ""): Response
    {
        $contact = new Contact();
        $form = $this ->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($form->getData());
            $manager->flush();
        }


        return $this->render('contact/index.html.twig', [
            'id' => $id,
            'controller_name' => 'ContactController',
            'contacts' => $this->contactRepository->findAll(),
            'mycontact' => $this->contactRepository->find($id),
            'form' => $form->createView()
        ]);
    }

}
