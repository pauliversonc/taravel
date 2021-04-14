<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
class MailController extends Controller {
    public function basic_email(){
       $data = array('name'=>"Taravel");

       Mail::send(['text'=>'mail'], $data, function($message) {
          $message->to('kingpena25@gmail.com', 'Tutorials Point')->subject
             ('Taravel email verification');
          $message->from('kingpena25@gmail.com','Taravel');
       });
       echo "Basic Email Sent. Check your inbox.";
    }
    public function html_email(){
       $data = array('name'=>"Taravel");
       Mail::send('mail', $data, function($message) {
          $message->to('kingpena25@gmail.com', 'Tutorials Point')->subject
             ('Taravel email verification');
          $message->from('kingpena25@gmail.com','Taravel');
       });
       echo "HTML Email Sent. Check your inbox.";
    }
    public function attachment_email(){
       $data = array('name'=>"Taravel");
       Mail::send('mail', $data, function($message) {
          $message->to('lopezjohndave03@gmail.com', 'Tutorials Point')->subject
             ('Taravel email verification');
          $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
          $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
          $message->from('kingpena25@gmail.com','Taravel');
       });
       echo "Email Sent with attachment. Check your inbox.";
    }
 }
