<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Knowledge;

class KnowledgeController extends Controller
{
    const MODULE = 'knowledge';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(mapPermission(SELF::MODULE));
        $knowledge = Knowledge::find(1)->first();

        return view('backend.knowledge.update', compact('knowledge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Knowledge $knowledge)
    {
        $this->authorize(mapPermission(SELF::MODULE));
        $result = $knowledge->update($this->validateRequest());

        if ($result == TRUE) :
            $message = 'อัพเดท คลังความรู้ เรียบร้อยแล้ว';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-success');
        else :
            $message = 'เกิดข้อผิดพลาดในการอัพเดทข้อมูล คลังความรู้';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-error');
        endif;

        return redirect(route('backend.knowledge.index'));
    }

    // Check Validate Data
    private function validateRequest() {
        $validatedData = request()->validate([
            'title_th' => 'required',
            'title_en' => 'required',
            'content_th' => 'required',
            'content_en' => 'required'
        ]);
        $validatedData['updated_by'] = Auth::id();
        return $validatedData;
    }
}
