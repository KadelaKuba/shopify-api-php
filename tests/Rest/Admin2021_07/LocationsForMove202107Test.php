<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_07\LocationsForMove;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class LocationsForMove202107Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-07";

        $this->test_session = new Session("session_id", "test-shop.myshopify.io", true, "1234");
        $this->test_session->setAccessToken("this_is_a_test_token");
    }

    /**

     *
     * @return void
     */
    public function test_1(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["locations_for_move" => [["location" => ["id" => 1072404544, "name" => "Alpha Location"], "message" => "Current location.", "movable" => false], ["location" => ["id" => 1072404545, "name" => "Bravo Location"], "message" => "No items are stocked at this location.", "movable" => false]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/fulfillment_orders/1046000783/locations_for_move.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        LocationsForMove::all(
            $this->test_session,
            ["fulfillment_order_id" => "1046000783"],
            [],
        );
    }

}
