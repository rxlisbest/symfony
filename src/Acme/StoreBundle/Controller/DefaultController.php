<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\StoreBundle\Entity\Production;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name));
    }
    
        public function createAction()
    {
        $product = new production();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new Response('Created product id '.$product->getId());
    }
    
        public function showAction($id){
            $repository = $this->getDoctrine()
                ->getRepository('AcmeStoreBundle:Product');
            // query by the primary key (usually "id")
            $product = $repository->find($id);

            // dynamic method names to find based on a column value
            $product = $repository->findOneById($id);
            $product = $repository->findOneByName('foo');

            // find *all* products
            $products = $repository->findAll();

            // find a group of products based on an arbitrary column value
            $products = $repository->findByPrice(19.99);
        }
}
