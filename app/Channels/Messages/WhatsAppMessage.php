<?php


namespace App\Channels\Messages;

class WhatsAppMessage
{
  public $content;
  public $time;
  public $date;
  public $greetingText;
  public $outroLines = [];
  
  public function content($content)
  {
    $this->content = $content;

    return $this;
  }

  public function time($time)
  {
    $this->time = $time;

    return $this;
  }

  public function date($date)
  {
    $this->date = $date;

    return $this;
  }

  public function greeting($text)
  {
    $this->greetingText = $text;

    return $this;
  }

  public function line($line)
  {
    return $this->with($line);
  }

  public function with($line)
  {
    $this->outroLines[] = $line;

    return $this;
  }

}