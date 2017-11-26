<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::where('user_id', 1)->get()->toArray();
        return response()->json($links);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $url = $request->get('url');

        if (preg_match("@^https?://@", $url) === 0) {
            $url = 'http://' . $url;
        }

        $data['title'] = $request->get('title');
        $data['url'] = $url;
//        $data['user_id'] = Session::get("user_id");
        $data['user_id'] = 1;
        $data['is_private'] = $request->get('is_private');
        if (!$request->get('is_private')) {
            $data['is_private'] = 0;
        }

        Link::insert($data);
        return response()->json(['status' => 'success']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data['title'] = $request->get('title');
        $data['url'] = $request->get('url');
        $data['id'] = $id;
        $data['is_private'] = $request->get('is_private');
        if (!$request->get('is_private')) {
            $data['is_private'] = 0;
        }

        Link::whereId($id)->update($data);
        return response()->json(['status' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = 1; //Session::get('user_id');
        $link = Link::where('id', $id)->where('user_id', $user_id)->first();
        if ($link) {
            $destroyed = Link::destroy($id);
        }
        if (isset($destroyed)) {
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

}
