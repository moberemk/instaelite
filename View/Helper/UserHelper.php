<?php
App::uses('AppHelper', 'View/Helper');

class UserHelper extends AppHelper {
    public $helpers = array('Html');

    /**
     *  Render a user's profile
     */
    public function render($user, $options = array()) {
    	// Get the user's Instagram information
    	
    	if(!isset($options['showCampaigns'])) {
    		$options['showCampaigns'] = false;
    	}
        if(!isset($options['miniView'])) {
            $options['miniView'] = false;
        }
        if(!isset($options['offers'])) {
            $options['offers'] = array();
        }

        $options['user'] = $user;


    	// Render the view
    	return $this->_View->element('user_profile', $options);
    }

    /**
     *  Return how many accepted offers a given user has
     */
    public function acceptedOffers($user) {
        return count(array_filter($user['Offer'], function($offer) {
            return $offer['accepted'];
        }));
    }

    /**
     *  Return a user's rank
     */
    public function rank($offerCount) {
        if($offerCount >= 0 && $offerCount < 20) {
            return 10;
        } else if($offerCount >= 20 && $offerCount < 30) {
            return 9;
        } else if($offerCount >= 30 && $offerCount < 40) {
            return 8;
        } else if($offerCount >= 40 && $offerCount < 50) {
            return 7;
        } else if($offerCount >= 50 && $offerCount < 60) {
            return 6;
        } else if($offerCount >= 60 && $offerCount < 70) {
            return 5;
        } else if($offerCount >= 70 && $offerCount < 80) {
            return 4;
        } else if($offerCount >= 80 && $offerCount < 90) {
            return 3;
        } else if($offerCount >= 90 && $offerCount < 100) {
            return 2;
        } else if($offerCount >= 100) {
            return 1;
        }
    }

    /**
     *  Give back a context class depending on an offer's state
     */
    public function offerClass($offer) {
        if($offer['accepted'] == 1) {
            return 'success';
        } else if($offer['accepted'] == 0) {
            return 'error';
        } else {
            return 'info';
        }
    }

    /**
     *  Give back a properly campaign
     */
    public function campaignContent($offer) {
        $extension = pathinfo($offer['Campaign']['image']);
        // debug($extension);
        $extension = $extension['extension'];
        if($extension == 'mov' || $extension == 'mp4') {
            return '<video id="'.$offer['Campaign']['id'].'_content" class="video-js vjs-default-skin" controls preload="auto">'.
                     '<source src="/img/campaigns/'.$offer['Campaign']['id'].'/'.$offer['Campaign']['image'].'" type="video/'.$extension.'" />'.
                    '</video>';
        } else {
            $url = 'campaigns/'.$offer['Campaign']['id'].'/'.$offer['Campaign']['image'];
            return '<a href="'.Router::url('/img/'.$url.'" data-lightbox="campaigns').'">'.$this->_View->Html->image($url, array('escape'=>false, 'data-lightbox'=>'campaigns')).'</a>';
        }

    }
}
?>