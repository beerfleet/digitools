<?php

namespace scrum\ScotchLodge\Entities;

use scrum\ScotchLodge\Entities\User;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Comment entity
 *
 * @author joeri broos
 */
class Comment {

  private $id;
  /* @var $user User */
  private $user;
  /* @var $comment Comment */
  private $comment_id;
  private $comment_date;
  private $comment;
  private $review_comment;
  private $event_comment;
  private $parent_comment;
  private $comment_likes;

  function __construct() {
    $this->comment_likes = new ArrayCollection();
    $this->parent_comment = null;
  }

  function getId() {
    return $this->id;
  }

  function getUser() {
    return $this->user;
  }

  function getCommentId() {
    return $this->comment_id;
  }

  function getCommentDate() {
    return $this->comment_date;
  }
  function getComment_date() {
    return $this->comment_date;
  }
  
  function getComment() {
    return $this->comment;
  }

  function getReviewComment() {
    return $this->review_comment;
  }

  function getReview_comment() {
    return $this->review_comment;
  }
  
  function getEventComment(){
    return $this->event_comment;
  }

  function getEvent_comment() {
    return $this->event_comment;
  }

  function getParentComment(){
    return $this->parent_comment;
  }
          
  function getParent_comment() {
    return $this->parent_comment;
  }

  function getCommentLikes() {
    return $this->comment_likes;
  }

  function getComment_likes() {
    return $this->comment_likes;
  }

  function setId($id) {
    $this->id = $id;
  }

  function setUser(User $user) {
    $this->user = $user;
  }

  function setCommentId(Comment $comment) {
    $this->comment_id = $comment;
  }

  function setCommentDate($comment_date) {
    $this->comment_date = $comment_date;
  }

  function setComment_date($comment_date) {
    $this->comment_date = $comment_date;
  }

  function setComment($comment) {
    $this->comment = $comment;
  }

  function setReviewComment($review_comment) {
    $this->review_comment = $review_comment;
  }

  function setReview_comment($review_comment) {
    $this->review_comment = $review_comment;
  }

  function setEventComment($event_comment){
    $this->event_comment = $event_comment;
  }
  
  function setEvent_comment($event_comment) {
    $this->event_comment = $event_comment;
  }

  function setParentComment($parent_comment) {
    $this->parent_comment = $parent_comment;
  }

  function setParent_comment($parent_comment) {
    $this->parent_comment = $parent_comment;
  }

  function setCommentLikes($comment_likes) {
    $this->comment_likes = $comment_likes;
  }

  function setComment_likes($comment_likes) {
    $this->comment_likes = $comment_likes;
  }

}
