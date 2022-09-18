<?php

namespace App\Http\Controllers\Backend\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    protected function creatingSellingCartSession(Request $request)
    {
        if(!isset($request->customer_name))
        {
            return redirect()->back()->with('errors','Customer name not empty');
        } 
        if(!isset($request->customer_phone))
        {
            return redirect()->back()->with('errors','Customer  phone not empty');
        }
        $nameFromInput = $request->customer_name;
        $sessionNameFromInput = rand(111111111,999999999);
        $mastersessionname = masterSellingSession_hh();
        $mastersession    = [];
        $mastersession    = session()->has($mastersessionname) ? session()->get($mastersessionname)  : [];
        if(count($mastersession) > 0)
        {
            if(array_key_exists($sessionNameFromInput,$mastersession))
            {
                $data = ['status' => false, "message" => "Customer name or phone number is exist"];
                return $data;
            }
            else{
                $existingSession = [];
                foreach($mastersession as $master)
                {
                    $existingSession[$master['session_name']]=[
                        'session_name' => $master['session_name'],
                        'name' => $master['name'],
                        'status' => 'draft'
                    ];
                }
                session([$mastersessionname => []]);
                session([$mastersessionname => $existingSession]);

                $finalmastersessionname = masterSellingSession_hh();
                $finallymastersession    = [];
                $finallymastersession    = session()->has($finalmastersessionname) ? session()->get($finalmastersessionname)  : [];

                $finallymastersession[$sessionNameFromInput] = [
                    'session_name' => $sessionNameFromInput,
                    'name' => $nameFromInput,
                    'status' => 'active'
                ];
                session([$finalmastersessionname => $finallymastersession]);
                $data = ['status' => true, "message" => "Successfully changed"];
                //return $data;
                return redirect()->back();
            }
        }else{
            $mastersession[defaultSellingSession_hh()] = [
                'session_name' => defaultSellingSession_hh(),
                'name' => defaultSellingSessionName_hh(),
                'status' => 'active',
            ];
            session([$mastersessionname => $mastersession]);
            $data = ['status' => true, "message" => "Successfully added"];
            //return $data;
            return redirect()->back();
        }
        return 1;
    }


    protected function changingSellingCartSession($sessionname,Request $request)
    {
        $sessionNameFromUrlRequest = $sessionname;
        $mastersessionname = masterSellingSession_hh();
        $mastersession    = [];
        $mastersession    = session()->has($mastersessionname) ? session()->get($mastersessionname)  : [];
        if(count($mastersession) > 0)
        {
            if(array_key_exists($sessionNameFromUrlRequest,$mastersession))
            {
                //$requestSessionName = $mastersession[$sessionNameFromUrlRequest]['session_name'];
                $requestName = $mastersession[$sessionNameFromUrlRequest]['name'];

                $existingSession = [];
                foreach($mastersession as $master)
                {
                    $existingSession[$master['session_name']]=[
                        'session_name' => $master['session_name'],
                        'name' => $master['name'],
                        'status' => 'draft'
                    ];
                }
                session([$mastersessionname => []]);
                session([$mastersessionname => $existingSession]);

                $finalmastersessionname = masterSellingSession_hh();
                $finallymastersession    = [];
                $finallymastersession    = session()->has($finalmastersessionname) ? session()->get($finalmastersessionname)  : [];

                $finallymastersession[$sessionNameFromUrlRequest] = [
                    'session_name' => $sessionNameFromUrlRequest,
                    'name' => $requestName,
                    'status' => 'active'
                ];
                session([$finalmastersessionname => $finallymastersession]);
                $data = ['status' => true, "message" => "Successfully changed"];
                return redirect()->back();
                return $data;
            }
            else{
                $data = ['status' => false, "message" => "Invalid parameter"];
            }
        }else{
            $data = ['status' => false, "message" => "Please create an another sell by customer name and phone number"];
            return $data;
        }
    }


    protected function deleteingSellingCartSession($sessionname)
    {
        unsetRequestedSellSessionFromMasterSession_hh($sessionname);
        return redirect()->back();
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
}
