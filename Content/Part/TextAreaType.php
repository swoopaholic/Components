<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 17/03/14
 * Time: 20:45
 */

namespace Swoopaholic\Component\Content\Part;

class TextAreaType implements PartInterface
{
    private $text = 'Content';

    /**
     * @param string $content
     */
    public function setText($content)
    {
        $this->text = $content;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    public function getFormClass()
    {
        return '\Swoopaholic\Component\Content\Form\TextAreaType';
    }

    public function getType()
    {
        return 'textarea';
    }
}