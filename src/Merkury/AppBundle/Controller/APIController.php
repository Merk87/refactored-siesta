<?php

namespace Merkury\AppBundle\Controller;

use Merkury\AppBundle\Entity\Recipe;
use Merkury\AppBundle\Model\CSVModel;
use ReflectionClass;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class APIController
 * @package AppBundle\Controller
 * @Route("/api")
 */
class APIController extends Controller
{
    /**
     * @Route("/get/all", name="api_search_all")
     * @Method("GET")
     */
    public function retrieveAllAction(){
        return new JsonResponse(Recipe::selectAll());
    }

    /**
     * @Route("/get/id/{id}", name="api_search_by_id", requirements={
     *      "id": "\d+"
     *     })
     * @Method("GET")
     */
    public function searchByIdAction($id){
        return new JsonResponse(Recipe::select(['id' => $id])->toArray());
    }

    /**
     * This funtion will look and return all the recipes of certain cuisine paginated.
     * The url will have as parameters:
     * @param $cuisine string (Required)
     * @param $page (Required)
     * @param $limit (Optional, by default 2)
     * @Route("/get/cuisine/{cuisine}/{page}/{limit}", defaults={"limit" = 2, "page" = 1}, name="api_search_by_cuisine", requirements={
     *      "page": "\d+"
     *    })
     * @Method("GET")
     * @return JsonResponse
     */
    public function searchByCuisineAction($cuisine, $page, $limit = 2){

        return new JsonResponse(Recipe::selectPaginated(['recipe_cuisine' => $cuisine], $page, $limit, true));
    }

    /**
     * @param $id
     * @Route("/set/rating/{id}/{rating}", name="api_rate_recipe_get", defaults={"id" = 0, "rating" = 0},requirements={
            "id": "\d+",
     *      "rating": "[1-5]{1}"
     *    })
     * @return JsonResponse
     * @Method("GET")
     */
    public function rateRecipeAction($id, $rating){

        $recipe = Recipe::select(['id' => $id]);
        if(!$recipe){
            return new  JsonResponse('Recipe not found', 404);
        }
        $recipe->setRating($rating);
        $recipe->persist();
        return new JsonResponse($recipe->toArray());
    }

    /**
     * @Route("/set/rating", name="api_rate_recipe_post")
     * @return JsonResponse
     * @Method("POST")
     */
    public function rateRecipePostAction(){

        $params = $this->get('request')->query->all();
        if($params['rating'] < 1 || $params['rating'] > 5){
            return new JsonResponse('The rating value is not valid, must be a number between 1 and 5', 400);
        }
        $recipe = Recipe::select(['id' => $params['id']]);
        if(!$recipe){
            return new  JsonResponse('Recipe not found', 404);
        }
        $recipe->setRating($params['rating']);
        $recipe->persist();
        return new JsonResponse($recipe->toArray());
    }


    /**
     * Function to add a new recipe.
     * @Route("/add/recipe", name="api_add_recipe")
     * @Method("POST")
     * @return JsonResponse
     */
    public function createRecipeAction(){
        $params = $this->get('request')->query->all();
        $recipe = new Recipe();
        $result = $recipe->save($params);
        $res = $result->persist();

        return $res != false ? new JsonResponse($res) : new JsonResponse('Something went terribly wrong...', 500);
    }

    /**
     * Function to update a existing recipe.
     * @Route("/update/recipe", name="api_update_recipe")
     * @Method("POST")
     * @return JsonResponse
     */
    public function updateRecipeAction(){
        $params = $this->get('request')->query->all();
        $recipe = Recipe::select(['id' => $params['id']]);
        if(!$recipe){
            return new  JsonResponse('Recipe not found', 404);
        }
        $result = $recipe->save($params, false);
        $res = $result->persist();
        return $res != false ? new JsonResponse($res) : new JsonResponse('Something went terribly wrong...', 500);
    }

}
