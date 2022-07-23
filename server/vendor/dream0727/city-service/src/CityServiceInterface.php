<?php
namespace CityService;

interface CityServiceInterface
{
    // 预下单
    public function preAddOrder(array $data = []):ResponseInterface;

    // 下单
    public function addOrder(array $data = []):ResponseInterface;

    // 取消配送单
    public function cancelOrder(array $data = []):ResponseInterface;

    // 模拟配送公司更新配送订单状态
    public function mockUpdateOrder(array $data = [], array $params = []):ResponseInterface;
}