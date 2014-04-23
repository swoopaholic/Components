<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Content;

interface DocumentInterface
{
    public function setContent($content);

    public function getContent();

    public function addContent($content);

    public function removeContent($id);
} 