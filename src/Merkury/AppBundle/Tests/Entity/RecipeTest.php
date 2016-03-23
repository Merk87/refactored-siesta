<?php
/**
 * Created by Merkury (Víctor Moreno)
 * Date: 20/03/2016
 * Time: 15:59
 */

namespace Merkury\AppBundle\Tests\Entity;

use ReflectionClass;
use Merkury\AppBundle\Entity\Recipe;


class RecipeTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor(){

        $now = date('d/m/Y H:i:s');

        $stubRecipe = $this->getMockBuilder(Recipe::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stubRecipe->expects($this->once())
            ->method('setCreatedAt')
            ->with(
                $this->equalTo($now)
            );

        $reflectedRecipe = new ReflectionClass(Recipe::class);
        $constructor = $reflectedRecipe->getConstructor();
        $constructor->invoke($stubRecipe, $now);
    }
}
