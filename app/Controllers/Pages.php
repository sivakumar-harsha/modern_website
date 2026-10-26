<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function about(): string
    {
        return view('pages/about', [
            'title'       => 'About',
            'description' => 'Placeholder introduction to the business, its purpose and approach.',
            'navActive'   => 'about',
        ]);
    }

    public function services(): string
    {
        return view('pages/services', [
            'title'       => 'Services',
            'description' => 'Placeholder overview of the services offered.',
            'navActive'   => 'services',
        ]);
    }
}
