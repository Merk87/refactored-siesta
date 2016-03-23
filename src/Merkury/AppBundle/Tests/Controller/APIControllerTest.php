<?php
/**
 * Created by Merkury (Víctor Moreno)
 * Date: 20/03/2016
 * Time: 13:26
 */

namespace Merkury\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class APIControllerTest extends WebTestCase
{
    public function testRetrieveAllAction(){
        $client = static::createClient();
        $client->request('GET', '/api/get/all');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->isJson($client->getResponse());
    }

    public function testSearchByIdAction(){
        $client = static::createClient();
        $client->request('GET', '/api/get/id/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->isJson($client->getResponse());
    }

    public function testSearchByCuisineAction(){
        $client = static::createClient();
        $client->request('GET', '/api/get/cuisine/british');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->isJson($client->getResponse());
    }

    public function testRateRecipeAction(){
        $client = static::createClient();
        $client->request('GET', '/api/set/rating/1/4');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->isJson($client->getResponse());
    }
}
