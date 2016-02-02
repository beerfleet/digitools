<?php

namespace scrum\ScotchLodge\Service\Event;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Entities\Event;
use scrum\ScotchLodge\Entities\User;
use scrum\ScotchLodge\Entities\Whisky;
use scrum\ScotchLodge\Entities\EventWhisky;
use scrum\ScotchLodge\Service\Validation\EventValidation as Val;
use scrum\ScotchLodge\Service\Registration\RegistrationService;
use scrum\ScotchLodge\Service\Whisky\WhiskyService;
use DateTime;

/**
 * EventService
 *
 * @author joeri broos
 */
class EventService {
    
    private $em;
    private $app;
    private $errors;

    public function __construct($em, $app) {
      $this->em = $em;
      $this->app = $app;
      $this->errors = null;
    }

    public function getErrors(){
        return $this->errors;
    }

    /* Begin Add function */    
    /**
     * Create a new event, returns a Event when there are no errors,
     * otherwhise it gives a false in return.
     * @return boolean|Event
     */
    public function addEvent(User $user){
        $val = new Val($this->app, $this->em);
        if($val->validate()){
            $title = $this->app->request->post('title');
            $postcode = $this->app->request->post('postcode');
            $address = $this->app->request->post('address');
            $date = $this->app->request->post('event_date');
            $date = str_replace('/', '-', $date);
            $date_stop = $this->app->request->post('event_stop');
            $date_stop = str_replace('/', '-', $date_stop);
            $description = $this->app->request->post('description');
            /*$whiskies = $this->app->request-post('whiskies');*/

            /* @var $event Event */
            $event = new Event();
            $event->setTitle($title);
            /* @var $postcode Postcode */
            $regsrv = new RegistrationService($this->em, $this->app);
            $postcode_object = $regsrv->getPostcodeObject($postcode);
            $event->setPostcode($postcode_object);
            $event->setAddress($address);
            $event_date = new \DateTime($date);
            $event->setEventDate($event_date);
            $event_stop = new \DateTime($date_stop);
            $event->setEventStop($event_stop);
            $event->setDescription($description);
            $event->setCreatedBy($user);

            $this->em->persist($event);
            $this->em->flush();
            
            $this->insertWhiskiestoEvent();
            return $event;
        }
        $this->errors = $val->getErrors();
        return false;
    }
    /* End Add function */    

    /* Begin Update function */
    /**
     * Update the fields of a event
     * @param Event $event
     */
    public function updateEvent(Event $event){
        $title = $this->app->request->post('title');
        if($event->getTitle() != $title){
          $event->setTitle($title);
        }

        $postcode = $this->app->request->post('postcode');
        if($event->getPostcode()->getId() != $postcode){
            $regsrv = new RegistrationService();
            $postcode_object = $regsrv->getPostcodeObject($postcode);
            $event->setPostcode($postcode_object);
        }

        $address = $this->app->request->post('address');
        if($event->getAddress() != $address){
            $event->setAddress($address);
        }

        $event_date_input = $this->app->request->post('event_date');
        if($event_date_input != null && $event->getEventDate() != $event_date_input){
            $event_date = new DateTime($event_date_input);            
            $event->setEventDate($event_date);
        }

        $event_stop_input = $this->app->request->post('event_stop');
        if($event_stop_input != null && $event->getEventStop() != $event_stop_input){
            $event_stop = new DateTime($event_stop_input);
            $event->setEventStop($event_stop);
        }
        
        $description = $this->app->request->post('description');
        if($event->getDescription() != $description){
            $event->setDescription($description);
        }
        /*
        $whiskies = $this->app->request->post('whiskies');
        if($whiskies != null){
            foreach ($whiskies as $whisky){
                $whiskysrv = new WhiskyService($this->em, $this->app);
                $whisky_object = $whiskysrv->retrieveWhiskyById($whisky);
                $whiskiesbyevent = $event->getWhiskys();
                if($event->getWhiskys()->count()){
                    foreach ($whiskiesbyevent as $whiskybyevent){
                        if($whiskybyevent->getId() == $whisky->getId()){
                            $this->addWhiskytoEvent($whisky_object, $event);                    
                        }
                    }
                }else{
                    $this->addWhiskytoEvent($whisky_object, $event);
                }
            }
        }*/

        $this->em->persist($event);
        $this->em->flush();
        return $event;
    }
    /* End Update function */

    /* Begin Search functions */
    /**
     * Retrieve a event by is Id
     * @param int $id
     * @return Event $event
     */
    public function retrieveEventById($id){
        $event = $this->em->getRepository('scrum\ScotchLodge\Entities\Event')->find($id);
        if(count($event)> 0){
            return $event;
        }else{
            return null;
        }
    }

    /**
     * Retrieve all events of a specific date
     * @return Array of Events
     */
    public function retrieveEventsByDate(){
        $event_date = $this->app->request->post('event_date');
        $events = $this->em->getRepository('scrum\ScotchLodge\Entities\Event')->findBy(array('event_date' => $event_date));
        if(count($events)> 0){
            return $events;
        }else{
            return null;
        }
    }
    
    /**
     * Retrieve all events of a specific postcode
     * @return Array of Events
     */
    public function retrieveEventsByPostCode(){
        $postcode_id = $this->app->request->post('postcode');
        $events = $this->em->getRepository('scrum\ScotchLodge\Entities\Event')->findBy(array('postcode_id' => $postcode_id));
        if(count($events)> 0){
            return $events;
        }else{
            return null;
        }        
    }

/* Olivier */    
    public function ShowAllCurrentEvents($em,$app){
    //$em = $this->getEntityManager();
    $eventRepository = $em->getRepository('scrum\ScotchLodge\Entities\Event');
    $dql = "SELECT e FROM scrum\ScotchLodge\Entities\Event e where e.event_date >= CURRENT_DATE() ORDER BY e.event_date ASC";
    $query = $em->createQuery($dql);
    //$query->setMaxResults(30);
    $events = $query->getResult();
    if(count($events)> 0){
            return $events;
        }else{
            return null;
        }
    return $events;
    
    }
/* End Olivier */

/* Filip */ 
    public function LatestEvents($limit){
    $em = $this->getEntityManager();
    $eventRepository = $em->getRepository('scrum\ScotchLodge\Entities\Event');
    $dql = "SELECT e FROM scrum\ScotchLodge\Entities\Event e where e.event_date >= CURRENT_DATE() ORDER BY e.event_date ASC";
    $query = $em->createQuery($dql);
    $query->setMaxResults($limit);
    $events = $query->getResult();
    return $events;
    
    }  
    public function LatestEvent(){
    $em = $this->getEntityManager();
    $eventRepository = $em->getRepository('scrum\ScotchLodge\Entities\Event');
    $dql = "SELECT e FROM scrum\ScotchLodge\Entities\Event e where e.event_date >= CURRENT_DATE() ORDER BY e.event_date ASC";
    $query = $em->createQuery($dql);
    $query->setMaxResults(1);
    $event = $query->getResult();
    return $event;
    
    } 
/*end Filip */
    
    /* End Search functions */
    
    /* Begin Add whiskies to a event function */
    
    /**
     * Add all selected whiskies to a event,
     */
    public function insertWhiskiestoEvent(Event $event, $whiskies){
        foreach ($whiskies as $whisky){
            $whiskysrv = new WhiskyService($this->em, $this->app);
            $whisky_object = $whiskysrv->retrieveWhiskyById($whisky);
            $whisky_event = $this->addWhiskytoEvent($whisky_object, $event);
            //$this->em->persist($whisky_event);
            //$this->em->flush();
            echo($whisky_event);
        }
        
    }
    
    /* End Add whiskies to a event function */
    
    /* Begin Add a whisky to a event function */
    /**
     * @param Whisky $whisky
     * @param Event $event
     */
    public function addWhiskytoEvent(Whisky $whisky, Event $event){
        /* @var $EventWhisky */
        $event_whisky = new EventWhisky();
        $event_whisky->setWhisky($whisky);
        $event_whisky->setEvent($event);
        $this->em->persist($event_whisky);
        $this->em->flush();
    }
    /* End Add whisky to event function */

}
