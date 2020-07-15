    <?php

if (config('product.models.product') !== null) {
    $model_class = config('product.models.product');
} else {
    $model_class = VCComponent\Laravel\Product\Entities\Product::class;
}

$model = new $model_class;
$api   = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => config('product.namespace')], function ($api) {
        $api->group(['prefix' => 'admin'], function ($api) {

            $api->delete('products/bulk', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@bulkDelete');
            $api->delete('products/{id}/force', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@forceDelete');
            $api->delete('products/trash/all', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@deleteAllTrash');
            $api->delete('products/trash/bulk', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@bulkDeleteTrash');
            $api->delete('products/trash/{id}', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@deleteTrash');
            $api->get('products/trash/all', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@getAllTrash');
            $api->get('products/trash', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@trash');
            $api->put('products/trash/bulk/restores', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@bulkRestore');
            $api->put('products/trash/{id}/restore', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@restore');

            $api->get('products/export', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@exportExcel');
            $api->get('products/all', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@list');
            $api->put('products/status/bulk', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@bulkUpdateStatus');
            $api->put('products/status/{id}', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@updateStatusItem');
            $api->resource('products', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController');
            $api->put('product/{id}/date', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@changeDatetime');
            $api->get('product/{id}/stock', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@checkStock');
            $api->put('product/{id}/quantity', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@updateQuantity');
            $api->put('product/{id}/change_quantity', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\ProductController@changeQuantity');

            $api->resource('attributes', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\AttributeController');
            $api->resource('attribute-value', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\AttributeValueController');
            $api->post('attributes/{id}/language', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\AttributeController@storeTranslateLanguage');
            $api->delete('attributes/{id}/language', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\AttributeController@destroyTranslateLanguage');
            $api->post('attribute-value/{id}/language', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\AttributeValueController@storeTranslateLanguage');
            $api->delete('attribute-value/{id}/language', 'VCComponent\Laravel\Product\Http\Controllers\Api\Admin\AttributeValueController@destroyTranslateLanguage');
        });

        $api->get('products/all', 'VCComponent\Laravel\Product\Http\Controllers\Api\Frontend\ProductController@list');
        $api->put('products/status/bulk', 'VCComponent\Laravel\Product\Http\Controllers\Api\Frontend\ProductController@bulkUpdateStatus');
        $api->put('products/{id}/status', 'VCComponent\Laravel\Product\Http\Controllers\Api\Frontend\ProductController@updateStatusItem');
        $api->resource('products', 'VCComponent\Laravel\Product\Http\Controllers\Api\Frontend\ProductController');
    });
});