<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension {
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('tags', array($this, 'tagFunction')),
        );
    }

    public function tagFunction()
    {
        return $tags;
    }
}