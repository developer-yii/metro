<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomOfferRequest;
use App\Models\Offer;
use App\Models\CustomOffer;
use App\Services\OfferService;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = "Offers";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Offers', 'url' => route('offers.index')]
        ];

        return  view('admin.offers.index', compact('breadcrumbs', 'pageTitle'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $offers = Offer::query()
                    ->leftJoin('custom_offers', function ($join) {
                        $join->on('offers.productKey', '=', 'custom_offers.productKey')
                            ->on('offers.destination', '=', 'custom_offers.destination');
                    })
                    ->select('offers.*', 'custom_offers.percentage', 'custom_offers.is_interested_product') // Select required fields
                    ->get();

            return DataTables::of($offers)
                ->addIndexColumn()
                ->addColumn('percentage', function ($row) {
                    return $row->customOffer ? $row->customOffer->percentage : null;
                })
                ->editColumn('is_interested_product', function ($row) {
                    if ($row->customOffer && $row->customOffer->is_interested_product == true) {
                        return "<span class='badge bg-success text-white'>Interested</span>";
                    } else if($row->customOffer && $row->customOffer->is_interested_product == false){
                        return "<span class='badge bg-danger text-white'>Not Interested</span>";
                    }
                    else {
                        return "<span class='badge bg-success text-white'>Interested</span>";
                    }
                })
                ->addColumn('action', function ($row) {

                    $action = "";

                    $action .= '<button type="button" class="btn btn-sm btn-secondary me-1 offer-sync" data-id="' . $row->id . '"><i class="mdi mdi-sync" title="Sync"></i></button>';

                    $action .= '<button type="button" class="btn btn-sm btn-info me-1 offer-edit" data-bs-toggle="modal" data-bs-target="#offer-modal" data-id="' . $row->id . '"><i class="mdi mdi-pencil" title="Edit"></i></button>';

                    return $action;
                })
                ->rawColumns(['action', 'is_interested_product'])
                ->make(true);
        }
    }

    public function detail(Request $request)
    {
        $result = ['status' => false, 'message' => ""];
        if ($request->ajax()) {
            $offer = Offer::find($request->id);
            $customOffer = $offer->customOffer ?? null;

            $result = ['status' => true, 'message' => 'Detail get successfully.', 'data' => $offer, 'customOffer' => $customOffer];
        }
        return response()->json($result);
    }

    public function addupdate(CustomOfferRequest $request)
    {
        if ($request->id) {
            $offer = Offer::find($request->id);
            if ($offer) {
                $customOffer = CustomOffer::where('productKey', $offer->productKey)->where('destination', $offer->destination)->first();

                if (!$customOffer) {
                    $customOffer = new CustomOffer;
                    $customOffer->productKey = $offer->productKey;
                    $customOffer->destination = $offer->destination;
                }

                $customOffer->percentage = $request->percentage;
                $customOffer->is_interested_product = $request->is_interested_product ? true : false;
                $customOffer->updated_by = Auth::id();
                $customOffer->save();

                $result = ['status' => true, 'message' => 'Offer updated successfully.'];
                return response()->json($result);
            }

            $result = ['status' => false, 'message' => 'Offer update failed.'];
            return response()->json($result);
        }
    }

    public function sync(Request $request)
    {
        if($request->id){
            $offer = Offer::find($request->id);
            if($offer)
            {
                $offerService = new OfferService;
                $result = $offerService->offerSync($request->id);
            }
            else{
                $result = [ 'status' => false, 'message' => 'offer not found'];
            }
        }else{
            $result = [ 'status' => false, 'message' => 'Something went wrong. try after reloading page'];
        }
        return response()->json($result);
    }
}
