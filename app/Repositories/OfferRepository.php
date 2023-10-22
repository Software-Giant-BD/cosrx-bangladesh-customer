<?php

namespace App\Repositories;

use App\Repositories\Interface\IOfferRepository;
use DB;

class OfferRepository extends Repository implements IOfferRepository
{
    private $modelName;

    private $adminUrl;

    public function __construct()
    {
        $this->adminUrl = env('Admin_url_public');
        $this->modelName = 'App\Models\Offer';
        parent::__construct($this->modelName);
    }

    public function offerList()
    {
        return $this->modelName::select('id', 'name', 'discount_percentage', 'start_date', 'end_date', DB::raw("CONCAT('$this->adminUrl',image) AS image"))
        ->where('published', 'Yes')
        ->get();
    }
}
