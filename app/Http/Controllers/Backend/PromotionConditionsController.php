<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Page;
use App\Model\Products;
use App\Model\PromotionConditionDetails;
use App\Model\PromotionConditions;
use App\Model\PromotionDetails;
use App\Model\Promotions;
use App\Model\PromotionTypes;
use App\Model\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class PromotionConditionsController extends Controller
{
    const MODULE = 'promotion_conditions';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')):
            $promotion_conditions = PromotionConditions::getDataByKeyword($request->keyword)->get();
        else:
            $promotion_conditions = PromotionConditions::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;
        return view('backend.promotion_conditions.index', compact('promotion_conditions'));
    }

    public function search(Request $request)
    {
        // $this->authorize(mapPermission(self::MODULE));
        // if ($request->filled('keyword')) :
        //     if (Auth::user()->hasRole(['admin'])) :
        //         $promotion_conditions = PromotionConditions::getDataByKeyword($request->keyword)->adminOnly()->get();
        //     else :
        //         $promotion_conditions = PromotionConditions::getDataByKeyword($request->keyword)->get();
        //     endif;
        // else :
        //     if (Auth::user()->hasRole(['admin'])) :
        //         $promotion_conditions = PromotionConditions::adminOnly()->get();
        //     else :
        //         $promotion_conditions = PromotionConditions::all();
        //     endif;
        // endif;
        // return view('backend.promotion_conditions.show', compact('promotion_conditions'));
    }

    public function create(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        // $promotions = Promotions::onlyActive()->notIn()->get();
        $promotions = Promotions::onlyActive()->where('end_at', '>=', DB::raw('now()'))->get();
        $promotion_types = PromotionTypes::get(['id', 'name']);
        $promotion_conditions = new PromotionConditions;
        // $products = Products::onlyActive()->get();
        $tags = Tags::all();
        $pages = Page::get();

        return view('backend.promotion_conditions.create', compact(['promotions', 'promotion_conditions', 'pages', 'tags', 'promotion_types']));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));

        try {
            if ($request->promotion_pattern == "2") {
                $data = request()->validate([
                    "promotion_pattern" => "required",
                    "promotions_id" => "required",
                    "cdt" => "",
                ]);
            } else {
                $data = request()->validate([
                    "promotion_pattern" => "required",
                    "promotions_id" => "required",
                    "cdt" => "required",
                ]);
            }

            // promotion_conditions
            $pt_data['promotion_types_id'] = $data['promotion_pattern'];
            $pt_data['promotions_id'] = $data['promotions_id'];
            $pt_data['updated_by'] = Auth::id();
            $pt_data['created_by'] = Auth::id();
            $promotion_condition = PromotionConditions::create($pt_data);

            // promotion_condition_details
            $pcd_data['promotion_conditions_id'] = $promotion_condition->id;
            $pcd_data['updated_by'] = Auth::id();
            $pcd_data['created_by'] = Auth::id();
            if ($request->cdt) {
                foreach ($request->cdt as $k => $v):
                    $pcd_data['condition'] = $v['condition'];
                    $pcd_data['discount'] = $v['discount'];
                    $pcd_data['discount_pc'] = $v['discount_pc'];
                    PromotionConditionDetails::create($pcd_data);
                endforeach;
            } else {
                PromotionConditionDetails::create($pcd_data);
            }

            // promotion_details
            $pd_data['promotion_conditions_id'] = $promotion_condition->id;
            $pd_data['updated_by'] = Auth::id();
            $pd_data['created_by'] = Auth::id();
            foreach ($request->dt as $k => $v):
                $pd_data['products_id'] = $v['products_id'];
                $pd_data['discount'] = $v['discount'];
                $pd_data['discount_pc'] = $v['discount_pc'];
                PromotionDetails::create($pd_data);
            endforeach;

            $message = 'บันทึกข้อมูลเรียบร้อย';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-success');

            return redirect(route('backend.promotion_conditions.index'));
        } catch (\Throwable $th) {
            dd($th);
            $message = 'โปรโมชั่นนี้ ใช้ครบทุกรูปแบบแล้ว';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-danger');

            return redirect()->back()
                ->withInput();
        }
    }

    public function edit(Request $request, PromotionConditions $promotion_condition)
    {
        $this->authorize(mapPermission(self::MODULE));
        $pages = Page::get();
        $tags = Tags::all();
        $promotion_types = PromotionTypes::get(['id', 'name']);
        $promotions = Promotions::onlyActive()->get();
        $pds = PromotionDetails::where('promotion_conditions_id', $promotion_condition->id)->get(['id as promotion_details_id', 'discount', 'discount_pc', 'products_id as id']);
        $pcds = PromotionConditionDetails::where('promotion_conditions_id', $promotion_condition->id)->get(['id as promotion_condition_details_id', 'condition', 'discount', 'discount_pc']);
        return view('backend.promotion_conditions.update', compact(['promotion_condition', 'promotions', 'pages', 'tags', 'pcds', 'pds', 'promotion_types']));
    }

    public function update(Request $request, PromotionConditions $promotion_condition)
    {
        $this->authorize(mapPermission(self::MODULE));
        // dd($request);

        try {
            // Promotion details
            $pds = $this->getDataChange('pds', json_decode($request->dtDel, true), $request->dt);
            $this->dataActionsChk('pds', $pds, $promotion_condition->id);

            // Promotion Condition details
            $pcds = $this->getDataChange('pcds', json_decode($request->cdtDel, true), $request->cdt);
            $this->dataActionsChk('pcds', $pcds, $promotion_condition->id);

            $promotion_condition->touch();

            $message = 'แก้ไขข้อมูลเรียบร้อย';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-success');

            return redirect(route('backend.promotion_conditions.index'));
        } catch (\Throwable $th) {

            $message = 'พบข้อผิดพลาด โปรดลองใหม่ หรือติดต่อผู้ดูแลระบบ';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-danger');

            return redirect()->back()
                ->withInput();
        }
    }

    /**
     * Actions data
     */
    public function dataActionsChk($opt, $dArr, $promotion_types_id)
    {
        $dNew['promotion_conditions_id'] = $promotion_types_id;
        $dNew['updated_by'] = Auth::id();
        // echo 'New (' . $opt . ')<br>';
        foreach ($dArr['dtNew'] as $vNew):
            $dNew['created_by'] = Auth::id();
            $dNew['discount'] = $vNew['discount'];
            $dNew['discount_pc'] = $vNew['discount_pc'];
            // echo '<pre>' . var_dump($dNew) . '</pre><hr>';
            if ($opt == 'pds') {
                $dNew['products_id'] = $vNew['id'];
                PromotionDetails::create($dNew);
            } else {
                $dNew['condition'] = $vNew['condition'];
                PromotionConditionDetails::create($dNew);
            }
        endforeach;
        $dUpdate['promotion_conditions_id'] = $promotion_types_id;
        $dUpdate['updated_by'] = Auth::id();
        // echo 'Update (' . $opt . ')<br>';
        foreach ($dArr['dtUpdate'] as $vUpdate):
            if ($opt == 'pcds') {
                $dUpdate['condition'] = $vUpdate['condition'];
            }
            $dUpdate['discount'] = $vUpdate['discount'];
            $dUpdate['discount_pc'] = $vUpdate['discount_pc'];
            // echo '<pre>' . var_dump($dUpdate) . '</pre><hr>';
            if ($opt == 'pds') {
                $dUpdate['products_id'] = $vUpdate['id'];
                PromotionDetails::where('id', $vUpdate['promotion_details_id'])->update($dUpdate);
            } else {
                $dUpdate['condition'] = $vUpdate['condition'];
                PromotionConditionDetails::where('id', $vUpdate['promotion_condition_details_id'])->update($dUpdate);
            }
        endforeach;
        // echo 'Del (' . $opt . ')<br>';
        foreach ($dArr['dtDel'] as $vDel):
            // echo '<pre>' . var_dump($vDel) . '</pre><hr>';
            if ($opt == 'pds') {
                PromotionDetails::where('id', $vDel)->delete();
            } else {
                PromotionConditionDetails::where('id', $vDel)->delete();
            }
        endforeach;
    }

    /**
     * Get data changes
     */
    public function getDataChange($opt, $old, $new)
    {
        /**
         * Settings
         */
        $pk = ($opt == 'pds') ? 'promotion_details_id' : 'promotion_condition_details_id';

        $dtNew = [];
        $dtUpdate = [];
        $dtDel = [];

        $oldChecked = [];
        foreach ($old as $v) {
            $oldChecked[] = $v[$pk];
        }
        $newChecked = [];
        if (gettype($new) == 'array') {
            foreach ($new as $v) {
                $newChecked[] = $v[$pk];
                if ($v[$pk] == null) {
                    $dtNew[] = $v;
                }
                if (in_array($v[$pk], $oldChecked) and $v[$pk] != null) {
                    $changed = false;
                    foreach ($old as $v2) {
                        if ($v[$pk] == $v2[$pk]) {
                            if ($opt == 'pcds') {
                                if ($v['condition'] != $v2['condition']) {
                                    $changed = true;
                                }
                            }
                            if ($v['discount'] != $v2['discount']) {
                                $changed = true;
                            }
                            if ($v['discount_pc'] != $v2['discount_pc']) {
                                $changed = true;
                            }
                            break;
                        }
                    }
                    if ($changed) {
                        $dtUpdate[] = $v;
                    }
                }
            }
            $dtDel = array_diff($oldChecked, $newChecked);
        }
        return [
            "dtNew" => $dtNew,
            "dtUpdate" => $dtUpdate,
            "dtDel" => $dtDel,
        ];
    }

    public function destroy(Request $request, PromotionConditions $promotion_condition)
    {
        $this->authorize(mapPermission(self::MODULE));
        try {
            // Promotion details
            PromotionDetails::where('promotion_conditions_id', $promotion_condition->id)->delete();

            // Promotion Condition details
            PromotionConditionDetails::where('promotion_conditions_id', $promotion_condition->id)->delete();

            $promotion_condition->delete();

            $message = 'ลบข้อมูลเรียบร้อย';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-success');

            return redirect(route('backend.promotion_conditions.index'));
        } catch (\Throwable $th) {

            $message = 'พบข้อผิดพลาด โปรดลองใหม่ หรือติดต่อผู้ดูแลระบบ';
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-danger');

            return redirect()->back()
                ->withInput();
        }
        return redirect(route('backend.promotion_conditions.index'));
    }

    /**
     * Get Product Promotion
     */
    public function promotion(Request $request)
    {
        if ($request->id) {
            $promotion_details = PromotionDetails::where('promotion_conditions_id', $request->id)->pluck('products_id')->toArray();
        }

        $products = Products::selectRaw('id, created_at, name_th, code, sku, 0 AS discount, 0 AS discount_pc, categories_id, null as promotion_details_id');

        if ($request->filled('filter_tags') or $request->filled('start_at') or $request->filled('end_at')) {
            $products = $products->getDataSearch($request);
        }

        $products = $products->onlyActive()->onlyAvailable(config('global.warehouse'));

        if ($request->id) {
            $products = $products->whereNotIn('id', $promotion_details)->get();

            $pmt_dts = Products::selectRaw('products.id, products.created_at, products.name_th, products.code, products.sku, products.categories_id, promotion_details.discount, promotion_details.discount_pc, promotion_details.id as promotion_details_id')
                ->whereIn('products.id', $promotion_details)
                ->join('promotion_details', function ($join) use ($request) {
                    $join->on('products.id', '=', 'promotion_details.products_id');
                    $join->where('promotion_conditions_id', $request->id);
                })->get();

            $merged = $pmt_dts->merge($products);
            $result = $merged->all();
        } else {
            $result = $products;
        }

        return datatables()->of($result)
            ->addColumn('image', function ($q) {
                $image = asset($q->image);
                return '<img src="' . $image . '" class="img-table">';
            })
            ->addColumn('categorie', function ($q) {
                return $q->categories_name->name_th;
            })
            ->addColumn('tags', function ($q) {
                $t = $q->producttags;
                $s = '';
                foreach ($t as $k => $v) {
                    $s .= $v->tags->name_th . ",";
                }
                return $s;
            })
            ->editColumn('created_at', function ($q) {
                return date('d/m/Y H:i:s', strtotime($q->created_at));
            })
            ->rawColumns(['image'])->make(true);
    }
}
