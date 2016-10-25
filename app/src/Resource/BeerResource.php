<?php

namespace App\Resource;

use App\AbstractResource;
use App\Entity\Beers as Beer;

/**
 * Class Resource
 * @package App
 */

/**
* 
*/
class BeerResuorce extends AbstractResource
{
	
	/**
     * @param string|null $id
     *
     * @return array
     */
    public function get($id = null)
    {
        if ($id === null) {
            $beers = $this->entityManager->getRepository('App\Entity\Beers')->findAll();
            $beers = array_map(
                function ($beers) {
                    $beers = $beers->getArrayCopy();
                    return $beers;
                },
                $beers
            );

            return $beers;
        } else {
            $beers = $this->entityManager->getRepository('App\Entity\Beers')->findOneBy(
                array('id'=>$id)
            );
            if ($beers) {
                $beers = $beers->getArrayCopy();
                return  $beers;
            }
        }

        return false;
    }

    /**
     * @param Beer|null $beer
     * @return Beer
     */
    public function post(Beer $beer = null)
    {

        $this->entityManager->persist($beer);
        $this->entityManager->flush();
        return $beer;
    }


    /**
     * @param $parseBody
     */
    public function update($parseBody)
    {
        $beer = $this->entityManager->getRepository('App\Entity\Beers')->findOneBy(
            array('id'=>$parseBody['id'])
        );
        $beer->setName($parseBody['beerName']);
        $this->entityManager->persist($beer);
        $this->entityManager->flush();
    }
}