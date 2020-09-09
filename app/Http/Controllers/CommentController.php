<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CommentController extends \Laravelista\Comments\CommentController
{
  /**
   * Creates a new comment for given model.
   */
  public function store(Request $request)
  {
      // If guest commenting is turned off, authorize this action.
      if (Config::get('comments.guest_commenting') == false) {
          Gate::authorize('create-comment', Comment::class);
      }

      // Define guest rules if user is not logged in.
      if (!Auth::check()) {
          $guest_rules = [
              'guest_name' => 'required|string|max:255',
              'guest_email' => 'required|string|email|max:255',
          ];
      }

      // Merge guest rules, if any, with normal validation rules.
      Validator::make($request->all(), array_merge($guest_rules ?? [], [
          'commentable_type' => 'required|string',
          'commentable_id' => 'required|string|min:1',
          'message' => 'required|string',
          'rate' => 'required|string|min:1|max:5'
      ]))->validate();

      $model = $request->commentable_type::findOrFail($request->commentable_id);

      $commentClass = Config::get('comments.model');
      $comment = new $commentClass;

      if (!Auth::check()) {
          $comment->guest_name = $request->guest_name;
          $comment->guest_email = $request->guest_email;
      } else {
          $comment->commenter()->associate(Auth::user());
      }

      $comment->commentable()->associate($model);
      $comment->comment = $request->message;
      $comment->rating = (int)$request->rate;
      $comment->approved = !Config::get('comments.approval_required');
      $comment->save();

      return redirect()->back();
  }
}
