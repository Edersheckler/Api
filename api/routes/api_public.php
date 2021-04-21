<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Public Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('users', 'UserController@create');

// TODO: move to api.php to protect with Authorization token
################################################################################################################################

$router->get('clients/{id}', 'ClientController@byId');

$router->get('currencies', 'CurrencyController@paging');
$router->get('currencies/{id}', 'CurrencyController@byId');

// formas de cobro
$router->get('payment-options', 'PaymentController@paging');
$router->get('payment-options/{id}', 'PaymentController@byId');

// Paises
$router->get('countries', 'CountryController@paging');
$router->get('countries/{id}', 'CountryController@byId');

// Estados
$router->get('states', 'StateController@paging');
$router->get('states/{id}', 'StateController@byId');

// Ciudades
$router->get('cities', 'CityController@paging');
$router->get('cities/{id}', 'CityController@byId');

// Cajas
$router->get('cash-boxes', 'CashBoxController@paging');
$router->get('cash-boxes/{id}', 'CashBoxController@byId');

// Cajeros
$router->get('cashiers', 'CashierController@paging');
$router->get('cashiers/{id}', 'CashierController@byId');

// Clientes
$router->get('clients', 'ClientController@paging');
$router->get('clients/{id}', 'ClientController@byId');

// Directorio de clientes
$router->group(['prefix' => 'client-directories'], function () use ($router) {
    $router->get('/', 'ClientDirController@paging');
    $router->get('client/{clientId}', 'ClientDirController@byClientId');
    $router->get('{id}', 'ClientDirController@byId');
});

// Condiciones de pago
$router->get('payment-conditions', 'PaymentConditionController@paging');
$router->get('payment-conditions/{id}', 'PaymentConditionController@byId');

// Tipos de clientes
$router->get('client-types', 'ClientTypeController@paging');
$router->get('client-types/{id}', 'ClientTypeController@byId');

// Zonas de clientes
$router->get('client-zones', 'ClientZoneController@paging');
$router->get('client-zones/{id}', 'ClientZoneController@byId');

// Cobradores
$router->get('collectors', 'CollectorController@paging');
$router->get('collectors/{id}', 'CollectorController@byId');

// Vendedores
$router->get('vendors', 'VendorController@paging');
$router->get('vendors/{id}', 'VendorController@byId');

// Vias empaques
$router->get('shipping-lanes', 'ShippingLaneController@paging');
$router->get('shipping-lanes/{id}', 'ShippingLaneController@byId');

// articulos
$router->group(['prefix' => 'articles'], function () use ($router) {
    $router->get('/', 'ArticleController@paging');
    $router->get('{id}', 'ArticleController@byId');
    $router->get('/clave/{id}', 'ArticleController@byClave');
    $router->get('/iclave/{id}', 'ArticleController@byIClave');
    $router->get('/iname/{nombre}', 'ArticleController@byIName');
});

// Linea de articulos
$router->get('article-lines', 'ArticleLineController@paging');
$router->get('article-lines/{id}', 'ArticleLineController@byId');

// Grupos lineas
$router->get('line-groups', 'LineGroupController@paging');
$router->get('line-groups/{id}', 'LineGroupController@byId');

// Impuestos
$router->get('taxes', 'TaxController@paging');
$router->get('taxes/{id}', 'TaxController@byId');

// Precio articulos
$router->group(['prefix' => 'article-prices'], function () use ($router) {
    $router->get('/', 'ArticlePriceController@paging');
    $router->group(['prefix' => '{articlePriceId}'], function () use ($router) {
        $router->get('/', 'ArticlePriceController@byArticlePrice');
        $router->get('article/{articleId}/currency/{currencyId}', 'ArticlePriceController@byPriceArticleAndCurrency');
    });
});

// Precios empresas
$router->get('business-prices', 'BusinessPriceController@paging');
$router->get('business-prices/{id}', 'BusinessPriceController@byId');

################################################################################################################################

$router->get('warehouses/{id}', 'WarehouseController@byId');
$router->get('doctos-pv-ligas/', 'DoctoController@pagingLigas');

$router->get('doctos-pv/', 'DoctoController@paging');
$router->get('doctos-pv/{id}', 'DoctoController@byId');
$router->get('doctos-pv/{id}/details', 'DoctoController@detailById');
