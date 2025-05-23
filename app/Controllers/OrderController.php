<?php

class OrderController extends RenderView
{
    public function index()
    {
        $this->loadView('orders', [
            'title' => 'Pedidos'
        ]);
    }
}
