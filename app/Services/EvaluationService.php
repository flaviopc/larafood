<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\Request;

class EvaluationService
{
    protected $evaluationRepository, $orderRepository;

    public function __construct(
        EvaluationRepositoryInterface $evaluationRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->evaluationRepository = $evaluationRepository;
    }

    public function createNewEvaluation(string $identifyOrder,array $evaluation)
    {
        $clientId = $this->getIdClient();
        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return $this->evaluationRepository->newEvaluationOrder($order->id,$clientId,$evaluation);
    }

    private function getIdClient()
    {
        return auth()->check() ? auth()->user()->id : '';
    }

}
