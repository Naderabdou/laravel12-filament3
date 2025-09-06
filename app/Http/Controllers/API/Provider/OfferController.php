<?php

namespace App\Http\Controllers\API\Provider;

use App\Models\Provider;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Provider\OfferResource;
use App\Repositories\Provider\OfferRepository;
use App\Http\Requests\API\Provider\OfferRequest;
use App\Http\Resources\Provider\OfferUserSubscriptionsResource;

class OfferController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected OfferRepository $offersRepo) {}

    public function index(Request $request)
    {

        $perPage = $request->integer('per_page', 15);
        $offers = $this->offersRepo->query()
            ->where('provider_id', auth()->id())
            ->withCount('subscriptions')
            ->paginate($perPage);

        if ($offers->isEmpty()) {
            return $this->apiResponse([], 'No offers available', 200);
        }

        return $this->apiResponse(OfferResource::collection($offers), 'success', 200);
    }

    public function store(OfferRequest $request)
    {
        $provider = Provider::find(auth()->id());

        $data = $request->validated();
        $data['provider_id'] = $provider->id;
        $data['club_id'] = $provider->club->id;
        $data['start_at'] = now();
        $data['image'] = AppHelper::uploadFiles('offers', $request->file('image'));

        $offer = $this->offersRepo->store($data);
        $offer->providerPackages()->sync($data['package_id']);

        return $this->apiResponse(null, 'Offer created successfully', 201);
    }

    public function update(OfferRequest $request, $id)
    {
        $data = $request->validated();
        $offer = $this->offersRepo->find($id);
        if (!$offer) {
            return $this->apiResponse(null, 'Offer not found', 404);
        }
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($offer->image);
            $data['image'] = AppHelper::uploadFiles('offers', $request->file('image'));
        }

        $offer = $this->offersRepo->update($data, $id);
        $offer->providerPackages()->sync($data['package_id']);

        return $this->apiResponse(null, 'Offer updated successfully', 201);
    }

    public function changeOfferActivation($id)
    {
        $offer = $this->offersRepo->find($id);

        if (!$offer) {
            return $this->apiResponse(null, 'Offer not found', 404);
        }
        $this->offersRepo->update(['is_active' => !$offer->is_active],  $offer->id);

        return $this->apiResponse(null, 'Offer activation status changed successfully', 200);
    }

    public function renewOffer($id)
    {
        $offer = $this->offersRepo->find($id);

        if (!$offer) {
            return $this->apiResponse(null, 'Offer not found', 404);
        }
        if ($offer->end_at > now()) {
            return $this->apiResponse(null, 'Only active offers can be renewed', 400);
        }
        $duration = $offer->start_at->diffInDays($offer->end_at);

        $this->offersRepo->update([
            'start_at' => now(),
            'end_at'   => now()->addDays($duration),
            'is_active' => true,
        ], $offer->id);

        return $this->apiResponse(null, 'Offer renewed successfully', 200);
    }

    public function destroy($id)
    {
        $offer = $this->offersRepo->find($id);

        if (!$offer) {
            return $this->apiResponse(null, 'Offer not found', 404);
        }

        $offer->delete();

        return $this->apiResponse(null, 'Offer deleted successfully', 200);
    }

    public function userSubscriptions($id)
    {

        $offer = $this->offersRepo
            ->with(['subscriptions.user'])
            ->has('subscriptions')
            ->where('provider_id', auth()->id())
            ->find($id);

        if (!$offer) {
            return $this->apiResponse(null, 'Offer not found', 404);
        }


        return $this->apiResponse(OfferUserSubscriptionsResource::collection($offer->subscriptions), 'User subscriptions fetched successfully', 200);
    }
}
