<?php

namespace App\Services;

use App\Repositories\Interface\IBrandRepository;
use App\Repositories\Interface\ICategoryRepository;
use App\Repositories\Interface\ISkinConcernRepository;
use App\Repositories\Interface\ISkinTypeRepository;

class FilterService
{
    private $catRepo;

    private $brandRepo;

    private $skinTypeRepo;

    private $skinConcernRepo;

    public function __construct(ICategoryRepository $catRepo, IBrandRepository $brandRepo,
    ISkinTypeRepository $skinTypeRepo, ISkinConcernRepository $skinConcernRepo)
    {
        $this->catRepo = $catRepo;
        $this->brandRepo = $brandRepo;
        $this->skinTypeRepo = $skinTypeRepo;
        $this->skinConcernRepo = $skinConcernRepo;
    }

    public function filterData()
    {
        $filterData['category'] = cache()->remember('filter-category', 60 * 60, function () {
            return $this->catRepo->all();
        });
        $filterData['brand'] = cache()->remember('filter-brand', 60 * 60, function () {
            return $this->brandRepo->all();
        });
        $filterData['skinConcern'] = cache()->remember('filter-skinConcern', 60 * 60, function () {
            return $this->skinConcernRepo->all();
        });
        $filterData['skinType'] = cache()->remember('filter-skinType', 60 * 60, function () {
            return $this->skinTypeRepo->all();
        });

        return $filterData;
    }
}
