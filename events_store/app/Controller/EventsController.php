<?php
App::uses('Sanitize', 'Utility');
class EventsController extends AppController {
   
    function beforeFilter() {
		parent::beforeFilter();
    }
    
    function stringToSlug($str) {
    	// trim the string
    	$str = strtolower(trim($str));
    	// replace all non valid characters and spaces with an underscore
    	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
    	$str = preg_replace('/-+/', "-", $str);
        return $str;
    }    
    
    function index($slug, $id) {
        App::import('Model', 'Pages');
        $Pages = new Pages();
        $slug = $this->stringToSlug($slug);
        $id = intval($id);
        
        App::import('Model', 'Event');
        $Event = new Event();
        $EventData = $Event->findBySlugAndId($slug, $id);
        $this->set('Event', $EventData);
        
        if($Event) {
            App::import('Model', 'Dates');
            $Dates = new Dates(); 
            $EventDates = $Dates->findAllByEventId($id);
            $this->set('Dates', $EventDates);           
        }
                
        $this->set('menu_header_items',  $Pages->findAllByShowInMenuAndShowWhere(1, 1, array(), array('Pages.orden ASC')));  
        $this->set('menu_footer_items',  $Pages->findAllByShowInMenuAndShowWhere(1, 2, array(), array('Pages.orden ASC')));
        $this->layout = 'default';
    }        
}