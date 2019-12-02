<?php


namespace App\Filtering\Mayday;

use Symfony\Component\HttpFoundation\Request;

class MaydayFilterDefinitionFactory
{
    public function factory(Request $request)
    {
        return new MaydayFilterDefinition(
            $request->get('source'),
        );

    }
}