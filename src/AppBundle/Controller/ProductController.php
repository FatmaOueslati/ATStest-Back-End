<?php
namespace AppBundle\Controller;


use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends Controller
{

    /**
     * @Route("/products")
     * @Method({"GET"})
     * @return JsonResponse
     */
    public function GetProducts()
    {
        $products=$this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

            if (!count($products)){
                $response=array(
                    'message'=>'No products found!',
                    'errors'=>null,
                    'result'=>null
                );
                return new JsonResponse($response);
            }

            $data=$this->get('jms_serializer')->serialize($products,'json');
            $response=array(
                'message'=>'success',
                'errors'=>null,
                'result'=>json_decode($data)
            );
        return new JsonResponse($response);

    }

    /**
     *
     * @Route("details/{id}")
     * @Method("GET")
     * @param $id
     * @return JsonResponse
     */
    public function getProduct($id)
    {
        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);


        if (empty($product)) {
            $response = array(
                'message' => 'product not found',
                'error' => null,
                'result' => null
            );

            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }

        $data = $this->get('jms_serializer')->serialize($product, 'json');


        $response = array(

            'message' => 'success',
            'errors' => null,
            'result' => json_decode($data)

        );

        return new JsonResponse($response, 200);


    }


}