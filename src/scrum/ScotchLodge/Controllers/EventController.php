<?php

namespace scrum\ScotchLodge\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use \Slim\View;
use scrum\ScotchLodge\Controllers\Controller;
use scrum\ScotchLodge\Service\Event\EventService;
use scrum\ScotchLodge\Service\Whisky\WhiskyService;
use scrum\ScotchLodge\Service\Registration\RegistrationService;
use scrum\ScotchLodge\Entities\Event;
use scrum\ScotchLodge\Entities\User;
use scrum\ScotchLodge\Entities\Whisky;

/**
 * EventController controller
 * 
 * @author joeri broos 
 */
class EventController extends Controller{
    
    /*@var $eventsrv EventService */
    private $eventsrv;
    private $em;
    private $app;

    public function __construct($em, $app) {
        parent::__construct($em, $app);
        $this->eventsrv = new EventService($em, $app);
        $this->em = $em;
        $this->app = $app;
    }
    
    /**
     * Render the page to add a new event.
     */
    public function addEvent(){
      /* @var $app Slim */
        $app = $this->getApp();
        /* @var $user User */
        $user = $this->getUser();
        
        $admin = $user->isAdmin();
        $can_create = $user->canCreateEvent();

        if ($admin || $can_create) {
            $regsrv = new RegistrationService($this->em, $this->app);
            $postcodes = $regsrv->getPostcodes();
            $whiskiessrv = new WhiskyService($this->em, $this->app);
            $whiskies = $whiskiessrv->advanced_search_whisky_result();            
            $globals = $this->getGlobals();
            $this->getApp()->render('Events/new_event.html.twig', array('globals' => $globals, 'postcodes' => $postcodes, 'whiskies' => $whiskies));
        } else {
          $app->flash('error', 'Action not allowed');
          $app->redirectTo('main_page');
        }
    }
    
    /**
     * Insert a event.
     */
    public function insertEvent(){
        try{            
            $event = $this->eventsrv->addEvent($user);
            if($event){
                $app->flash('info', 'Event added.');
                $app->redirect($app->urlFor('main_page'));
            }else{
                $errors = $this->eventsrv->getErrors();
                $regsrv = new RegistrationService($this->em, $this->app);
                $postcodes = $regsrv->getPostcodes();
                $globals = $this->getGlobals();
                $this->getApp()->render('Events/new_event.html.twig', array('globals' => $globals, 'postcodes' => $postcodes, 'errors' => $errors));
            }
        } catch (Exception $ex) {
            $this->getApp()->render('probleem.twig.html');
        }
    }
    
    /**
     * Render the page to update a event.
     */
    public function editEvent($id){
        $event = $this->eventsrv->retrieveEventById($id);
        $regsrv = new RegistrationService($this->em, $this->app);
        $postcodes = $regsrv->getPostcodes();
        $whiskiessrv = new WhiskyService($this->em, $this->app);
        $whiskies = $whiskiessrv->advanced_search_whisky_result();                    
        $globals = $this->getGlobals();
        $this->getApp()->render('Events/edit_event.html.twig', array('globals' => $globals, 'postcodes' => $postcodes, 'event' => $event, 'whiskies' => $whiskies));        
    }
    
    /**
     * Update a event.
     */
    public function updateEvent($id){
        try{
            $event_old = $this->eventsrv->retrieveEventById($id);
            $event = $this->eventsrv->updateEvent($event_old);
            if($event){
                $app = $this->getApp();
                $app->flash('info', 'Event ' . $event->getTitle() . ' updated.');
                $app->redirect($app->urlFor('main_page'));
            }else{
                $errors = $this->eventsrv->getErrors();
                $regsrv = new RegistrationService($this->em, $this->app);
                $postcodes = $regsrv->getPostcodes();
                $globals = $this->getGlobals();
                $this->getApp()->render('Events/edit_event.html.twig', array('globals' => $globals, 'postcodes' => $postcodes, 'errors' => $errors, 'event' => $event_old));
            }
        } catch (Exception $ex) {
            $this->getApp()->render('probleem.twig.html');
        }
    }
    
/* Olivier */
    
        public function getEvents(){
          try{
          $globals = $this->getGlobals();  
          $events = $this->eventsrv->ShowAllCurrentEvents($this->em, $this->app);
          if($events){
              $this->getApp()->render('Events/show_event_list.html.twig', array('globals' => $globals, 'events' => $events));
          }
          else{
                $app = $this->getApp();
                $app->flash('error', 'The requested events does not exist');
                $app->redirectTo('error_404');
            }
        } catch (Exception $ex) {
            $this->getApp()->render('probleem.twig.html');
        }
          
          
        }
        
    
        
         public function show_event_by_id($id) {
         try{

        $globals = $this->getGlobals();  
        $event = $this->eventsrv->retrieveEventById($id);
        
        if($event){
              $this->getApp()->render('Events/show_event_by_id.html.twig', array('globals' => $globals,  'event' => $event));
          }
          else{
                $app = $this->getApp();
                $app->flash('error', 'The requested event does not exist');
                $app->redirectTo('error_404');
            }
        } catch (Exception $ex) {
            $this->getApp()->render('probleem.twig.html');
        }
          
    }
        
    
/* End Olivier    */
    
    public function addWhiskytoEvent(){
        /* @var $app Slim */
        $app = $this->getApp();
        /* @var $user User */
        $admin = $this->getUser()->isAdmin();
        $can_create = $this->getUser()->canCreateEvent();

        if ($admin || $can_create) {
            $eventsrv = new EventService($this->em, $this->app);
            $events = $eventsrv->ShowAllCurrentEvents($this->em, $this->app);
            $whiskiessrv = new WhiskyService($this->em, $this->app);
            $whiskies = $whiskiessrv->advanced_search_whisky_result();
            $globals = $this->getGlobals();
            $this->getApp()->render('Events/add_whisky_to_event.html.twig', array('globals' => $globals, 'events' => $events, 'whiskies' => $whiskies));
        } else {
            $app->flash('error', 'Action not allowed');
            $app->redirectTo('main_page');
        }
        
    }
    
    
}