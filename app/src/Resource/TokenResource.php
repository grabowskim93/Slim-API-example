<?php
/**
 * Created by PhpStorm.
 * User: mateuszgra
 * Date: 2016-10-18
 * Time: 08:40
 */

namespace App\Resource;

use App\AbstractResource;
use App\Entity\AccessTokens as Token;

class TokenResource extends AbstractResource
{

    /**
     * @param Token|null $token
     * @return Token
     */
    public function post(Token $token = null) {

        $this->entityManager->persist($token);
        $this->entityManager->flush();
        return $token;
    }

    /**
     * @param $token
     * @return array
     */
    public function check($token) {
        $userToken = $this->entityManager->getRepository('App\Entity\AccessTokens')->findOneBy(array(
            'accessTokens'=>$token
        ));
        if (count($userToken)) {
//            $userToken->getUser()->getArrayCopy();
            return $userToken->getUser()->getArrayCopy();
        } else {
            return array();
        }
    }

    /**
     * @param $token
     * @return null|object
     */
    public function get($token) {
        $accessToken = $this->entityManager->getRepository('App\Entity\AccessTokens')->findOneBy(
            array('accessTokens'=>$token)
        );
        if ($accessToken) {
            $accessToken = $accessToken->getArrayCopy();
            unset($accessToken['beer']);
            return  $accessToken;
        }
    }
}
