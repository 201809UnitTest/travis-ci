<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 08:37
 */

namespace Tests;

use App\BookDao;
use App\IBookDao;
use App\Order;
use App\OrderService;
use PHPUnit\Framework\TestCase;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;

class OrderServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;
    /**
     * @var OrderService
     */
    private $target;
    private $spyBookDao;

    protected function setUp()
    {
        $this->target = new OrderServiceForTest();
        $this->spyBookDao = m::spy(IBookDao::class);
        $this->target->setBookDao($this->spyBookDao);
    }

    public function test_sync_book_orders_3_orders_only_2_book_order()
    {

        $this->givenOrders(['Book', 'CD', 'Book']);

        $this->target->syncBookOrders();

        $this->bookDaoShouldInsert(2);
    }

    /**
     * @param $type
     * @return Order
     */
    private function createOrder($type): Order
    {
        $order1 = new Order();
        $order1->type = $type;

        return $order1;
    }

    /**
     * @param $types
     */
    private function givenOrders($types): void
    {
        $orders = [];
        foreach ($types as $type) {
            $orders[] = $this->createOrder($type);
        }

        $this->target->setOrders($orders);
    }

    private function bookDaoShouldInsert($times): void
    {
        $this->spyBookDao->shouldHaveReceived('insert')->with(m::on(function (Order $order) {
            return $order->type == 'Book';
        }))->times($times);
    }
}

class OrderServiceForTest extends OrderService
{
    private $orders;
    private $bookDao;

    public function setBookDao($bookDao)
    {
        $this->bookDao = $bookDao;
    }

    protected function getBookDao(): IBookDao
    {
        return $this->bookDao;
    }

    public function setOrders($orders)
    {
        $this->orders = $orders;
    }

    protected function getOrders()
    {
        return $this->orders;
    }
}













