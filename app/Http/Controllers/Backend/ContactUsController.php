<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ContactUs;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
  const MODULE = 'contactus';

  public function index(Request $request) 
  {
    $this->authorize(mapPermission(self::MODULE));
    if ($request->filled('keyword')):
      $contactuss = ContactUs::getDataByKeyword($request->keyword)->get();
    else:
      $contactuss = ContactUs::limit(50)->get();
    endif;

    return view('backend.contact_us.index', compact('contactuss'));
  }

  public function search(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    if ($request->filled('keyword')):
      $contactuss = ContactUs::getDataByKeyword($request->keyword)->get();
    else:
      $contactuss = ContactUs::all();
    endif;

    return view('backend.contact_us.show', compact('contactuss'));
  }

  public function create() {
    $this->authorize(mapPermission(self::MODULE));
    $contact = new ContactUs;

    return view('backend.contact_us.create', compact('contact'));

  }

  public function store(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    $contactus = ContactUs::create($this->validateRequest());

    $message = 'บันทึกข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.contact.index'));
  }

  public function edit(ContactUs $contact)
  {
    $this->authorize(mapPermission(self::MODULE));

    return view('backend.contact_us.update', compact('contact'));
  }

  public function update(Request $request, ContactUs $contact)
  {
    $this->authorize(mapPermission(self::MODULE));
    $contact->update($this->validateRequest());

    $message = 'แก้ไขข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.contact.index'));
  }

  public function destroy(ContactUs $contact)
  {
    $this->authorize(mapPermission(self::MODULE));
    $contact->delete();

    return redirect(route('backend.contact.index'));
  }

  private function validateRequest()
  {
    $validatedData = request()->validate([
      "fullname"   => "required",
      "email"   => "required",
      "telephone"   => "required",
      "subject"   => "required",
      "detail"   => "required",
      "status" => "",
      "active" => "",
    ]);

    $validatedData['updated_by'] = Auth::id();
    if(request()->route()->getActionMethod() == 'store') :
      $validatedData['created_by'] = Auth::id();
    endif;

    return $validatedData;
  }

}

