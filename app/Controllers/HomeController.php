<?php

class HomeController extends RenderView
{
    public function index()
    {
        $orders = new Order;

        $this->loadView('home', [
            'title' => 'OII TITLE',
            'orders' => $orders->all()
        ]);
    }
}
