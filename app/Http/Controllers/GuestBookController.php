<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\File;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Validator;

class GuestBookController extends Controller
{
    /**
     * get and sort all messages from DB
     * @param string $orderBy order by field
     * @param string $sort sort ASC or DESC
     * @return collection
     */
    private function getMessages($orderBy, $sort)
    {
        $messages = DB::table('messages')
            ->join('siteusers', 'siteusers.id', '=', 'messages.user_id')
            ->leftjoin('files', 'files.id', '=', 'messages.file_id')
            ->select('messages.id as id',
                     'siteusers.name as name',
                     'siteusers.email as email',
                     'siteusers.homepage as homepage',
                     'siteusers.ip as ip',
                     'siteusers.browser_name as browser_name',
                     'messages.message as message',
                     'files.path as path',
                     'messages.created_at as created_at')
            ->orderBy($orderBy, $sort)
            ->paginate(25);

        return $messages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['orderBy']) && isset($_GET['sort']))
        {
            $sort = $_GET['sort'];
            $orderBy = $_GET['orderBy'];
        }
        else
        {
            $sort = 'DESC';
            $orderBy = 'created_at';
        }

        $messages = $this->getMessages($orderBy, $sort);

        return view('home', ['messages' => $messages,
                             'orderBy' => $orderBy,
                             'sort' => $sort,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $code = $request->input('CaptchaCode');
        $isHuman = captcha_validate($code);

        if ($isHuman)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|alpha_num',
                'email' => 'required|email|unique:siteusers,email',
                'message' => 'required|string|max:500',
            ]);

            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->homepage = $request->homepage;
            $user->ip = $request->ip();
            $user->browser_name = $request->header('User-Agent');
            if (!$user->save())
            {
                return redirect('/add')->with('status', 'User data save failed!')->withInput();
            }

            $message = new Message;
            $message->user_id = $user->id;

            if ($request->hasFile('file'))
            {
                $file = new File;
                $file->user_id = $user->id;
                $file->path = $request->filePath;
                $file->save;

                $message->file_id = $file->id;
            }

            $message->message = strip_tags($request->message);
            if (!$message->save())
            {
                return redirect('/add')->with('status', 'Message data save failed!')->withInput();
            }

            return redirect('/')->with('status', 'Message saved!');
        }
        else
        {
            return redirect('/add')->with('status', 'Captcha validation failed!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Message::destroy($id);

        return redirect('/')->with('status', 'Message deleted successful!');
    }
}
