<?php

namespace App\Services;

class ProductService extends Service
{
    public $baseUri = "http://localhost:8001";

    public function getProducts()
    {
        return $this->performRequest('GET', $this->baseUri.'/products');
    }

    public function createProduct($data)
    {
        return $this->performRequest('POST', $this->baseUri.'/products', $data);
    }

    public function showProduct($id)
    {
        return $this->performRequest('GET', $this->baseUri."/products/{$id}");
    }

    public function updateProduct($id, $data)
    {
        return $this->performRequest('PUT', $this->baseUri."/products/{$id}", $data);
    }

    public function deleteProduct($id)
    {
        return $this->performRequest('DELETE', $this->baseUri."/products/{$id}");
    }
}