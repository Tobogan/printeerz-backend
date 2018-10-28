<?php

namespace App\Http\Controllers;

use App\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse; 

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function addComment(Request $request) {
        //$this->layout = null;
        //check if its our form
        if($request){
            //\Debugbar::disable();
            $comment = new Comment();
            $comment->name =  $request->name;
            $comment->message = $request->message;
            $comment->event_id = $request->event_id;
            $comment->user_id = $request->user_id;
            $comment->save();

            // $postComment = new CommentPost();
            // $postComment->post_id = Input::get('event_id');
            // $postComment->comment_id = Comment::max('id');
            // $postComment->save();

            $response = array(
                'status' => 'success',
                'msg' => 'Setting created successfully',
            );
            return response()->json($response);  // <<<<<<<<< see this line
        } 
        else{
            return 'no';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json();  // <<<<<<<<< see this line

    }
}
