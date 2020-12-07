<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class OrderService
{
    protected $orderRepository, $tenantRepository, $tableRepository, $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;
    }

    public function ordersByClient()
    {
        $idClient = $this->getClientIdByOrder();

        return $this->orderRepository->getOrdersByClientId($idClient);
    }

    public function getOrderByIdentify(string $identify)
    {

        return $this->orderRepository->getOrderByIdentify($identify);
    }

    public function createNewOrder(array $order)
    {
        $products = $this->getProductsByOrder($order['products'] ?? []);
        $identify = $this->getIdentifyOrder();
        $total = $this->getTotalOrder($products);
        $status = 'open';
        $tenantId = $this->getTenantIdByOrder($order['token_company']);
        $clientId = $this->getClientIdByOrder();
        $tableId = $this->getTableIdByOrder($order['table'] ?? '');
        $comment = isset($order['comment']) ?$order['comment'] : '';

        $order = $this->orderRepository->createNewOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $comment,
            $clientId,
            $tableId
        );

        $this->orderRepository->registerProductOrder($order->id, $products);

        return $order;
    }

    private function getIdentifyOrder(int $qtdCharacters = 6)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        $characters = $smallLetters . $numbers;
        $identify = substr(str_shuffle($characters), 0, $qtdCharacters);

        //verifica se há identificador igual
        $identifyNew = $this->orderRepository->getOrderByIdentify($identify);
        if ($identifyNew)
            $this->getIdentifyOrder($qtdCharacters + 1);

        return $identify;
    }

    private function getProductsByOrder(array $productsOrder): array
    {
        $products = [];
        foreach ($productsOrder as $productOrder) {
            $product = $this->productRepository->getProductByUuid($productOrder['identify']);
            array_push($products, [
                'id' => $product->id,
                'qtd' => $productOrder['qtd'],
                'price' => $product->price
            ]);
        }

        return $products;
    }

    private function getTotalOrder(array $products): float
    {
        $total = 0;
        foreach ($products as $product)
            $total += $product['price'] * $product['qtd'];

        return (float) $total;
    }

    private function getTenantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $tenant->id;
    }

    private function getTableIdByOrder(string $uuid = '')
    {
        if ($uuid) {
            $table = $this->tableRepository->getTableByUuid($uuid);
            return $table->id;
        }
        return $uuid;
    }

    private function getClientIdByOrder()
    {
        return auth()->check() ? auth()->user()->id : '';
    }
}
