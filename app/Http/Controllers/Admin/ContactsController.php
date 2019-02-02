<?php

namespace App\Http\Controllers\Admin;

use App \{
    Contact,
        Http\Controllers\Controller,
        Repositories\Contracts\ContactRepoInterface
}; //php7 grouping use statements

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    protected $contactRepo;

    public function __construct(ContactRepoInterface $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->contactRepo->getContactusMessages();
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->contactRepo->deleteContactusMessage($id);
        return redirect()->route('system-admin.messages.index')->with('success', 'Message deleted successfully');
    }
}
