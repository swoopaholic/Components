<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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