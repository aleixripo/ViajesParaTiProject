<?php

namespace App\Controller;

use App\Entity\Supplier;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;


class SupplierController extends AbstractController
{
    #[Route('/', name: 'app_supplier')]
    public function index(PersistenceManagerRegistry $doctrine): Response
    {
        $suppliers = $doctrine->getManager()->getRepository(Supplier::class)->findAll();

        return $this->render('home.html.twig', ['suppliers' => $suppliers]);
    }

    #[Route('/create', name: 'app_create_supplier')]
    public function create(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $phone = $request->request->get('phone');
            $supplierType = $request->request->get('supplierType');
            $isActive = $request->request->get('isActive') ? true : false;

            $supplier = new Supplier();
            $supplier->setName($name);
            $supplier->setEmail($email);
            $supplier->setPhone($phone);
            $supplier->setSupplierType($supplierType);
            $supplier->setIsActive($isActive);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($supplier);
            $entityManager->flush();

            return $this->redirectToRoute('app_supplier');
        }

        return $this->render('home.html.twig');
    }

    #[Route('/edit/{id}', name: 'app_edit_supplier')]
    public function edit(Request $request, PersistenceManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $supplier = $entityManager->getRepository(Supplier::class)->find($id);

        if (!$supplier) {
            throw $this->createNotFoundException('Proveedor no encontrado');
        }

        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $phone = $request->request->get('phone');
            $supplierType = $request->request->get('supplierType');
            $isActive = $request->request->get('isActive') ? true : false;

            $supplier->setName($name);
            $supplier->setEmail($email);
            $supplier->setPhone($phone);
            $supplier->setSupplierType($supplierType);
            $supplier->setIsActive($isActive);


            $entityManager->flush();


            return $this->redirectToRoute('app_supplier');
        }

        return $this->render('home.html.twig', ['supplier' => $supplier]);
    }

    #[Route('/delete/{id}', name: 'app_delete_supplier')]
    public function delete(PersistenceManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $supplier = $entityManager->getRepository(Supplier::class)->find($id);

        if (!$supplier) {
            throw $this->createNotFoundException('Proveedor no encontrado');
        }

        $entityManager->remove($supplier);
        $entityManager->flush();

        // Puedes redirigir a donde desees después de la eliminación
        return $this->redirectToRoute('app_supplier');
    }
}
