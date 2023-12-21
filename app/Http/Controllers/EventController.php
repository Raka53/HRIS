<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
  public function index()
  {
      $events = array();
      $bookings = event::all();
      foreach($bookings as $booking) {
          $color = null;
          if($booking->title == 'Test') {
              $color = '#924ACE';
          }
          if($booking->title == 'Test 1') {
              $color = '#68B01A';
          }

          $events[] = [
              'id'   => $booking->id,
              'title' => $booking->title,
              'province' => $booking->province,
              'rs' => $booking->rs,
              'department' => $booking->department,
              'task' => $booking->task,
              'start' => $booking->start_date,
              'end' => $booking->end_date,
              'color' => $color
          ];
      }
      return view('event', ['events' => $events]);
  }
  public function store(Request $request)
  {
      $request->validate([
          'title' => 'required|string',
          'rs' => 'required|string'
      ]);

      $booking = event::create([
          'title' => $request->title,
          'rs' => $request->rs,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date,
      ]);

      $color = null;

      if($booking->title == 'Test') {
          $color = '#924ACE';
      }

      return response()->json([
          'id' => $booking->id,
          'start' => $booking->start_date,
          'end' => $booking->end_date,
          'title' => $booking->title,
          'rs' => $booking->rs,
          'color' => $color ? $color: '',

      ]);
  }
  public function update(Request $request ,$id)
  {
    $booking = Event::find($id);

    if (!$booking) {
        return response()->json([
            'error' => 'Unable to locate the event'
        ], 404);
    }

    $request->validate([

        'title' => ['string','sometimes'],
        'province' => ['string','sometimes'],
        'rs' => ['string','sometimes'],
        'department' => ['string','sometimes'],
        'task' => ['string','sometimes'],
        'start_date' => 'date_format:Y-m-d H:i:s',
    'end_date' => 'date_format:Y-m-d H:i:s|after_or_equal:start_date'
    ]);

    $booking->update([
        'id' => $request->id,
        'title' => $request->title,
        'province' => $request->province,
        'rs' => $request->rs,
        'department' => $request->department,
        'task' => $request->task,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    return response()->json(['message' => 'Event updated']);
}
  public function destroy($id)
  {
      $booking = event::find($id);
      if(! $booking) {
          return response()->json([
              'error' => 'Unable to locate the event'
          ], 404);
      }
      $booking->delete();
      return $id;
  }
}
