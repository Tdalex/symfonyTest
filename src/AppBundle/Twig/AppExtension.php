<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Article;

class AppExtension extends \Twig_Extension {
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('tags', array($this, 'getAllTags')),
        );
    }

    public function getAllTags(Article $article)
    {
        $labels = array();
        foreach($article->getTags() as $tags){
            $labels = $tag->getName();
        }
        return implode(' - ', $labels);
    }
}   