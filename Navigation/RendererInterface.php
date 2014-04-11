<?php

namespace Swoopaholic\Component\Navigation;

interface RendererInterface
{
    public function render(NavigationView $element, $options = array());
}
