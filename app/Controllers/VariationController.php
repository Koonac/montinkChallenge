<?php

class VariationController extends RenderView
{
    /**
     * Remove uma varição do banco de dados.
     *
     * @param $request
     * @return json
     */
    public function delete($request)
    {
        $variationUseCase = new VariationUseCase;

        echo json_encode($variationUseCase->delete($request['variationId']));
    }
}
