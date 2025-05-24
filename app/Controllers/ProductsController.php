<?php

require_once __DIR__ . '/../UseCase/ProductUseCase.php';

class ProductsController extends RenderView
{
    /**
     * Exibe a lista de produtos.
     *
     * @return void
     */
    public function index()
    {
        $products = new ProductModel;
        $this->loadView('products/index', [
            'title'     => 'Produtos',
            'products'  => Helpers::listToCamelCase($products->all())
        ]);
    }

    /**
     * Exibe os detalhes de um produto específico.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        // Lógica para buscar um produto pelo ID e exibir seus detalhes
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
    public function edit($id)
    {
        // Lógica para buscar o produto e exibir o formulário preenchido
    }

    /**
     * Processa a edição e atualiza os dados do produto no banco.
     *
     * @param int $id ID do produto
     * @return void
     */
    public function update($id)
    {
        // Lógica para atualizar o produto com os dados enviados via POST
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
