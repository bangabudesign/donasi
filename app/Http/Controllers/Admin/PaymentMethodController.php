<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class PaymentMethodController extends Controller
{
    public $title;
    public $subtitle;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Payment Methods';
        $this->subtitle = 'Daftar semua metode pembayaran';

        $payment_methods = PaymentMethod::get();

        return view('admin.payment_method.index', [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'payment_methods' => $payment_methods,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Add Payment Methods';
        $this->subtitle = 'Tambah metode pembayaran';

        return view('admin.payment_method.create',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentMethodRequest $request)
    {
        $data = ([
            'type' => $request->type,
            'category' => $request->category,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'detail_1' => $request->detail_1,
            'detail_2' => $request->detail_2,
            'detail_3' => $request->detail_3,
            'status' => $request->status,
        ]);

        if ($request->file('image')){
            $image = $request->file('image');
            $imageName = Str::slug($request->detail_2);
            $extension = $image->getClientOriginalExtension();
            $newImageName = $imageName . '.' . $extension;
            $imagePath = 'uploads/payment_methods/'.$newImageName;

            $img = Image::make($image);
            $img->resize(200, 112, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($imagePath);

            $data['image'] = $imagePath;
        }

        PaymentMethod::create($data);

        return redirect()->route('admin.payment_methods.index')->with('successMessage', 'Payment method has been created');
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
        $p_method = PaymentMethod::findOrFail($id);

        $this->title = 'Edit Payment Method';
        $this->subtitle = $p_method->name;

        return view('admin.payment_method.edit',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'p_method' => $p_method
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentMethodRequest $request, $id)
    {
        $payment_method = PaymentMethod::findOrFail($id);
        
        $data = ([
            'type' => $request->type,
            'category' => $request->category,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'detail_1' => $request->detail_1,
            'detail_2' => $request->detail_2,
            'detail_3' => $request->detail_3,
            'status' => $request->status,
        ]);

        if ($request->file('image')){
            if ($payment_method->image != null) {
                $oldImg = Image::make($payment_method->image);
                if($oldImg) {
                    $oldImg->destroy();
                }
            }
            $image = $request->file('image');
            $imageName = Str::slug($request->detail_2);
            $extension = $image->getClientOriginalExtension();
            $newImageName = $imageName . '.' . $extension;
            $imagePath = 'uploads/payment_methods/'.$newImageName;

            $img = Image::make($image);
            $img->resize(200, 112, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($imagePath);

            $data['image'] = $imagePath;
        }

        $payment_method->update($data);

        return redirect()->route('admin.payment_methods.index')->with('successMessage', 'Payment method has been updated');
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
