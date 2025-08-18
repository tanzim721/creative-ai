<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Creative;
use App\Models\CreativeType;
use App\Models\Subscription;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function show($id) {
        $creative = Creative::with('creative_type')->find($id);
        // dd($creative->creative_type_id);
        // $creative = CreativeType::with('creatives')->find($id);
        // dd($creative->creative_type->id);
        $subscription = Subscription::with('plan')->where('user_id', auth()->id())->first();
        $plans = Plan::where('is_active', 1)->get(); 
        if ($creative->creative_type_id == 1 ) {
            // dd($creative);
            // dd($subscription);
            return view('creatives.carousel', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 2) {
            // dd($creative);
            return view('creatives.scratch', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 3) {
            // dd($creative);
            return view('creatives.videoCanvas', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 4) {
            // dd($creative);
            return view('creatives.videoWithImageCarousel', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 5) {
            // dd($creative);
            return view('creatives.videoWithImageSlider', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 6) {
            // dd($creative);
            return view('creatives.interactiveImageSlider', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 7) {
            // dd($creative);
            return view('creatives.imageHoverAnimation', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 8) {
            return view('creatives.cricketGamification', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 9) {
            return view('creatives.footballGamification', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 10) {
            return view('creatives.scratchToReveal', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 11) {
            return view('creatives.3DRotatingCube', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 12) {
            return view('creatives.NewExpandableImage', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 13) {
            return view('creatives.countDown', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 14) {
            return view('creatives.scratchToRevealVideo', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 15) {
            return view('creatives.videoImageExpandOnHover', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 16) {
            return view('creatives.productSlider', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 17) {
            return view('creatives.locationBasedAds', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 18) {
            return view('creatives.responsive3DRotatingCube', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 19) {
            return view('creatives.storiesAds', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 20) {
            return view('creatives.creativeSwiper', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 21) {
            return view('creatives.creativeImageAnimation', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 24 && $creative->game_type_id == 1) {
            return view('creatives.basketball', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 24 && $creative->game_type_id == 2) {
            return view('creatives.roadmadness', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 24 && $creative->game_type_id == 3) {
            return view('creatives.tiny_archer', compact('creative', 'subscription', 'plans'));
        } elseif ($creative->creative_type_id == 24 && $creative->game_type_id == 4) {
            return view('creatives.climb_hero', compact('creative', 'subscription', 'plans'));
        }
    }
    
}
