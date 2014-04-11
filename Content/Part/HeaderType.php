<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 17/03/14
 * Time: 20:44
 */

namespace Swoopaholic\Component\Content\Part;

class HeaderType implements PartInterface
{
    private $type = 'h1';

    private $content = 'Title';

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $type
     */
    public function setLevel($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->type;
    }

    public function getFormClass()
    {
        return '\Swoopaholic\Component\Content\Form\HeaderType';
    }

    public function getType()
    {
        return 'header';
    }
}