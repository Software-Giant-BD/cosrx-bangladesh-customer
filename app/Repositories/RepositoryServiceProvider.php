<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            "App\Repositories\Interface\ISubscribeRepository",
            "App\Repositories\SubscribeRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\ITermsRepository",
            "App\Repositories\TermsRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IContactRepository",
            "App\Repositories\ContactRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IAboutRepository",
            "App\Repositories\AboutRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\ICustomerAddressRepository",
            "App\Repositories\CustomerAddressRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IPaymentTransectionRepository",
            "App\Repositories\PaymentTransectionRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IBlogCommentRepository",
            "App\Repositories\BlogCommentRepository"
        );

        $this->app->bind(
            "App\Repositories\Interface\IBlogCategoryRepository",
            "App\Repositories\BlogCategoryRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IBlogRepository",
            "App\Repositories\BlogRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IWishRepository",
            "App\Repositories\WishRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\ISliderRepository",
            "App\Repositories\SliderRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IInvoiceRepository",
            "App\Repositories\InvoiceRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IOrderRepository",
            "App\Repositories\OrderRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IOrderStatusRepoSitory",
            "App\Repositories\OrderStatusRepoSitory"
        );

        $this->app->bind(
            "App\Repositories\Interface\ICartRepository",
            "App\Repositories\CartRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\ISessionRepository",
            "App\Repositories\SessionRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IStockTransectionRepository",
            "App\Repositories\StockTransectionRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\ISupplierPaymentRepository",
            "App\Repositories\SupplierPaymentRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IPurchaseProductRepository",
            "App\Repositories\PurchaseProductRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IPurchaseRepository",
            "App\Repositories\PurchaseRepository"
        );

        //
        $this->app->bind(
            "App\Repositories\Interface\ICustomerRepository",
            "App\Repositories\CustomerRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\ISkinTypeRepository",
            "App\Repositories\SkinTypeRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\ISkinConcernRepository",
            "App\Repositories\SkinConcernRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\ICategoryRepository",
            "App\Repositories\CategoryRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IBrandRepository",
            "App\Repositories\BrandRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\IProductRepository",
            "App\Repositories\ProductRepository"
        );

        $this->app->bind(
            "App\Repositories\Interface\IProductReviewRepository",
            "App\Repositories\ProductReviewRepository"
        );

        $this->app->bind(
            "App\Repositories\Interface\IOfferProductRepository",
            "App\Repositories\OfferProductRepository"
        );

        $this->app->bind(
            "App\Repositories\Interface\IOfferRepository",
            "App\Repositories\OfferRepository"
        );

        $this->app->bind(
            "App\Repositories\Interface\ICouponRepository",
            "App\Repositories\CouponRepository"
        );
        $this->app->bind(
            "App\Repositories\Interface\ISupplierRepository",
            "App\Repositories\SupplierRepository"
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
