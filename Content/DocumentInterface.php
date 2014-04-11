<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 13/03/14
 * Time: 12:14
 */

namespace Swoopaholic\Component\Content;

interface DocumentInterface
{
    public function setContent($content);

    public function getContent();

    public function addContent($content);

    public function removeContent($id);
} 