<?php

class ProductsController extends RenderView
{
    /**
     * Exibe a lista de produtos.
     *
     * @return void
     */
    public function index()
    {
        $productModel = new ProductModel;
        $this->loadView('products/index', [
            'title'     => 'Produtos',
            'products'  => Helpers::listToCamelCase($productModel->all())
        ]);
    }

    /**
     * Exibe os detalhes de um produto específico.
     *
     * @param int $id
     * @return void
     */
    public function show($request)
    {
        $productModel = new ProductModel;
        $this->loadView('products/edit', [
            'title'     => 'Editando um produto',
            'product'   => Helpers::keysToCamelCase($productModel->getWithVariations($request['id']))
        ]);
    }

    /**
     * Exibe o formulário de criação de um novo produto.
     *
     * @return void
     */
    public function create()
    {
        $this->loadView('products/create', [
            'title' => 'Criar um produto',
        ]);
    }

    /**
     * Processa o formulário e armazena o novo produto no banco de dados.
     *
     * @return void
     */
    public function store()
    {
        $form = $_POST;

        $product = new ProductUseCase;
        $data = $product->create($form);

        if ($data['status']) {
            header("Location: " . Router::baseUrl('/produtos'));
            exit;
        }

        $this->loadView('products/create', [
            'title' => 'Criar um produto',
            'data'  => $data
        ]);
    }

    /**
     * Exibe o formulário de edição de um produto existente.
     *
     * @param int $id ID do produto
     * @return void
     */
    public function edit($id) {}

    /**
     * Processa a edição e atualiza os dados do produto no banco.
     *
     * @param int $id ID do produto
     * @return void
     */
    public function update($request)
    {
        $form = $_POST;

        $product = new ProductUseCase;
        $data = $product->update($request['id'], $form);

        header("Location: " . Router::baseUrl('/produtos/' . $request['id']));
    }

    /**
     * Remove um produto do banco de dados.
     *
     * @param int $id ID do produto
     * @return void
     */
    public function delete($id)
    {
        // Lógica para deletar o produto pelo ID
    }
}
