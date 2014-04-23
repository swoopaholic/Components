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